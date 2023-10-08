<?php

namespace App\Http\Services;

use FFMpeg\Format\Video\X264;
use App\Http\Services\Service;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\LessonRepository;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class LessonService extends Service
{
    public function __construct(
        private LessonRepository $lessonRepository
    ){}

    public function getAllLessonsBySectionId($course_id)
    {
        return $this->lessonRepository->getAllLessonsBySectionId($course_id);
    }

    public function addLesson($data, $file=null)
    {
        // Upload temp file
        $storedPath = Storage::disk('videos')->put('', $file);
        $fileName = basename($storedPath);

        // HLS
        $fileNameHLS = time();

        FFMpeg::fromDisk('videos')
        ->open($fileName)
        ->exportForHLS()
        ->setSegmentLength(10)
        ->setKeyFrameInterval(48)
        ->addFormat(new X264)
        ->save($fileNameHLS.'/video.m3u8');

        // Add Lesson
        $data['content'] = $fileNameHLS.'/video.m3u8';
        $data['type'] = 'video';

        $lesson = $this->lessonRepository->addLesson($data);

        // Delete temp file
        Storage::disk('videos')->delete($storedPath);

        // Edit m3u8 file
        $m3u8FileContent = Storage::disk('videos')->get($fileNameHLS.'/video.m3u8');
        $m3u8FileName = explode(PHP_EOL, $m3u8FileContent)[2];
        $m3u8FileContent = str_replace('.m3u8', '.php', $m3u8FileContent);
        Storage::disk('videos')->put($fileNameHLS.'/video.m3u8', $m3u8FileContent);

        Storage::disk('videos')->move($fileNameHLS.'/'.$m3u8FileName, $fileNameHLS.'/'.pathinfo($fileNameHLS.'/'.$m3u8FileName, PATHINFO_FILENAME).'.php');
       
        return $lesson;
    }

    public function getLessonById($id)
    {
        return $this->lessonRepository->getLessonById($id);
    }

    public function deleteLessonById($id)
    {
        $lesson = $this->getLessonById($id);

        Storage::deleteDirectory(public_path(dirname('app/videos/'.$lesson->content)));

        $lesson->delete();
    }
}




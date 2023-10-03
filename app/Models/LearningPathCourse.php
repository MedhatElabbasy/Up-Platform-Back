<?php

namespace App\Models;

use App\Models\Course;
use App\Models\LearningPath;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPathCourse extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'learning_path_id'];
    #### Relation ###
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_id');
    }

    public function learningPath()
    {
        return $this->belongsTo(LearningPath::class, 'learning_path_id');
    }
}
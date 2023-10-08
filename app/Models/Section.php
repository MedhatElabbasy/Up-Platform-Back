<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'course_id'];

    #### Relation ###
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    

    // public function lessons()
    // {
    //     return $this->hasMany(Lesson::class);
    // }

}
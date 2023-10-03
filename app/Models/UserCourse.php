<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCourse extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'course_id', 'lesson_id'];
    #### Relation ###
    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'lesson_id');
    }
}
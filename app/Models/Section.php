<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];
    #### Relation ###
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    // public function lessons()
    // {
    //     return $this->hasMany(Lesson::class);
    // }

}
<?php

namespace App\Models;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'exam_id'];
    #### Relation ###
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
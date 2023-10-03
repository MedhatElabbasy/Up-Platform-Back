<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'correct', 'question_id'];

#### Relation ###
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

}
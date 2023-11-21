<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuggestedPathTestAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo(SuggestedPathTest::class, 'question_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuggestedPathTest extends Model
{
    use HasFactory;

    protected $table = 'suggested_path_test';
    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany(SuggestedPathTestAnswer::class, "question_id");
    }
}

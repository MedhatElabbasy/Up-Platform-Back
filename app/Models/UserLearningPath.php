<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLearningPath extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'learning_path_id'];
    #### Relation ###
    public function users()
    {
        return $this->belongsToMany(User::class, 'users');
    }

    public function leaningPathes()
    {
        return $this->belongsToMany(User::class, 'learning_paths');
    }
}
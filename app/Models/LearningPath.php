<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPath extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'category_id'];
    #### Relation ###
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
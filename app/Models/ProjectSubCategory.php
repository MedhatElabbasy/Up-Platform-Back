<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubCategory extends Model
{
    use HasFactory;

    protected $table = "project_subcategories";

    protected $fillable = [
        "name",
        "description",
        "category_id",
        "cost_from",
        "cost_to",
    ];
}

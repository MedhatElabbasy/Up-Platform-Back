<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMarktingAdLike extends Model
{
    use HasFactory;
    protected $table = "project_marketing_ad_likes";

    protected $fillable = [
        "marketing_product_ad_id",
        "user_id",
    ];
}

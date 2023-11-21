<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMarketingAds extends Model
{
    use HasFactory;

    protected $fillable = [
        "project_id",
        "project_markting_product_id",
        "name",
        "image",
        "video",
        "link",
    ];

    public function likes(){
        return $this->hasMany(ProjectMarktingAdLike::class, 'marketing_product_ad_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'project_category_id',
        'project_subcategory_id',
        'current_step',
        'project_points_id',
    ];

    public function category(){
        return $this->hasOne(ProjectCategory::class);
    }

    public function subcategory(){
        return $this->hasOne(ProjectSubCategory::class);
    }

    public function points(){
        return $this->hasOne(ProjectPoint::class);
    }

    public function caseStudyNote(){
        return $this->hasOne(ProjectCaseStudyNote::class);
    }

    public function caseStudy(){
        return $this->hasOne(ProjectCaseStudy::class);
    }

    public function purchases(){
        return $this->hasMany(ProjectPurchase::class);
    }

    public function marktingProducts(){
        return $this->hasMany(ProjectMarktingProduct::class);
    }

    public function marktingAds(){
        return $this->hasMany(ProjectMarketingAds::class);
    }
}

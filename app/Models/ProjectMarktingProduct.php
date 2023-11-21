<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMarktingProduct extends Model
{
    use HasFactory;

    protected $table = "project_marketing_products";

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'profit',
    ];

    public function marktingAds(){
        return $this->hasMany(ProjectMarketingAds::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity_Category extends Model
{
    use HasFactory;
    protected $table = "opportunities_categories";
    protected $fillable = [
        "opp_cat_name",
        "opp_cat_desc",
    ] ;

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, "category_id");
    }

}
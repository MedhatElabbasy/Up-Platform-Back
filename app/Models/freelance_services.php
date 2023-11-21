<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freelance_services extends Model
{
    use HasFactory;
    protected $table="freelance_services";
    protected $fillable = [
        "free_service_name",
        "free_service_desc",
        "free_jobtitle",
        "service_category",
        "free_service_skills",
        "service_location",
        "service_image",
        "service_cost_from",
        "service_cost_to",
        "user_id",

     


    ] ; 

}

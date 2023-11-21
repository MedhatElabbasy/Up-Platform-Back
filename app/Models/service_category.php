<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_category extends Model
{
    use HasFactory;
    protected $table="service_category";
    protected $fillable = [
        "scategory_name",
        "scategory_description",

    ] ; 


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_applications extends Model
{
    use HasFactory;
    protected $table="service_applications";
    protected $fillable = [
        "user_id",
        "service_id",
     
    ] ;

}

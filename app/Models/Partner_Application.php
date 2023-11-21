<?php

namespace App\Models;

use App\Models\User;
use App\Models\Partnership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner_Application extends Model
{
    use HasFactory;
    protected $table="partner_applications";
    protected $fillable = [
        "user_id",
        "part_id",
        "part_date_submit",


    ];

    //relation
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function partner(){
        return $this->belongsTo(Partnership::class,"part_id");
    }


}
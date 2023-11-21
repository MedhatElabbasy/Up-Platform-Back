<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantPackageDetail extends Model
{
    protected $table = 'consultant_package_details';
    protected $fillable = ['text_consultation_description','text_consultation_price','online_consultation_description','online_consultation_price'];
    
   // Define the relationship with the User model
   public function user()
   {
       return $this->belongsTo(User::class);
   }
}

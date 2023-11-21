<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultantedu extends Model
{
    protected $table = 'consultant_education'; 
    protected $fillable = ['degree', 'institution', 'start_date', 'end_date'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

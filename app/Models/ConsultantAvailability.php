<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantAvailability extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'start_time', 'end_time'];

    // Define the relationship with the Consultant model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantAppointmentRequest extends Model
{
    protected $table = 'consultant_appointment_requests'; 
    protected $fillable = ['user_id', 'receiver_id', 'message', 'appointment_date', 'appointment_time'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}



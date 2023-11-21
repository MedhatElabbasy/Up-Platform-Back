<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClubEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubEventUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'club_event_id',
        'attendance',
        'created_at'
    ];

    // public function clubEvent()
    // {
    //     return $this->belongsTo(ClubEvent::class);
    // }

    public function clubEvents()
    {
        return $this->belongsToMany(ClubEvent::class,'club_events');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
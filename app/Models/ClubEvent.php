<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'rouls',
        'location',
        'price',
        'start_at',
        'end_at',
        'created_at'
    ];



    public function users()
    {
        return $this->belongsToMany(User::class, 'club_event_users');
    }

}

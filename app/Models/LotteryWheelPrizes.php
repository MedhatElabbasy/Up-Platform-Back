<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryWheelPrizes extends Model
{
    use HasFactory;

    protected $table = "lottery_wheels_prizes";

    protected $fillable = [
        'points',
        'probability',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LotteryWheelPrizes;

class LotteryWheel extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
        'user_id',
        'lottery_wheel_prize_id'
    ];

    public function prize()
    {
        $this->hasOne(LotteryWheelPrizes::class);
    }
}

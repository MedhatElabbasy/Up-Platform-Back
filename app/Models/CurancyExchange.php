<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurancyExchange extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'code',
        'symbol',
        'value_by_cap'
    ];

    public function exchange($amount){
        return floatval($amount / $this->first()->value_by_cap);
    }

    public function toCap($amount){
        return floatval($amount * $this->first()->value_by_cap);
    }
}

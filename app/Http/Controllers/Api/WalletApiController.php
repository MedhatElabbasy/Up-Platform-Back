<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurancyExchange;

class WalletApiController extends Controller
{
    /*
    * Retive balance of wallet 
    *  
    */
    public function index(){
        $balance = auth()->user()->balance;
        return response()->json([
            'success' => true,
            "sr" => floatval($balance),
            "cap" => (new CurancyExchange)->exchange($balance)
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CurancyExchange;
use App\Models\LotteryWheelPrizes;
use App\Http\Controllers\Controller;

class LotteryWheelApiController extends Controller
{
    /*
    * Get all prizes of wheel
    *
    */
    public function prizes(){
        return LotteryWheelPrizes::all();
    }

    /*
    * Is it allowed to spine the wheel or not?
    *
    */
    public function index(){
        app()->setlocale(request()->server('HTTP_ACCEPT_LANGUAGE'));

        $lotteryWheel = auth()->user()->lotteryWheel->where('user_id', auth()->user()->id);

        if($lotteryWheel){
            $latest = $lotteryWheel->latest()->first();
            $latest_date = $latest->created_at->format('Y-m-d') ?? false;
            $latest_time = $latest->created_at->format('H:i:s') ?? false;
        }else{
            $latest_date = false;
            $latest_time = false;
        }

        $prizes = LotteryWheelPrizes::get();

        $weekly_log = [];
        if($lotteryWheel){
            foreach($prizes as $prize)
                $weekly_log[$prize->id] = $lotteryWheel->where('lottery_wheel_prize_id', $prize->id)->whereDate('created_at', '>', now()->subWeek())->count() ?? 0;
        }

        $allow = auth()->user()->lotteryWheel()->whereDate('created_at', now()->format('Y-m-d'))->exists();

        if($allow){
            return response()->json([
                'success' => false,
                'message' => 'Try tomorrow',
                "weekly_log" => $weekly_log,
                'latest_date' => [
                    'day' => $latest_date,
                    'time' => $latest_time
                ],
            ]);
        };

        return response()->json([
            'success' => true,
            "allow" => true,
            "weekly_log" => $weekly_log,
            'latest_date' => [
                'day' => $latest_date,
                'time' => $latest_time
            ],
        ]);
    }

    /*
    * Insert lottery wheel operation
    *
    */
    public function store(Request $request){
        if($request->type == 'balance') return $this->storeWithBalance($request);

        $allow = auth()->user()->lotteryWheel()->whereDate('created_at', now()->format('Y-m-d'))->exists();

        if($allow){
            return response()->json([
                'success' => false,
                'message' => 'Try tomorrow',
            ]);
        };

        // Get prize
        $prize = LotteryWheelPrizes::findOrFail($request->prize_id);

        // Insert lottery wheel operation
        auth()->user()->lotteryWheel()->create([
            'lottery_wheel_prize_id' => $prize->id,
            'balance' => (new CurancyExchange)->toCap($prize->points)
        ]);

        // Increment balance
        auth()->user()->increment('balance', (new CurancyExchange)->toCap($prize->points));

        return response()->json([
            'success' => true,
            "message" => "done successfully"
        ], 200);
    }

    /*
    * Insert lottery wheel operation with balance
    *
    */
    public function storeWithBalance(Request $request){
        $balance = (new CurancyExchange)->exchange(3);
        $times = 3;

        $allow = auth()->user()->lotteryWheel()->where('balance', '>', 0)->whereDate('created_at', now()->format('Y-m-d'))->count();
        if($allow > $times)
             return response()->json([
                'success' => false,
                'message' => 'You cannot try again more than 3 times in 24 hours',
            ]);

        if(auth()->user()->balance < $balance)
            return response()->json([
                'success' => false,
                'message' => 'The balance is not enough',
            ]);

            // Get prize
        $prize = LotteryWheelPrizes::findOrFail($request->prize_id);

        // Insert lottery wheel operation
        auth()->user()->lotteryWheel()->create([
            'lottery_wheel_prize_id' => $prize->id,
            'balance' => (new CurancyExchange)->toCap($prize->points)
        ]);

        // Increment balance
        auth()->user()->increment('balance', ((new CurancyExchange)->toCap($prize->points) - $balance));

        return response()->json([
            'success' => true,
            "message" => "done successfully"
        ], 200);
    }
}

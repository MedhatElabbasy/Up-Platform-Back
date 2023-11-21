<?php

namespace App\Http\Controllers\Prize;

use Illuminate\Http\Request;
use App\Models\LotteryWheelPrizes;
use App\Http\Controllers\Controller;

class WhellPrizeController extends Controller
{
    public function index(){

        $wheelPrize=LotteryWheelPrizes::all();
        return view('prizes.whell.index-prize-list',compact('wheelPrize'));
    }

//////////////
    public function create()
    {
        return view('prizes.whell.create');
    }
/////////////
    public function store(Request $request)
    {
        // Validate and store the newly created record
        $validatedData = $request->validate([
            'points' => 'required',
            'probability' => 'required',
        ]);

        LotteryWheelPrizes::create($validatedData);
        return redirect()->route('whell.index_prize');
    }
///////////
    public function edit($id)
    {
        $wheelPrize = LotteryWheelPrizes::findOrFail($id);
        return view('prizes.whell.edit', compact('wheelPrize'));
    }
/////////////
    public function update(Request $request, $id)
    {
        // Validate and update the existing record
        $validatedData = $request->validate([
            'points' => 'required',
            'probability' => 'required',
        ]);

        $wheelPrize = LotteryWheelPrizes::findOrFail($id);
        $wheelPrize->update($validatedData);
        return redirect()->route('whell.index_prize');
    }

    public function destroy($id)
    {
        $wheelPrize = LotteryWheelPrizes::findOrFail($id);
        $wheelPrize->delete();
        return redirect()->route('whell.index_prize');
    }
}
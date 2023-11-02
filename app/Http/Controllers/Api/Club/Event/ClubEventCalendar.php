<?php

namespace App\Http\Controllers\Api\Club\Event;

use App\Http\Controllers\Controller;
use App\Models\ClubEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClubEventCalendar extends Controller
{
    public function index(Request $request)
    {

        $startDate = Carbon::now();
        $endDate = Carbon::now();
        $period=$request->input('period');
        if ($period == 'week' && $request->input('week')) {
            $startDate->startOfWeek();
            $endDate->endOfWeek();
        } elseif ($period == 'month' && $request->input('month')) {
            $startDate->startOfMonth();
            $endDate->endOfMonth();
        } elseif ($period == 'day' && $request->input('day')) {
            $startDate->startOfDay();
            $endDate->endOfDay();
        } else {
            return response()->json(['error' => 'Invalid period'], 400);
        }

        $events = ClubEvent::whereBetween('created_at', [$startDate, $endDate])->get();

        return response()->json($events);
    }

    //
    // public function eventsCalender(Request $request)
    // {
    //     $year = $request->input('year');
    //     $month = $request->input('month');
    //     $day = $request->input('day');

    //     // $calendar = Calendar::where('year', $year)
    //     //     ->where('month', $month)
    //     //     ->where('day', $day)
    //     //     ->first();

    //     $calendar = ClubEvent::where('year', $year)
    //         ->where('month', $month)
    //         ->where('day', $day)
    //         ->first();

    //     if (!$calendar) {
    //         return response()->json(['error' => 'Invalid date'], 400);
    //     }

    //     $events = ClubEvent::whereDate('created_at', $calendar->created_at)
    //         ->get();

    //     return response()->json($events);
    // }

}
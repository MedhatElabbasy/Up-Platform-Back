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

        $duration = $request->input('duration');

        switch ($duration) {
            case 7:
                $startDate->addDays(7);
                break;
            case 14:
                $startDate->addDays(14);
                break;
            case 21:
                $startDate->addDays(21);
                break;
            case 30:
                $startDate->addDays(30);
                break;
            default:
            $events = ClubEvent::all();
            return response()->json([
                'data' => $events,
                'count' => $events->count(),
                'success' => true
            ]);
        }

        $events = ClubEvent::whereBetween('start_at', [ $endDate,$startDate])->get();

        if ($events->count() > 0) {
            return response()->json([
                'data' => $events,
                'count' => $events->count(),
                'success' => true
            ]);
        } else {
            return response()->json([
                'message' => 'No club events found for the specified duration.',
                'success' => false
            ]);
        }
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

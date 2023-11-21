<?php

namespace App\Http\Controllers\Club;

use App\Models\ClubEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CLubEventListController extends Controller
{
    public function index()
    {
        $clubEvents = ClubEvent::all();
        return view('club.event.index', compact('clubEvents'));
    }

    public function create()
    {
        return view('club.event.create');
    }

    public function store(Request $request)
    {
        $clubEvent = new ClubEvent;
        $clubEvent->title = $request->title;
        $clubEvent->price = $request->price;
        $clubEvent->description = $request->description;
        $clubEvent->rouls = $request->rouls;
        $clubEvent->location = $request->location;
        $clubEvent->save();

        return redirect()->route('club_events.index');
    }

    // public function show(ClubEvent $club_event)
    // {
    //     return view('club_events.show', compact('club_event'));
    // }

    public function edit( $id)

    {
        $club_event=ClubEvent::find($id);
        return view('club.event.edit', compact('club_event'));
    }

    public function update(Request $request,  $id)
    {

         $club_event=ClubEvent::find($id);
        $club_event->title = $request->title;
        $club_event->price = $request->price;
        $club_event->description = $request->description;
        $club_event->rouls = $request->rouls;
        $club_event->location = $request->location;
        $club_event->save();

        return redirect()->route('club_events.index');
    }

    public function destroy(ClubEvent $club_event)
    {
        $club_event->delete();

        return redirect()->route('club_events.index');
    }
}
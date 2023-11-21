<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use App\Models\ClubEvent;
use App\Models\User;

class CLubEventUsersListController extends Controller
{
    public function index()
    {

        $users = User::with('clubEvents')
            ->whereHas('clubEvents')
            ->get();
        return view('club.event-user-list.index', compact('users'));
    }

    ///delete user from event

    public function destroy($eventId, $userId)
    {
        $event = ClubEvent::find($eventId);
        $user = User::find($userId);

        if (!$event || !$user) {
            return ;
        }

        $event->users()->detach($userId);

        return redirect()->route('club_events.user.index');
    }
}

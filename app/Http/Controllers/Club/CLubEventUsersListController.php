<?php

namespace App\Http\Controllers\Club;

use App\Models\User;
use App\Models\ClubEvent;
use App\Http\Controllers\Controller;

class CLubEventUsersListController extends Controller
{
    public function index()
    {
        $users = User::whereHas('clubEvents')->select('name','phone',)->with('clubEvents')->get();


        return view('club.event-user-list.index', compact('users'));
    }
}

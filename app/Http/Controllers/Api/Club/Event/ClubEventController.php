<?php

namespace App\Http\Controllers\Api\Club\Event;

use App\Http\Controllers\Controller;
use App\Models\ClubEvent;
use App\Models\ClubEventUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;
use App\Models\User;





class ClubEventController extends Controller
{

    public function __construct()
    {
        //delete user after payment month
        $oneMonthAgo = Carbon::now()->subMonth();

        $users = ClubEventUser::where('is_payment', true)
            ->where('created_at', '<=', $oneMonthAgo)
            ->get();

        foreach ($users as $user) {
            $user->delete();
        }

    }
    /**
     * Display a listing of the resource.
     */
     /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $clubEvents = ClubEvent::all();

        return response()->json($clubEvents, 200);
    }
    ////////////// Display all locations
    public function showLocations()
    {
        $locations = ClubEvent::pluck('location')->unique();

        return response()->json($locations,200);
    }


    ////// Display events by location
    public function showEventsByLocation(Request $request)
    {
        
      
        // $location = $request->input('location');

        // $events = ClubEvent::where('location', $location)
        //     ->get();
        //     if ( $events==null) {
        //         return response()->json('no events founded in this location',200);
        //     }

        // return response()->json($events,200);
        
         $location = $request->input('location');

        $events = ClubEvent::where('location', $location)->get();

        return response()->json($events, 200);
    }

        ////// Display all users  in events
        public function showUsersInEvents()
        {
           
        //       $usersInEvents = ClubEventUser::with('user', 'clubEvent')->get();

        // return response()->json($usersInEvents, 200);
        
         $usersInEvents = ClubEventUser::with('user')->get()->pluck('user');


        return response()->json($usersInEvents, 200);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rouls' => 'nullable',
            'location' => 'required',
        ]);

        $clubEvent = ClubEvent::create($validatedData);

        return response()->json($clubEvent, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClubEvent $clubEvent)
    {
        $clubEvent = ClubEvent::findOrFail($clubEvent->id);

        return response()->json($clubEvent, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClubEvent $clubEvent)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rouls' => 'nullable',
            'location' => 'required',
        ]);

        $clubEvent = ClubEvent::findOrFail($clubEvent->id);
        $clubEvent->update($validatedData);

        return response()->json($clubEvent, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClubEvent $clubEvent)
    {
        $clubEvent = ClubEvent::findOrFail($clubEvent->id);
        $clubEvent->delete();
        return response()->json(null, 204);
    }

    public function getUsersInEvent($id)
    {
        $clubEvent = ClubEvent::findOrFail($id);

        $users = $clubEvent->users;
        // check user null
        // if (isEmpty($users)) {
        //     $msg = 'No users found';
        //     return response()->json($msg, 200);
        // }
        return response()->json($users, 200);

        // dd( $users);

    }
    
    ///// all events fro user 
    public function getEventsForUser(Request $request, $userId)
{
  $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Get the events associated with the user
    $events = $user->clubEvents;

    return response()->json($events, 200);
}
}

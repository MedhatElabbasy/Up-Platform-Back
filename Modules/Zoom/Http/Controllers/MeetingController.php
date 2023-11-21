<?php

namespace Modules\Zoom\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Modules\VirtualClass\Entities\VirtualClass;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Entities\ZoomMeetingUser;
use Modules\Zoom\Entities\ZoomSetting;

//use Zoom;

class MeetingController extends Controller
{
    protected $account_id, $client_id, $password;

    public function __construct()
    {
        if (Auth::check()) {
            $setting = ZoomSetting::where('user_id', Auth::id())->first();
            $this->account_id = $setting->zoom_account_id ?? '';
            $this->client_id = $setting->zoom_client_id ?? '';
            $this->password = $setting->zoom_client_secret ?? '';

        }

    }

//    public function __construct()
//    {
//        Artisan::call('config:clear');
//    }
//
//    public function about()
//    {
//        $module = 'Zoom';
//
//        return $module;
//    }

    public function index()
    {

        $data = $this->defaultPageData();
        $data['user'] = Auth::user();
        $data['instructors'] = User::select('id', 'name')->whereIn('role_id', [1, 2])->get();
        $data['classes'] = VirtualClass::select('id', 'title')->where('host', 'Zoom')->latest()->get();
        return view('zoom::meeting.meeting', $data);
    }

    private function defaultPageData()
    {
        $user = Auth::user();
        $data['default_settings'] = ZoomSetting::firstOrCreate([
            'user_id' => $user->id
        ], [
            '$user->id' => $user->id,
        ]);


        if (Auth::user()->role_id == 1) {
            $data['meetings'] = ZoomMeeting::orderBy('id', 'DESC')->get();
        } else {
            $data['meetings'] = ZoomMeeting::orderBy('id', 'DESC')->whereHas('participates', function ($query) {
                return $query->where('user_id', Auth::user()->id);
            })
                ->where('status', 1)
                ->get();
        }
        return $data;
    }

    public function meetingStart($id)
    {
        try {
            $meeting = ZoomMeeting::where('meeting_id', $id)->first();
            if (!$meeting->currentStatus == 'started') {
                Toastr::error('Class not yet start, try later', 'Failed');
                return redirect()->back();
            }
            if (!$meeting->currentStatus == 'closed') {
                Toastr::error('Class are closed', 'Failed');
                return redirect()->back();
            }

            return redirect($meeting->url . '?pwd=' . $meeting->password);

        } catch (Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

    public function createZoomToken()
    {
        $response = Http::withBasicAuth($this->client_id, $this->password)->post('https://zoom.us/oauth/token?grant_type=account_credentials&account_id=' . $this->account_id)->json();

        return $response['access_token'] ?? '';
    }

//    /**
//     * Store a newly created resource in storage.
//     * @param Request $request
//     * @return RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        if (Auth::user()->role_id == 1) {
//            $instructor_id = $request->get('instructor_id');
//        } else {
//            $instructor_id = Auth::user()->id;
//        }
//
//        $class_id = $request->get('class_id');
//
//        $rules = [
//
//            'class_id' => 'required',
//            'topic' => 'required',
//            'description' => 'nullable',
//            'password' => 'required',
//            'attached_file' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx',
//            'time' => 'required',
//            'durration' => 'required',
//            'join_before_host' => 'required',
//            'host_video' => 'required',
//            'participant_video' => 'required',
//            'mute_upon_entry' => 'required',
//            'waiting_room' => 'required',
//            'audio' => 'required',
//            'auto_recording' => 'nullable',
//            'approval_type' => 'required',
//            'is_recurring' => 'required',
//            'recurring_type' => 'required_if:is_recurring,1',
//            'recurring_repect_day' => 'required_if:is_recurring,1',
//            'recurring_end_date' => 'required_if:is_recurring,1',
//        ];
//        $this->validate($request, $rules, validationMessage($rules));
//
//        try {
//            //Available time check for classs
//            if ($this->isTimeAvailableForMeeting($request, $id = 0)) {
//                Toastr::error('Virtual class time is not available for teacher and student!', 'Failed');
//                return redirect()->back();
//            }
//
//            //Chekc the number of api request by today max limit 100 request
//            if (ZoomMeeting::whereDate('created_at', Carbon::now())->count('id') >= 100) {
//                Toastr::error('You can not create more than 100 meeting within 24 hour!', 'Failed');
//                return redirect()->back();
//            }
//
//
//            $users = Zoom::user()->where('status', 'active')->setPaginate(false)->setPerPage(300)->get()->toArray();
//
//            $profile = $users['data'][0];
//            $start_date = Carbon::parse($request['date'])->format('Y-m-d') . ' ' . date("H:i:s", strtotime($request['time']));
//            $meeting = Zoom::meeting()->make([
//                "topic" => $request['topic'],
//                "type" => $request['is_recurring'] == 1 ? 8 : 2,
//                "duration" => $request['durration'],
//                "timezone" => Settings('active_time_zone'),
//                "password" => $request['password'],
//                "start_time" => new Carbon($start_date),
//            ]);
//
//            $meeting->settings()->make([
//                'join_before_host' => $this->setTrueFalseStatus($request['join_before_host']),
//                'host_video' => $this->setTrueFalseStatus($request['host_video']),
//                'participant_video' => $this->setTrueFalseStatus($request['participant_video']),
//                'mute_upon_entry' => $this->setTrueFalseStatus($request['mute_upon_entry']),
//                'waiting_room' => $this->setTrueFalseStatus($request['waiting_room']),
//                'audio' => $request['audio'],
//                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
//                'approval_type' => $request['approval_type'],
//            ]);
//
//            if ($request['is_recurring'] == 1) {
//                $end_date = Carbon::parse($request['recurring_end_date'])->endOfDay();
//                $meeting->recurrence()->make([
//                    'type' => $request['recurring_type'],
//                    'repeat_interval' => $request['recurring_repect_day'],
//                    'end_date_time' => $end_date
//                ]);
//            }
//            $meeting_details = Zoom::user()->find($profile['id'])->meetings()->save($meeting);
//
//            DB::beginTransaction();
//            $fileName = "";
//            if ($request->file('attached_file') != "") {
//                $file = $request->file('attached_file');
//                $ignore = strtolower($file->getClientOriginalExtension());
//                if ($ignore != 'php') {
//                    $fileName = $request['topic'] . time() . "." . $file->getClientOriginalExtension();
//                    $file->move('public/uploads/zoom-meeting/', $fileName);
//                    $fileName = 'public/uploads/zoom-meeting/' . $fileName;
//                }
//            }
//            $system_meeting = ZoomMeeting::create([
//                'topic' => $request['topic'],
//                'instructor_id' => $instructor_id,
//                'class_id' => $class_id,
//                'description' => $request['description'],
//                'date_of_meeting' => $request['date'],
//                'time_of_meeting' => $request['time'],
//                'meeting_duration' => $request['durration'],
//
//                'host_video' => $request['host_video'],
//                'participant_video' => $request['participant_video'],
//                'join_before_host' => $request['join_before_host'],
//                'mute_upon_entry' => $request['mute_upon_entry'],
//                'waiting_room' => $request['waiting_room'],
//                'audio' => $request['audio'],
//                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
//                'approval_type' => $request['approval_type'],
//
//                'is_recurring' => $request['is_recurring'],
//                'recurring_type' => $request['is_recurring'] == 1 ? $request['recurring_type'] : null,
//                'recurring_repect_day' => $request['is_recurring'] == 1 ? $request['recurring_repect_day'] : null,
//                'recurring_end_date' => $request['is_recurring'] == 1 ? $request['recurring_end_date'] : null,
//                'meeting_id' => $meeting_details->id,
//                'password' => $meeting_details->password,
//                'start_time' => Carbon::parse($start_date)->toDateTimeString(),
//                'end_time' => Carbon::parse($start_date)->addMinute($request['durration'])->toDateTimeString(),
//                'attached_file' => $fileName,
//                'created_by' => Auth::user()->id,
//            ]);
//
//
//            $user = new ZoomMeetingUser();
//            $user->meeting_id = $system_meeting->id;
//            $user->user_id = $instructor_id;
//            $user->host = 1;
//            $user->save();
//
//            DB::commit();
//
//            if ($system_meeting) {
//                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
//                return redirect()->back();
//            } else {
//                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
//                return redirect()->back();
//            }
//        } catch (Exception $e) {
//
//            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
//        }
//    }


    public function classStore($token, $data)
    {


        try {
            $start_date = Carbon::parse($data['date'])->format('Y-m-d') . ' ' . date("H:i:s", strtotime($data['time']));

            $zoomData = [
                "topic" => $data['topic'],
                "type" => $data['is_recurring'] == 1 ? 8 : 2,
                "duration" => $data['duration'],
                "timezone" => Settings('active_time_zone'),
                "password" => $data['password'],
                "start_time" => new Carbon($start_date),
                "agenda" => 'LiveClass',
                "settings" => [
                    'join_before_host' => $this->setTrueFalseStatus($data['join_before_host']),
                    'host_video' => $this->setTrueFalseStatus($data['host_video']),
                    'participant_video' => $this->setTrueFalseStatus($data['participant_video']),
                    'mute_upon_entry' => $this->setTrueFalseStatus($data['mute_upon_entry']),
                    'waiting_room' => $this->setTrueFalseStatus($data['waiting_room']),
                    'audio' => $data['audio'],
                    'auto_recording' => $data['auto_recording'] ? $data['auto_recording'] : 'none',
                    'approval_type' => $data['approval_type'],
                ]
            ];

            if ($data['is_recurring'] == 1) {
                $end_date = Carbon::parse($data['recurring_end_date'])->endOfDay();
                $zoomData['recurrence'] = [
                    'type' => $data['recurring_type'],
                    'repeat_interval' => $data['recurring_repect_day'],
                    'end_date_time' => $end_date
                ];
            }

            $meeting_details = (object)Http::withToken($token)->post('https://api.zoom.us/v2/users/me/meetings', $zoomData)->json();
            
            if(isset($meeting_details->code) && $meeting_details->code==429){
                $result['message'] = $meeting_details->message;
                $result['type'] = false;
                return $result;
            }
            
            $result['message'] = '';
            $result['type'] = false;
            $system_meeting = null;
            if ($meeting_details) {
                $meeting_id = $meeting_details->id ?? null;
                $system_meeting = new ZoomMeeting();
                $system_meeting->join_url = $meeting_details->join_url;
                $system_meeting->start_url = $meeting_details->start_url;
                $system_meeting->topic = $data['topic'];
                $system_meeting->instructor_id = request('assign_instructor') ?? $data['instructor_id'];
                $system_meeting->class_id = $data['class_id'];
                $system_meeting->description = $data['description'];
                $system_meeting->date_of_meeting = $data['date'];
                $system_meeting->time_of_meeting = $data['time'];
                $system_meeting->meeting_duration = $data['duration'];
                $system_meeting->host_video = $data['host_video'];
                $system_meeting->participant_video = $data['participant_video'];
                $system_meeting->join_before_host = $data['join_before_host'];
                $system_meeting->mute_upon_entry = $data['mute_upon_entry'];
                $system_meeting->waiting_room = $data['waiting_room'];
                $system_meeting->audio = $data['audio'];
                $system_meeting->auto_recording = $data['auto_recording'];
                $system_meeting->approval_type = $data['approval_type'];
                $system_meeting->is_recurring = $data['is_recurring'];
                $system_meeting->recurring_type = $data['is_recurring'] == 1 ? $data['recurring_type'] : null;
                $system_meeting->recurring_repect_day = $data['is_recurring'] == 1 ? $data['recurring_repect_day'] : null;
                $system_meeting->recurring_end_date = $data['is_recurring'] == 1 ? $data['recurring_end_date'] : null;
                $system_meeting->meeting_id = strval($meeting_id);
                $system_meeting->password = $meeting_details->password;
                $system_meeting->start_time = Carbon::parse($start_date)->toDateTimeString();
                $system_meeting->end_time = Carbon::parse($start_date)->addMinute($data['duration'])->toDateTimeString();
                $system_meeting->attached_file = $data['attached_file'];
                $system_meeting->created_by = Auth::user()->id;
                $system_meeting->save();

                $user = new ZoomMeetingUser();
                $user->meeting_id = $system_meeting->id;
                $user->user_id = Auth::user()->id;
                $user->host = 1;
                $user->save();
            }

            if ($system_meeting) {
                $result['message'] = '';
                $result['type'] = true;
            }
            return $result;

        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
            $result['type'] = false;
            return $result;
        }
    }


//    private function isTimeAvailableForMeeting($request, $id)
//    {
//
//        if (isset($request['participate_ids'])) {
//            $teacherList = $request['participate_ids'];
//        } else {
//            $teacherList = [Auth::user()->id];
//        }
//
//        if ($id != 0) {
//            $meetings = ZoomMeeting::where('date_of_meeting', Carbon::parse($request['date'])->format("m/d/Y"))
//                ->where('id', '!=', $id)
//                ->whereHas('participates', function ($q) use ($teacherList) {
//                    $q->whereIn('user_id', $teacherList);
//                })
//                ->get();
//        } else {
//            $meetings = ZoomMeeting::where('date_of_meeting', Carbon::parse($request['date'])->format("m/d/Y"))
//                ->whereHas('participates', function ($q) use ($teacherList) {
//                    $q->whereIn('user_id', $teacherList);
//                })
//                ->get();
//        }
//        if ($meetings->count() == 0) {
//            return false;
//        }
//        $checkList = [];
//
//        foreach ($meetings as $key => $meeting) {
//            $new_time = Carbon::parse($request['date'] . ' ' . date("H:i:s", strtotime($request['time'])));
//            if ($new_time->between(Carbon::parse($meeting->start_time), Carbon::parse($meeting->end_time))) {
//                array_push($checkList, $meeting->time_of_meeting);
//            }
//        }
//        if (count($checkList) > 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    private function setTrueFalseStatus($value)
    {
        if ($value == 1) {
            return true;
        }
        return false;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Application|Factory|RedirectResponse|View
     */
//    public function show($id)
//    {
//
//        try {
//            $localMeetingData = ZoomMeeting::where('meeting_id', $id)->first();
//
//            $results = Zoom::meeting()->find($id);
//            if ($localMeetingData) {
//                if ($results) {
//                    $results = $results->toArray();
//                }
//                return view('zoom::meeting.meetingDetails', compact('localMeetingData', 'results'));
//            } else {
//                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
//                return redirect()->back();
//            }
//        } catch (Exception $e) {
//            Toastr::error($e->getMessage(), trans('common.Failed'));
//            return redirect()->back();
//        }
//
//    }


//    public function edit($id)
//    {
//
//        try {
//            $data = $this->defaultPageData();
//            $data['editdata'] = ZoomMeeting::findOrFail($id);
//            $data['user'] = Auth::user();
//            $data['classes'] = VirtualClass::select('id', 'title')->where('host', 'Zoom')->latest()->get();
//            $data['instructors'] = User::select('id', 'name')->whereIn('role_id', [1, 2])->get();
//            $data['participate_ids'] = DB::table('zoom_meeting_users')->where('meeting_id', $id)->select('user_id')->pluck('user_id');
//
//            $data['user_type'] = $data['editdata']->participates[0]['role_id'];
//            $data['userList'] = User::where('role_id', $data['user_type'])
//                ->whereIn('id', $data['participate_ids'])
//                ->select('id', 'name', 'role_id')->get();
//            if (Auth::user()->role_id != 1) {
//                if (Auth::user()->id != $data['editdata']->created_by) {
//                    Toastr::error('Class is created by other, you could not modify !', 'Failed');
//                    return redirect()->back();
//                }
//            }
//            return view('zoom::meeting.meeting', $data);
//        } catch (Exception $e) {
//            Toastr::error($e->getMessage(), trans('common.Failed'));
//            return redirect()->back();
//        }
//    }


//    public function update(Request $request, $id)
//    {
//        if (Auth::user()->role_id == 1) {
//            $instructor_id = $request->get('instructor_id');
//        } else {
//            $instructor_id = Auth::user()->id;
//        }
//
//        $rules = [
//            'class_id' => 'required',
//            'topic' => 'required',
//            'description' => 'nullable',
//            'password' => 'required',
//            'attached_file' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx',
//            'time' => 'required',
//            'join_before_host' => 'required',
//            'host_video' => 'required',
//            'participant_video' => 'required',
//            'mute_upon_entry' => 'required',
//            'waiting_room' => 'required',
//            'audio' => 'required',
//            'auto_recording' => 'nullable',
//            'approval_type' => 'required',
//            'is_recurring' => 'required',
//            'recurring_type' => 'required_if:is_recurring,1',
//            'recurring_repect_day' => 'required_if:is_recurring,1',
//            'recurring_end_date' => 'required_if:is_recurring,1',
//        ];
//        $this->validate($request, $rules, validationMessage($rules));
//
//        try {
//            $system_meeting = ZoomMeeting::findOrFail($id);
//
////            if ($this->isTimeAvailableForMeeting($request, $id = $id)) {
////                Toastr::error('Virtual class time is not available !', 'Failed');
////                return redirect()->back();
////            }
//
//            $users = Zoom::user()->where('status', 'active')->setPaginate(false)->setPerPage(300)->get()->toArray();
//            $profile = $users['data'][0];
//            $start_date = Carbon::parse($request['date'])->format('Y-m-d') . ' ' . date("H:i:s", strtotime($request['time']));
//
//            $meeting = Zoom::meeting()->find($system_meeting->meeting_id);
//            if ($meeting) {
//                $meeting->make([
//                    "topic" => $request['topic'],
//                    "type" => $request['is_recurring'] == 1 ? 8 : 2,
//                    "duration" => $system_meeting->meeting_duration,
//                    "timezone" => Settings('active_time_zone'),
//                    "start_time" => new Carbon($start_date),
//                    "password" => $request['password'],
//                ]);
//            } else {
//                $meeting = Zoom::meeting()->make([
//                    "topic" => $request['topic'],
//                    "type" => $request['is_recurring'] == 1 ? 8 : 2,
//                    "duration" => $system_meeting->meeting_duration,
//                    "timezone" => Settings('active_time_zone'),
//                    "password" => $request['password'],
//                    "start_time" => new Carbon($start_date),
//                ]);
//            }
//
//
//            $meeting->settings()->make([
//                'join_before_host' => $this->setTrueFalseStatus($request['join_before_host']),
//                'host_video' => $this->setTrueFalseStatus($request['host_video']),
//                'participant_video' => $this->setTrueFalseStatus($request['participant_video']),
//                'mute_upon_entry' => $this->setTrueFalseStatus($request['mute_upon_entry']),
//                'waiting_room' => $this->setTrueFalseStatus($request['waiting_room']),
//                'audio' => $request['audio'],
//                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
//                'approval_type' => $request['approval_type'],
//            ]);
//
//            if ($request['is_recurring'] == 1) {
//                $end_date = Carbon::parse($request['recurring_end_date'])->endOfDay();
//                $meeting->recurrence()->make([
//                    'type' => $request['recurring_type'],
//                    'repeat_interval' => $request['recurring_repect_day'],
//                    'end_date_time' => $end_date
//                ]);
//            }
//
//            Zoom::user()->find($profile['id'])->meetings()->save($meeting);
//
//            DB::beginTransaction();
//
//            $system_meeting->update([
//                'instructor_id' => $instructor_id,
//                'class_id' => $request['class_id'],
//                'topic' => $request['topic'],
//                'description' => $request['description'],
//                'date_of_meeting' => Carbon::parse($request['date'])->format('m/d/Y'),
//                'time_of_meeting' => $request['time'],
//                'password' => $request['password'],
//
//                'host_video' => $request['host_video'],
//                'participant_video' => $request['participant_video'],
//                'join_before_host' => $request['join_before_host'],
//                'mute_upon_entry' => $request['mute_upon_entry'],
//                'waiting_room' => $request['waiting_room'],
//                'audio' => $request['audio'],
//                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
//                'approval_type' => $request['approval_type'],
//
//                'is_recurring' => $request['is_recurring'],
//                'recurring_type' => $request['is_recurring'] == 1 ? $request['recurring_type'] : null,
//                'recurring_repect_day' => $request['is_recurring'] == 1 ? $request['recurring_repect_day'] : null,
//                'recurring_end_date' => $request['is_recurring'] == 1 ? $request['recurring_end_date'] : null,
//
//                'updated_by' => Auth::user()->id,
//            ]);
//
//            if ($request->file('attached_file') != "") {
//                if (file_exists($system_meeting->attached_file)) {
//                    unlink($system_meeting->attached_file);
//                }
//                $file = $request->file('attached_file');
//                $ignore = strtolower($file->getClientOriginalExtension());
//                if ($ignore != 'php') {
//                    $fileName = $request['topic'] . time() . "." . $file->getClientOriginalExtension();
//                    $file->move('public/uploads/zoom-meeting/', $fileName);
//                    $fileName = 'public/uploads/zoom-meeting/' . $fileName;
//                    $system_meeting->update([
//                        'attached_file' => $fileName
//                    ]);
//                }
//            }
//
//            if (isset($request->instructor_id) && !empty($request->instructor_id)) {
//                ZoomMeetingUser::where('meeting_id', $id)->delete();
//                $zoomUser = new ZoomMeetingUser();
//                $zoomUser->meeting_id = $id;
//                $zoomUser->user_id = $request->instructor_id;
//                $zoomUser->host = 1;
//                $zoomUser->save();
//            }
//
//
//            DB::commit();
//            Toastr::success('Class updated successful', 'Success');
//            return redirect()->route('zoom.meetings');
//
//        } catch (Exception $e) {
//            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
//        }
//    }


    public function destroy($id)
    {
        try {
            $localMeeting = ZoomMeeting::findOrFail($id);
            $class = VirtualClass::where('id', $localMeeting->class_id)->first();
            if (Auth::user()->role_id != 1) {
                if (Auth::user()->id != $localMeeting->created_by) {
                    Toastr::error('Class is created by other, you could not DELETE !', 'Failed');
                    return redirect()->back();
                }
            }

            $meeting = new MeetingController();
            $token = $meeting->createZoomToken();

            $meeting = (object)Http::withToken($token)->delete('https://api.zoom.us/v2/users/me/meetings/', $localMeeting->meeting_id)->json();

            if (file_exists($localMeeting->attached_file)) {
                unlink($localMeeting->attached_file);
            }
            ZoomMeetingUser::where('meeting_id', $id)->delete();
            $localMeeting->delete();
            $class->total_class = $class->total_class - 1;
            $class->save();

            Toastr::success('Class deleted successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }
//
//
//    public function userWiseUserList(Request $request)
//    {
//        if ($request->has('user_type')) {
//            $userList = User::where('role_id', $request['user_type'])
//                ->select('id', 'name')->get();
//            return response()->json([
//                'users' => $userList
//            ]);
//        }
//    }
//
//    private function setNotificaiton($users, $role_id, $updateStatus)
//    {
//        $now = Carbon::now('utc')->toDateTimeString();
//        $notification_datas = [];
//
//        if ($updateStatus == 1) {
//            foreach ($users as $key => $user) {
//                array_push(
//                    $notification_datas,
//                    [
//                        'user_id' => $user,
//                        'role_id' => $role_id,
//                        'date' => date('Y-m-d'),
//                        'message' => 'Zoom meeting is updated by ' . Auth::user()->name . '',
//                        'url' => route('zoom.meetings'),
//                        'created_at' => $now,
//                        'updated_at' => $now
//                    ]
//                );
//            }
//        } else {
//            foreach ($users as $key => $user) {
//                array_push(
//                    $notification_datas,
//                    [
//                        'user_id' => $user,
//                        'role_id' => $role_id,
//                        'date' => date('Y-m-d'),
//                        'message' => 'Zoom meeting is created by ' . Auth::user()->name . ' with you',
//                        'url' => route('zoom.meetings'),
//                        'created_at' => $now,
//                        'updated_at' => $now
//                    ]
//                );
//            }
//        }
//
//    }
//
}

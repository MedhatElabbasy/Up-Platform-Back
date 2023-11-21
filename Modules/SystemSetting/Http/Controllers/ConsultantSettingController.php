<?php

namespace Modules\SystemSetting\Http\Controllers;

use App\Traits\ImageStore;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use App\Country;
use App\Models\Consultantedu;
use App\Models\ConsultantPackageDetail;
use App\Models\ConsultantMessageRequest;
use App\Subscription;
use Illuminate\Http\Request;
use DrewM\MailChimp\MailChimp;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Modules\Appointment\Repositories\Interfaces\AppointmentRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Modules\Newsletter\Entities\NewsletterSetting;
use Modules\Newsletter\Http\Controllers\AcelleController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MSGReplyMail;
use App\Mail\ZoomLinkMail;
use App\Models\ConsultantAppointmentRequest;
use App\Models\ConsultantAvailability;


class ConsultantSettingController extends Controller
{
    use ImageStore;

    public function index()
    {

        try {
            $consultants = [];
            $countries = Country::all();
            $user = Auth::user();
            return view('systemsetting::consultant', compact('consultants','countries','user'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        
        // if (saasPlanCheck('instructor')) {
        //     Toastr::error('You have reached instructor limit', trans('common.Failed'));
        //     return redirect()->back();
        // }
        // Session::flash('type', 'store');

        // if (demoCheck()) {
        //     return redirect()->back();
        // }


        $rules = [
            'name' => 'required',
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];


        $this->validate($request, $rules, validationMessage($rules));

        if (isModuleActive('Appointment')) {
            $slug = Str::slug($request->name);
            $exitUser = User::where('slug', $slug)->first();
            if ($exitUser) {
                $title = $request->name . '-' . substr(str_shuffle("qwertyuiopasdfghjklzxcvbnm"), 0, 4);
                $slug = Str::slug($title);
            }
        }

        try {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = null;
            $user->password = bcrypt($request->password);
            $user->about = $request->about;
            $user->dob = getPhpDateFormat($request->dob);

            if (empty($request->phone)) {
                $user->phone = null;
            } else {
                $user->phone = $request->phone;
            }
            $user->language_id =  3;
            $user->language_code = 'ar';
            $user->language_name = 'Arabic';
            $user->language_rtl = 1;
            $user->country = Settings('country_id');
            $user->facebook = $request->facebook;
            $user->twitter = $request->twitter;
            $user->linkedin = $request->linkedin;
            $user->instagram = $request->instagram;
            $user->added_by = Auth::user()->id;
            $user->email_verify = 1;
            $user->email_verified_at = now();
            $user->referral = generateUniqueId();
            if (isModuleActive('LmsSaas')) {
                $user->lms_id = app('institute')->id;
            } else {
                $user->lms_id = 1;
            }
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $user->image = $this->saveImage($file);
            }


            if (isModuleActive('Appointment')) {
                $age = $request->dob
                    ? Carbon::parse($request->dob)->diff(Carbon::now())->y : 0;

                $user->slug = $slug;
                $user->age = $age;
                $user->gender = $request->gender;
                $user->hour_rate = $request->hour_rate;
                $user->types = json_encode($request->type);
                $user->is_available = $request->available ? 1 : 0;
                $user->headline = $request->headline;
                $user->short_video_link = $request->video_link;
                $user->available_msg = $request->available_message;
            }

            $user->role_id = 14;
            if (isModuleActive('Organization') && Auth::user()->isOrganizationUser()) {
                $user->organization_id = Auth::user()->userOrganization()->id;
            }
          

            $user->save();
            $educationData = $request->input('education');

            $this->createEducationRecords($user, $educationData);

            $packageData = $request->input('packageDetails');
            
            $this->createPackageDetails($user, $packageData);

            if (isModuleActive('Appointment')) {
                $interface = App::make(AppointmentRepositoryInterface::class);
                $storeInstructorData = $interface->instructorStoreData($request->all(), $user->id);
            }
            applyDefaultRoleToUser($user);
            assignStaffToUser($user);

            if (Schema::hasTable('users') && Schema::hasTable('chat_statuses')) {
                if (isModuleActive('Chat')) {
                    userStatusChange($user->id, 0);
                }
            }


            $mailchimpStatus = saasEnv('MailChimp_Status') ?? false;
            $getResponseStatus = saasEnv('GET_RESPONSE_STATUS') ?? false;
            $acelleStatus = saasEnv('ACELLE_STATUS') ?? false;
            if (hasTable('newsletter_settings')) {
                $setting = NewsletterSetting::getData();


                if ($setting->instructor_status == 1) {
                    $list = $setting->instructor_list_id;
                    if ($setting->instructor_service == "Mailchimp") {

                        if ($mailchimpStatus) {
                            try {
                                $MailChimp = new MailChimp(saasEnv('MailChimp_API'));
                                $MailChimp->post("lists/$list/members", [
                                    'email_address' => $user->email,
                                    'status' => 'subscribed',
                                ]);

                            } catch (\Exception $e) {
                            }
                        }
                    } elseif ($setting->instructor_service == "GetResponse") {
                        if ($getResponseStatus) {

                            try {
                                $getResponse = new \GetResponse(saasEnv('GET_RESPONSE_API'));
                                $getResponse->addContact(array(
                                    'email' => $user->email,
                                    'campaign' => array('campaignId' => $list),
                                ));
                            } catch (\Exception $e) {

                            }
                        }
                    } elseif ($setting->instructor_service == "Acelle") {
                        if ($acelleStatus) {

                            try {
                                $email = $user->email;
                                $make_action_url = '/subscribers?list_uid=' . $list . '&EMAIL=' . $email;
                                $acelleController = new AcelleController();
                                $response = $acelleController->curlPostRequest($make_action_url);
                            } catch (\Exception $e) {

                            }
                        }
                    } elseif ($setting->instructor_service == "Local") {
                        try {
                            $check = Subscription::where('email', '=', $user->email)->first();
                            if (empty($check)) {
                                $subscribe = new Subscription();
                                $subscribe->email = $user->email;
                                $subscribe->type = 'Instructor';
                                $subscribe->save();
                            } else {
                                $check->type = "Instructor";
                                $check->save();
                            }
                        } catch (\Exception $e) {

                        }
                    }
                }
            }

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }
    private function createEducationRecords(User $user, $educationData)
    {
        $educationRecord = new Consultantedu(); // Create a single instance
    
        foreach ($educationData as $education) {
            if (isset($education['degree'])) {
                $educationRecord->degree = $education['degree'];
            }
    
            if (isset($education['institution'])) {
                $educationRecord->institution = $education['institution'];
            }
    
            if (isset($education['start_date'])) {
                $educationRecord->start_date = $education['start_date'];
            }
    
            if (isset($education['end_date'])) {
                $educationRecord->end_date = $education['end_date'];
            }
        }
    
        // Save the education record with the user
        $user->education()->save($educationRecord);
    }
   
    private function createPackageDetails(User $user, $packageData)
    {
        $packageDetail = new ConsultantPackageDetail();
    
        if (isset($packageData['text_consultation_price'])) {
            $packageDetail->text_consultation_price = $packageData['text_consultation_price'];
        }
    
        if (isset($packageData['text_consultation_description'])) {
            $packageDetail->text_consultation_description = $packageData['text_consultation_description'];
        }
    
        if (isset($packageData['online_consultation_price'])) {
            $packageDetail->online_consultation_price = $packageData['online_consultation_price'];
        }
    
        if (isset($packageData['online_consultation_description'])) {
            $packageDetail->online_consultation_description = $packageData['online_consultation_description'];
        }
    
        // Save the package detail with the user
        $user->packageDetails()->save($packageDetail);
    }
    
       

    
    
    public function update(Request $request)
    {
        Session::flash('type', 'update');

        if (demoCheck()) {
            return redirect()->back();
        }
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:1|unique:users,phone,' . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'bail|nullable|min:8|confirmed',

        ];

        $this->validate($request, $rules, validationMessage($rules));


        $user = User::findOrFail($request->id);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->facebook = $request->facebook;
            $user->twitter = $request->twitter;
            $user->linkedin = $request->linkedin;
            $user->instagram = $request->instagram;
            $user->about = $request->about;
            $user->dob = getPhpDateFormat($request->dob);
            if (empty($request->phone)) {
                $user->phone = null;
            } else {
                $user->phone = $request->phone;
            }
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            if ($request->file('image') != "") {
                $file = $request->file('image');
                $user->image = $this->saveImage($file);
            }
            if (isModuleActive('Appointment')) {
                if (!$user->slug && ($request->name != $user->name)) {
                    $user->slug = Str::slug($request->name, '-');
                }
                $user->hour_rate = $request->hour_rate;
                $user->types = json_encode($request->type);
                $user->is_available = $request->available == 'on' ? 1 : 0;
                $user->headline = $request->headline;
                $user->short_video_link = $request->video_link;
                $user->available_msg = $request->available_message;
            }
            $user->role_id = 14;
            $user->save();
            $educationData = $request->input('education');
            $this->updateEducationRecords($user, $educationData);
    
            $packageData = $request->input('packageDetails');
            $this->updatePackageDetails($user, $packageData);

            if (isModuleActive('Appointment')) {
                $interface = App::make(AppointmentRepositoryInterface::class);
                $storeInstructorData = $interface->instructorStoreData($request->all(), $user->id);
            }
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }
    private function updateEducationRecords(User $user, $educationData)
    {
        // Delete existing education records
        $user->education()->delete();
    
        foreach ($educationData as $education) {
            if (isset($education['degree']) && isset($education['institution']) && isset($education['start_date']) && isset($education['end_date'])) {
                $educationRecord = new Consultantedu([
                    'degree' => $education['degree'],
                    'institution' => $education['institution'],
                    'start_date' => $education['start_date'],
                    'end_date' => $education['end_date'],
                ]);
                $user->education()->save($educationRecord);
            }
        }
    }
    
    private function updatePackageDetails(User $user, $packageData)
    {
        // Delete existing package details
        $user->packageDetails()->delete();
    
        foreach ($packageData as $package) {
            if (isset($package['text_consultation_price']) && isset($package['text_consultation_description']) && isset($package['online_consultation_price']) && isset($package['online_consultation_description'])) {
                $packageDetail = new ConsultantPackageDetail([
                    'text_consultation_price' => $package['text_consultation_price'],
                    'text_consultation_description' => $package['text_consultation_description'],
                    'online_consultation_price' => $package['online_consultation_price'],
                    'online_consultation_description' => $package['online_consultation_description'],
                ]);
                $user->packageDetails()->save($packageDetail);
            }
        }
    }

    public function destroy(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $rules = [
            'id' => 'required'
        ];

        $this->validate($request, $rules, validationMessage($rules));

        try {

            $user = User::with('courses')->findOrFail($request->id);
            if (count($user->courses) > 0) {
                Toastr::error($user->name . ' has course. Please remove it first', 'Failed');
                return back();
            }
            $user->delete();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }
    public function indexmsg()
    {

        try {
            $consultants = [];
            // $countries = Country::all();
            $msg = ConsultantMessageRequest::all();
            $user = Auth::user();
            return view('systemsetting::consultantmsg', compact('consultants','msg','user'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
    public function indexopp()
    {

        try {
            $consultants = [];
            // $countries = Country::all();
            $opp = ConsultantAppointmentRequest::all();
            $user = Auth::user();
            return view('systemsetting::consultantopp', compact('consultants','opp','user'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
    public function getAllconsultantData(Request $request)
    {
        $user = Auth::user();
        $with = [];
        if (isModuleActive('OrgInstructorPolicy')) {
            $with[] = 'policy';
        }
        $query = User::query();
        if (isModuleActive('LmsSaas')) {
            $query->where('lms_id', app('institute')->id);
        } else {
            $query->where('lms_id', 1);
        }
        if (isModuleActive('UserType')) {
            $query->whereHas('userRoles', function ($q) {
                $q->where('role_id', 14);
            });
        } else {
            $query->where('role_id', 14);
        }

        if (isModuleActive('Organization') && $user->isOrganization()) {
            $query->where('organization_id', $user->id);
        }
        $query->with($with);
        $query->latest();
        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('image', function ($query) {
                return view('backend.partials._td_image', compact('query'));
            })->editColumn('name', function ($query) {
                return $query->name;

            })->editColumn('email', function ($query) {
                return $query->email;

            })->addColumn('group_policy', function ($query) {
                $policy = '';
                if (isModuleActive('OrgInstructorPolicy')) {
                    $policy = $query->policy->name;
                }
                return $policy;

            })->addColumn('status', function ($query) {
                $route = 'consultant.change_status';
                return view('backend.partials._td_status', compact('query', 'route'));

            })->addColumn('action', function ($query) {
                return view('systemsetting::partials._td_action2', compact('query'));
            })->rawColumns(['status', 'image', 'action'])->make(true);
    }



    public function getAllConsultantMSG(Request $request)
    {
        
        $userRoleID = auth()->user()->role_id;
        $query = ConsultantMessageRequest::query();

    $with = ['receiver', 'user']; // Define the relationships you want to eager load

    $query->with($with);
   
    if ($userRoleID == 1) {
        // User has role ID 1, show all messages
        $query->latest();
    } elseif ($userRoleID == 14) {
        // User has role ID 6, filter by user ID
        $query->where('receiver_id', auth()->id())->latest();
    }
    return Datatables::of($query)
        ->addIndexColumn()
        ->addColumn('created_at', function ($request) {
            return $request->created_at;
        })
        ->addColumn('replied_at', function ($request) use ($userRoleID) {
            // Check if 'replied_at' is null
            if ($request->replied_at === null) {
                // If 'replied_at' is null, return a button if the user has role ID 1
                return ($userRoleID == 14) ? '<button class="primary-btn small fix-gr-bg" onclick="replyFunction(' . $request->id . ')">Reply</button>' : '<p>Not replied</p>';
            } else {
                // If 'replied_at' is not null, return the regular 'replied_at' value
                return $request->replied_at;
            }
        })
        ->addColumn('receiver_name', function ($request) {
            return optional($request->receiver)->name; // Use optional() to handle null relationships
        })
        // ->addColumn('receiver_email', function ($request) {
        //     return optional($request->receiver)->email; // Use optional() to handle null relationships
        // })
        ->addColumn('user_name', function ($request) {
            return optional($request->user)->name; // Use optional() to handle null relationships
        })
        ->addColumn('user_email', function ($request) {
            return optional($request->user)->phone; // Use optional() to handle null relationships
        })
        ->addColumn('message', function ($request) {
            return $request->message;
        })
        ->rawColumns(['created_at', 'replied_at', 'receiver_name', 'receiver_email', 'user_name', 'message'])
        ->make(true);
    }

    public function getAllConsultantOPP(Request $request)
    {
        
        $userRoleID = auth()->user()->role_id;
        $query = ConsultantAppointmentRequest::query();

    $with = ['receiver', 'user']; // Define the relationships you want to eager load

    $query->with($with);
   
    if ($userRoleID == 1) {
        // User has role ID 1, show all messages
        $query->latest();
    } elseif ($userRoleID == 14) {
        // User has role ID 6, filter by user ID
        $query->where('receiver_id', auth()->id())->latest();
    }
    return Datatables::of($query)
        ->addIndexColumn()
        ->addColumn('created_at', function ($request) {
            return $request->created_at;
        })
        
        ->addColumn('receiver_name', function ($request) {
            return optional($request->receiver)->name; // Use optional() to handle null relationships
        })
        // ->addColumn('receiver_email', function ($request) {
        //     return optional($request->receiver)->email; // Use optional() to handle null relationships
        // })
        ->addColumn('user_name', function ($request) {
            return optional($request->user)->name; // Use optional() to handle null relationships
        })
        ->addColumn('user_email', function ($request) {
            return optional($request->user)->phone; // Use optional() to handle null relationships
        })
        ->addColumn('message', function ($request) {
            return $request->message;
        })
        ->addColumn('appointment_date', function ($request) {
            return $request->appointment_date;
        })
        ->addColumn('appointment_time', function ($request) {
            return $request->appointment_time;
        })
        ->addColumn('action', function ($request) {
            return '<button class="btn btn-sm btn-primary" onclick="openZoomPopup('.$request->id.')">Send Zoom Link</button>';
        })
       
        ->rawColumns(['created_at', 'receiver_name', 'receiver_email', 'user_name', 'message','appointment_time','appointment_date'])
        ->make(true);
    }
    
    public function submitZoomLink(Request $request)
{
    try {
        // Retrieve data from the request
        $requestId = $request->input('requestId');
        $zoomLink = $request->input('zoomLink');
        $zoomPassword = $request->input('zoomPassword');

        // Fetch the appointment request using the correct variable $requestId
        $appointmentRequest = ConsultantAppointmentRequest::findOrFail($requestId);

        // Update the Zoom link and password in the database
        $appointmentRequest->zoom_link = $zoomLink;
        $appointmentRequest->zoom_password = $zoomPassword;
        $appointmentRequest->linksend_at = now(); 
        $appointmentRequest->save();

        // Send Zoom link email to the user
        Mail::to($appointmentRequest->user_email)->send(new ZoomLinkMail($zoomLink, $zoomPassword));

        // Return a success response
        return response()->json(['message' => 'Zoom link and password saved successfully']);
    } catch (\Exception $e) {
        // Log the exception
        \Log::error('Error in submitZoomLink: ' . $e->getMessage());

        // Return an error response
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    public function submitReplyMSG(Request $request)
{
    try {
        $id = $request->input('id');
        $reply = $request->input('reply');
// Log request data for debugging
\Log::info('Debug information', ['id' => $id, 'reply' => $reply]);

        // Fetch the message request
        $messageRequest = ConsultantMessageRequest::findOrFail($id);

        // Update the status, replied_at, and any other necessary fields
        
        $messageRequest->status = '1';
        $messageRequest->replied_at = now();
        $messageRequest->replied_message =  $reply;
        $messageRequest->save();

        // Optionally, you may want to send an email to the user
        Mail::to($messageRequest->user_email)->send(new MSGReplyMail($reply));

        // Return the updated data
        return response()->json([
            'replied_at' => $messageRequest->replied_at,
            'status' => $messageRequest->status,
            'replied_message' => $messageRequest->replied_message,
            // ... any other data you want to return
        ]);
    } catch (\Exception $e) {
        // Log the exception
        \Log::error('Error in submitReplyMSG: ' . $e->getMessage());

        // Return an error response
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}



public function indexav()
{
    // $availabilities = ConsultantAvailability::where('consultant_id', auth()->id())->get();

    // return view('consultant.availability.index', compact('availabilities'));





    try {
        $consultants = [];
        // $countries = Country::all();
        $av = ConsultantAvailability::all();
        $user = Auth::user();
        return view('systemsetting::consultantav', compact('consultants','av','user'));

    } catch (\Exception $e) {
        Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
        return redirect()->back();
    }
}

public function storeav(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    ConsultantAvailability::create([
        'user_id' => auth()->id(),
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);
    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
    return redirect()->back();

}

public function getAllConsultantAV(Request $request)
    {
        
        $userRoleID = auth()->user()->role_id;
        $query = ConsultantAvailability::query();

    $with = ['user']; // Define the relationships you want to eager load

    $query->with($with);
   
    if ($userRoleID == 1) {
        // User has role ID 1, show all messages
        $query->latest();
    } elseif ($userRoleID == 14) {
        // User has role ID 6, filter by user ID
        $query->where('user_id', auth()->id())->latest();
    }
    return Datatables::of($query)
        ->addIndexColumn()
        ->addColumn('created_at', function ($request) {
            return $request->created_at;
        })
        // ->addColumn('replied_at', function ($request) use ($userRoleID) {
        //     // Check if 'replied_at' is null
        //     if ($request->replied_at === null) {
        //         // If 'replied_at' is null, return a button if the user has role ID 1
        //         return ($userRoleID == 6) ? '<button class="primary-btn small fix-gr-bg" onclick="replyFunction(' . $request->id . ')">Reply</button>' : '<p>Not replied</p>';
        //     } else {
        //         // If 'replied_at' is not null, return the regular 'replied_at' value
        //         return $request->replied_at;
        //     }
        // })
        
        ->addColumn('user_name', function ($request) {
            return optional($request->user)->name; // Use optional() to handle null relationships
        })
        
        ->addColumn('date', function ($request) {
            return $request->date;
        })
        ->addColumn('start_time', function ($request) {
            return $request->start_time;
        })
        ->addColumn('end_time', function ($request) {
            return $request->end_time;
        })
        ->addColumn('status', function ($request) {
            return $request->status;
        })
        
        
        ->rawColumns(['created_at', 'user_name', 'date', 'start_time', 'end_time'])
        ->make(true);
    }


    
}
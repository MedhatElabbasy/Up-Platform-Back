<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\CourseSetting\Entities\Course;
use Modules\FrontendManage\Entities\FrontPage;
use App\Models\ConsultantPackageDetail;
use App\Models\ConsultantMessageRequest;
use App\Models\ConsultantAppointmentRequest;
use App\Models\ConsultantAvailability;
use Carbon\Carbon;

// use Modules\Setting\Entities\InstructorSetup;
// use Modules\FrontendManage\Entities\BecomeInstructor;

class ConsultantsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['maintenanceMode', 'onlyAppMode']);
    }

    public function consultants(Request $request)
{
    try {
        if (hasDynamicPage()) {
            $row = FrontPage::where('slug', '/consultants')->first();

            if ($row) {
                $details = dynamicContentAppend($row->details);
                return view('aorapagebuilder::pages.show', compact('row', 'details'));
            } else {
                $consultants = User::where('role_id', 14)->where('status', '1')->orderBy('total_rating', 'desc')->paginate(16);
                $themes = [
                    'edume',
                    'teachery'
                ];
                $data = '';
                if ($request->ajax()) {
                    foreach ($consultants as $consultant) {
                        if (in_array(Settings('frontend_active_theme'), $themes)) {
                            $data .= view(theme('partials._single_instractor'), compact('consultant'));
                        } else {
                            $data .= '    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="single_instractor mb_30">
                                <a href="' . route('consultantDetails', [$consultant->id, Str::slug($consultant->name, '-')]) . '"
                                   class="thumb">
                                    <img src="' . getInstructorImage($consultant->image) . '" alt="">
                                </a>
                                <a href="' . route('consultantDetails', [$consultant->id, Str::slug($consultant->name, '-')]) . '">
                                    <h4>' . $consultant->name . '</h4></a>
                                <span>' . $consultant->headline . '</span>
                            </div>
                        </div>';
                        }
                    }
                    return $data;
                }
                return view(theme('pages.consultants'), compact('consultants'));
            }
        }
    } catch (\Exception $e) {
        // Handle the exception, for example, log the error or display an error message.
        GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
    }
}


    public function consultantDetails($id, $name, Request $request)
    {
        try {

            $consultant = User::findOrFail($id);
            $consultantPackageDetails = ConsultantPackageDetail::where('user_id', $id)->get();
            $consultant->load('education');
            $availableDates = $this->getAvailableDatesForConsultant($id);
          
            if ($request->has('appointment_date')) {
                $selectedDate = $request->input('appointment_date');
                $availableTimes = $this->getAvailableTimesForDate($id, $selectedDate);
            }
            return view(theme('pages.consultant'), compact('consultant','id','consultantPackageDetails','availableDates'));
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

//     public function becomeInstructor()
//     {
//         try {
//             if (hasDynamicPage()) {
//                 $row = FrontPage::where('slug', '/become-instructor')->first();
//                 $details = dynamicContentAppend($row->details);
//                 return view('aorapagebuilder::pages.show', compact('row', 'details'));
//             } else {
//                 $becomeInstructor = BecomeInstructor::all();
//                 return view(theme('pages.becomeInstructor'), compact('becomeInstructor'));
//             }

//         } catch (\Exception $e) {
//             GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
//         }
//     }
public function askForAdvicemsg(Request $request, $id)
{
    try {
        // Validate the advice request (you can add more validation rules)
        $request->validate([
            'message' => 'required|string',
        ]);

        // Create a new AdviceRequest instance
        $consultant = User::findOrFail($id);
        $adviceRequest = new ConsultantMessageRequest();
        $adviceRequest->user_id = auth()->user()->id; // Sender's user ID
        $adviceRequest->receiver_id = $consultant->id; // Receiver's (consultant) user ID
        $adviceRequest->message = $request->input('message');
        $adviceRequest->save();

        // Optionally, you can add a success message or redirect to the consultant's page
        return redirect()->route('consultantDetails', [$id, Str::slug($consultant->name, '-')])->with('success', 'Message request submitted successfully.');
    } catch (\Exception $e) {
        // Handle any exceptions or errors (e.g., log the error or show an error message)
        return redirect()->back()->with('error', 'Error occurred while submitting the Message request.');
    }
}
public function askForAppointment(Request $request, $id)
{
    try {
        // Validate the appointment request (you can add more validation rules)
        // $request->validate([
        //     'message' => 'required|string',
        //     'appointment_date' => 'required|date',
        //     'appointment_time' => 'required|date_format:H:i',
        // ]);

        // Create a new AppointmentRequest instance
        $consultant = User::findOrFail($id);
        $appointmentRequest = new ConsultantAppointmentRequest();
        $appointmentRequest->user_id = auth()->user()->id; // Sender's user ID
        $appointmentRequest->receiver_id = $consultant->id; // Receiver's (consultant) user ID
        $appointmentRequest->message = $request->input('message');
        $appointmentRequest->appointment_date = Carbon::parse($request->input('appointment_time'));
        $appointmentRequest->appointment_time = $request->input('appointment_time');
        $appointmentRequest->save();
        $this->updateAvailabilityStatus($id, $request->input('appointment_date'), $request->input('appointment_time'));

        // Optionally, you can add a success message or redirect to the consultant's page
        return redirect()->route('consultantDetails', [$id, Str::slug($consultant->name, '-')])->with('success', 'Appointment request submitted successfully.');
    } catch (\Exception $e) {
        // Handle any exceptions or errors (e.g., log the error or show an error message)
        return redirect()->back()->with('error', 'Error occurred while submitting the appointment request.');
    }
}

private function getAvailableDatesForConsultant($consultantId)
    {
        try {
            // Implement your logic to fetch available dates from the database or calculate based on business rules
            // For example, you might have a ConsultantAvailability model with dates marked as available

            $availableDates = ConsultantAvailability::where('user_id', $consultantId)
            ->where(function ($query) {
                $query->where('status', 0)
                    ->orWhereNull('status');
            })
                ->pluck('date');

            // You may want to format the dates or perform additional processing based on your requirements
            // Here, we're using Carbon to format the dates as Y-m-d
            return $availableDates->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })->toArray();
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return [];
        }
    }
    public function getAppointmentTimes($id, Request $request)
{
    try {
        $selectedDate = $request->input('date');
        $availableTimes = $this->getAvailableTimesForDate($id, $selectedDate);

        // Return the available times as JSON
        return response()->json(['times' => $availableTimes]);
    } catch (\Exception $e) {
        // Handle any exceptions or errors
        return response()->json(['error' => 'Error occurred while fetching available appointment times.']);
    }
}

private function getAvailableTimesForDate($consultantId, $selectedDate)
{
    try {
        // Implement your logic to fetch available times for the selected date
        // For example, you might have a ConsultantAvailability model with times marked as available

        $availableTimes = ConsultantAvailability::where('user_id', $consultantId)
            ->where('date', $selectedDate)
            ->where(function ($query) {
                $query->where('status', 0)
                    ->orWhereNull('status');
            })
            ->pluck('start_time');

        // Use toArray() on the collection
        return $availableTimes->toArray();
    } catch (\Exception $e) {
        // Handle any exceptions or errors
        return [];
    }
}
private function updateAvailabilityStatus($consultantId, $selectedDate, $selectedTime)
{
    try {
        // Update the status in ConsultantAvailability
        ConsultantAvailability::where('user_id', $consultantId)
            ->where('date', $selectedDate)
            ->where('start_time', $selectedTime)
            ->update(['status' => 1]);

        // You may want to add additional logic or error handling here if needed
    } catch (\Exception $e) {
        // Handle any exceptions or errors
        // Log the error or perform any other necessary action
    }
}


    
   

}

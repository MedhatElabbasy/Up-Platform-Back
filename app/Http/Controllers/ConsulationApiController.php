<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use App\Models\ConsultantMessageRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\ConsultantAppointmentRequest;

class ConsulationApiController extends Controller
{
    public function index()
    {

        $consultants = User::where('role_id', 14)
            ->with('ConsultantPackageDetail')
            ->with('consultantEducations')
            ->get();

        // Append base URL
        $baseURL = url('/');

        $consultants = $consultants->map(function ($consultant) use ($baseURL) {
            $consultant->photo = $baseURL . '/' . $consultant->photo;
            $consultant->image = $baseURL . '/' . $consultant->image;
            $consultant->avatar = $baseURL . '/' . $consultant->avatar;
            return $consultant;
        });

        return response()->json($consultants, 200);
    }

// get consulant by id

    public function storeMassage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'receiver_id' => [
                'required',
                //  'required|exists:users,id',
                 Rule::notIn([auth()->id()]),
            ],
        ], [
            'message.required' => 'مطلوب ادخال الرسالة',
            'receiver_id.required' => 'مطلوب id المستشار',
            'receiver_id.exists' => 'المستشار المحدد غير موجود',
            'receiver_id.not_in' => 'لا يمكن إرسال رسالة لنفسك',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cmr = new ConsultantMessageRequest;
        $user = auth()->user();
        $cmr->user_id = $user->id;
        $cmr->receiver_id = $request->input('receiver_id');
        $cmr->message = $request->input('message');
        $cmr->save();
        return response()->json(['message' => 'تم حفظ طلب الرسالة بنجاح'], 201);
    }

    ################

    public function storeAppointmentRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'receiver_id' => [
                'required',
                Rule::notIn([auth()->id()]),
            ],
            'appointment_date' => 'required|date_format:Y-m-d',
            'appointment_time' => 'required|date_format:h:i A',
        ], [
            'message.required' => 'مطلوب ادخال الرسالة',
            'receiver_id.required' => 'مطلوب id المستشار',
            'receiver_id.not_in' => 'لا يمكن إرسال رسالة لنفسك',
            'appointment_date.required' => 'مطلوب تحديد تاريخ الموعد',
            'appointment_date.date' => 'صيغة تاريخ غير صالحة',
            'appointment_time.required' => 'مطلوب تحديد وقت الموعد',
            'appointment_time.date_format' => 'صيغة وقت غير صالحة',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = auth()->user();

        $appointmentRequest = new ConsultantAppointmentRequest;
        $appointmentRequest->user_id = $user->id;
        $appointmentRequest->receiver_id = $request->input('receiver_id');
        $appointmentRequest->message = $request->input('message');
        $appointmentRequest->appointment_date = $request->input('appointment_date');
        $appointmentRequest->appointment_time = $request->input('appointment_time');
        $appointmentRequest->save();

        return response()->json(['message' => 'تم حفظ طلب الموعد بنجاح'], 201);
    }

}
<?php

namespace App\Http\Controllers\API\Call;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ActiveCall;
use App\Model\Call;
use App\Model\Cdr;
use App\Model\Patient;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CallsController extends Controller
{

    public function active_call(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_id' => 'required',
                'number' => 'required|string|max:12|min:12',
            ],
            [
                'doctor_id.required' => 'Doctor Id is required.',
                'number.required' => 'Number is required.',
                'number.max' => 'Number should have 12 digits.',
                'number.min' => 'Number should have 12 digits.',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 422, 'messages' => $errors->getMessageBag()->all()], 422);
        }

        try {
            //$number = str_replace('255', '0', $request->number);

            $patient = Patient::where("phone", $request->number)->get('id')->first();

            $patientId = null;
            if ($patient != null)
                $patientId = $patient->id;

            event(new ActiveCall($request->number, $request->doctor_id, $patientId));

            return response()->json(['status' => 200, 'message' => 'Call data received successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => 'Call data error', 'ex' => $e], 400);
        }
    }

    public function finished_call(Request $request)
    {
        Log::info($request);
        try {
            $call = new Call;
            $call->doctor_id = $request->doctor_id;
            $call->call_id = $request->call_id;
            $call->caller_number = $request->caller_number;
            $call->call_date = $request->call_date;
            $call->call_duration = $request->call_duration;
            $call->call_talktime = $request->call_talktime;
            $call->status = $request->status;
            $call->channel = $request->channel;
            $call->call_disconnection = $request->call_disconnection;
            $call->save();

            return response()->json($call, 200);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => 'Call not saved successfully', 'ex' => $e], 400);
        }
    }

    public function cdr(Request $request)
    {
        Log::info($request);
        try {
            $cdr = new Cdr();
            $cdr->callingDate = $request->callingDate;
            $cdr->mssidn = $request->mssidn;
            $cdr->service = $request->service;
            $cdr->lang = $request->lang;
            $cdr->paymentMethod = $request->paymentMethod;
            $cdr->selectedAudio = $request->selectedAudio;
            $cdr->duration = $request->duration;
            $cdr->paymentStatus = $request->paymentStatus;
            $cdr->uniqueId = $request->uniqueId;
            $cdr->calledDr = $request->calledDr;
            $cdr->newCustomer = $request->newCustomer;
            $cdr->serviceRating = $request->serviceRating;
            $cdr->hangupCause = $request->hangupCause;
            $cdr->callingStage = $request->callingStage;
            $cdr->callOutCome = $request->callOutCome;
            $cdr->save();

            return response()->json("success", 200);
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => 'Call not saved successfully', 'ex' => $e], 400);
        }
    }
}

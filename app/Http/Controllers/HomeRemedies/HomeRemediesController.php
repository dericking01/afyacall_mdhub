<?php

namespace App\Http\Controllers\HomeRemedies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Patient;
use App\Model\Symptom;
use App\Model\Region;
use App\Model\Prescription;
use App\Model\ChiefComplaint;
use Illuminate\Support\Facades\Auth;
use Pnlinh\InfobipSms\Facades\InfobipSms;
use App\Helpers\SmsHelper;

class HomeRemediesController extends Controller
{
    public function index(){
        $prescriptions = Prescription::with('patient')->orderBy('id', 'desc')->get();
        // return response()->json($prescriptions);
        return view('home_remedies.index',compact('prescriptions'));
    }

    public function create(){
        $patients = Patient::with('region','district')->get();
        $symptoms = Symptom::all();
        $chiefComplaints = ChiefComplaint::all();
        $regions = Region::all()->pluck('name','id');
        $patientnumber = "AC-".Patient::getNextPatientNumber();
        return view('home_remedies.create',compact('patients','symptoms','regions','patientnumber','chiefComplaints'));
    }

    public function create_patient(Request $request){
         //register patient
        $request->validate([
            'firstname' => 'required',
        ]);

        $patient = new Patient;
        $patient->firstname = $request->firstname;
        $patient->pat_no = $request->pat_no;
        $patient->lastname = $request->lastname;
        $patient->email = $request->email;
        $patient->gender = $request->gender;
        $patient->date_of_birth = $request->date_of_birth;
        $patient->phone = $request->phone_mobile;
        $patient->otherphone = $request->otherphone;
        $patient->region_id = $request->region;
        $patient->district_id = $request->districts;
        $patient->doctor_id = Auth::id();
        $patient->save();

        return redirect()->back()
                         ->with('has_patient',$patient);

    }

    public function new_remedies(Request $request){
  
        $request->validate([
            'patient_id' => 'required'
        ]);
       $remedies = new Prescription;
       $remedies->patient_id = $request->patient_id;
       $remedies->user_id = Auth::id();
       $remedies->callers = $request->callers;
       $remedies->hist_pres_ill = $request->hist_pres_ill;
       $remedies->surgeries = $request->surgeries;
       $remedies->sugreries_reaction = $request->sugreries_reaction;
       $remedies->lastdatemens = $request->lastdatemens;
       $remedies->number_pregnance = $request->number_pregnance;
       $remedies->number_live_birth = $request->number_live_birth;
       $remedies->preg_complication = $request->preg_complication;
       $remedies->referral = $request->referral;
       $remedies->counc_advice = $request->counc_advice;
       $remedies->other_plans = $request->other_plans;
       $remedies->dd = $request->dd;
       $remedies->cheif_complaint = $request->cheif_complaint;
       $remedies->prov_diagnos = $request->prov_diagnos;
       $remedies->conclusion = $request->conclusion;
       $remedies->medication_status = $request->medication_status;
       $remedies->medication_name = $request->medication_name;
       $remedies->dangersign = $request->dangersign;
       $remedies->save();


       try {
            $patient = Patient::find($request->patient_id);
            $messagesent = "Your Afyacall Number is ". $patient->pat_no;
            $contactfilter = str_pad(substr($patient->phone,1),12,"255", STR_PAD_LEFT);
            $smsHelper = new SmsHelper();
            $res = $smsHelper->sendSms($contactfilter, $messagesent);
       } catch (\Throwable $th) {
           //throw $th;
           return redirect()->back()->with('success','Fail to send sms to a patient');
       }
      


       return redirect()->back()->with('success','patient has been consultation successfull');
   }

    public function patient_data(Request $request){
        $patient = Patient::with('region','district')
                            ->withCount('prescriptions')
                            ->with(['prescriptions' => function($q){
                                    return $q->with('user');
                                    }])
                            ->findOrFail($request->patientid);
        return response()->json($patient);
    }

    public function view($id){
       $prescriptions = Prescription::with('patient')
                        ->with(['user'=>function($q){
                            return $q->with('doctor');
                        }])
                        ->findOrFail($id);

    //   return $prescriptions;
      return view('home_remedies.view',compact('prescriptions'));
    }

    public function remedies_patient_now($id){
        $patient = Patient::find($id);
        return redirect()->route('admin.home.remedies.create')
                         ->with('has_patient',$patient);
    }


     public function edit($id)
    {

        $patients = Patient::with('region', 'district')->get();
        $prescriptions = Prescription::with('patient')
            ->findOrFail($id);

    //    return $prescriptions;
        return view('home_remedies.edit', compact('prescriptions','patients'))->with('has_patient', $patients);
    }

    public function update_remedies(Request $request, $id){

        $request->validate([
            'patient_id' => 'required'
        ]);
        $remedies = Prescription::find($id);
        $remedies->patient_id = $request->patient_id;
        $remedies->user_id = Auth::id();
        $remedies->callers = $request->callers;
        $remedies->hist_pres_ill = $request->hist_pres_ill;
        $remedies->surgeries = $request->surgeries;
        $remedies->sugreries_reaction = $request->sugreries_reaction;
        $remedies->lastdatemens = $request->lastdatemens;
        $remedies->number_pregnance = $request->number_pregnance;
        $remedies->number_live_birth = $request->number_live_birth;
        $remedies->preg_complication = $request->preg_complication;
        $remedies->referral = $request->referral;
        $remedies->counc_advice = $request->counc_advice;
        $remedies->other_plans = $request->other_plans;
        $remedies->dd = $request->dd;
        $remedies->cheif_complaint = $request->cheif_complaint;
        $remedies->prov_diagnos = $request->prov_diagnos;
        $remedies->conclusion = $request->conclusion;
        $remedies->medication_status = $request->medication_status;
        $remedies->medication_name = $request->medication_name;
        $remedies->dangersign = $request->dangersign;
        $remedies->save();

        return redirect()->route('admin.home.remedies')->with('success', 'consultation edited successfull');
    }
}

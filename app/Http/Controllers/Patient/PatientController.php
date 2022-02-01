<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Region;
use App\Model\Patient;
use App\Model\Prescription;
use App\Traits\PatientFilter;
use Illuminate\Support\Facades\Auth;
use PdfReport;
use Carbon\Carbon;

class PatientController extends Controller
{
    use PatientFilter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patient::with('region','district')->get();

        // return response()->json($patients);
        return view('patient.index', [
            'patients' => $this->filteredPatient($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all()->pluck('name','id');
        $patientnumber = "AC-".Patient::getNextPatientNumber();
        return view('patient.create',compact('regions','patientnumber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //register as user first
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
        $patient->phone = $request->phone;
        $patient->otherphone = $request->otherphone;
        $patient->region_id = $request->region;
        $patient->district_id = $request->districts;
        $patient->doctor_id = Auth::id();
        $patient->save();

        return redirect()->route('admin.patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        $regions = Region::all()->pluck('name','id');
        return view('patient.edit',compact('patient','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required'
            ]);
    
            $patient = Patient::find($id);
            $patient->firstname = $request->firstname;
            $patient->pat_no = $request->pat_no;
            $patient->lastname = $request->lastname;
            $patient->email = $request->email;
            $patient->gender = $request->gender;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->phone = $request->phone;
            $patient->otherphone = $request->otherphone;
            $patient->region_id = $request->region;
            $patient->district_id = $request->districts;
            $patient->doctor_id = Auth::id();
            $patient->save();
    
            return redirect()->route('admin.patients.index')->with('success', 'contact Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        $prescription = Prescription::where('patient_id',$id);
        $prescription->delete();
        return redirect()->route('admin.patients.index')->with('success', 'contact Deleted Successful!');
    }

    
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Show patient medial history
     */
    public function patientMedicalHistory($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.medical-history', [
            'patient' => $patient
        ]);
    }

    public function report(Request $request){
        // Retrieve any filters
        $fromDate = $request->start_date;
        $toDate = $request->end_date;
       
        // $doctor = Doctor::find($request->doctor_report);
        // Report title
        $title = 'Registered User Report';

            // For displaying filters description on header
        $meta = [
            'Registered on' => $fromDate . ' To ' . $toDate
          
        ];

            // Do some querying..
        $queryBuilder = Patient::select([
            'firstname',
            'lastname',
            'created_at'
        ]);

             // Set Column to be displayed
        $columns = [
            'First Name' => 'firstname',
            'Last Name' => 'lastname',
            'Registered At' => 'created_at',
            // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
        ];

        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                ->stream(); // or download('filename here..') to download pdf
    }

    public function report_index(){
        $patients = Patient::all();
        $start_date = Carbon::today()->toDateString();
        $end_date = Carbon::now()->toDateString();
        return view('patient.report', compact('patients','start_date','end_date'));
    }

    public function preview_report(Request $request){

        if ($request->patientId == '0'){
            $prescriptions = Patient::with(['prescriptions'=>function($q) use ($request){
                                return $q->with('user')
                                         ->whereBetween('created_at',[$request->startDate, $request->endDate.' 23:59:59']);
                            }])
                        ->get();
            return response()->json(["data"=>$prescriptions],200);
        }
        // $enddatetime =  $request->endDate.' 23:59:59';
        $prescriptions = Patient::where('id',$request->patientId)
                          ->with(['prescriptions'=>function($q) use ($request){
                                  return $q->with('user')
                                           ->whereBetween('created_at',[$request->startDate, $request->endDate.' 23:59:59']);
                                 }])
                           ->get();
         return response()->json(["data"=>$prescriptions],200);
    }
}

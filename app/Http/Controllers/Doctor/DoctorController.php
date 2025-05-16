<?php

namespace App\Http\Controllers\Doctor;

use App\User;
use App\Model\Doctor;
use App\Model\Region;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Call;
use Illuminate\Support\Facades\Mail;
use App\Mail\DoctorMail;
use App\Model\Smslog;
use SamuelTerra22\ReportGenerator\ReportMedia\PdfReport;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with('user', 'region', 'district', 'patients')
            ->withCount('patients')
            ->orderBy('id', 'desc')->get();
        // return response()->json($doctors);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $random = str_shuffle('afyacalldoctor2021@#');
        $password = substr($random, 0, 10);
        $roles = Role::all()->pluck('name', 'id');
        $regions = Region::all()->pluck('name', 'id');
        return view('doctors.create_doctor', compact('roles', 'regions', 'password'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
        ]);
        // dd('here');

        $user = new User;
        $user->name = $request->firstname . " " . $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $roles = $request->roles ? $request->roles : [];
        $user->assignRole($roles);

        if ($user->save()) {
            //save all data in doctor model
            $doctor = new Doctor;
            $doctor->user_id = $user->id;
            $doctor->firstname = $request->firstname;
            $doctor->lastname = $request->lastname;
            $doctor->phone = $request->phone;
            $doctor->gender = $request->gender;
            $doctor->date_of_birth = $request->date_of_birth;
            $doctor->nationId = $request->nationId;
            $doctor->medicalSchool = $request->medicalSchool;
            $doctor->medicalRegisterNumber = $request->medicalRegisterNumber;
            $doctor->health_facility = $request->health_facility;
            $doctor->health_facility_type = $request->health_facility_type;
            $doctor->section = $request->section;
            $doctor->currentemployer_otherinfo = $request->currentemployer_otherinfo;
            $doctor->box = $request->box;
            $doctor->cellphone = $request->cellphone;
            $doctor->other_email = $request->other_email;
            $doctor->effective_communication = $request->effective_communication;
            $doctor->customer_care = $request->customer_care;
            $doctor->medical_ethics = $request->medical_ethics;
            $doctor->telehealth = $request->telehealth;
            $doctor->region_id = $request->region;
            $doctor->district_id = $request->districts;
            if ($doctor->save()) {
                //send email to the doctor with email and password and link
                $details = [
                    'firstname' => $request->firstname,
                    'password' =>  $request->password,
                    'email' => $request->email,
                ];

                Mail::to($request->email)
                    ->send(new DoctorMail($details));
                return redirect()->route('admin.doctors.index');
            }
        }

        // return redirect()->route('admin.doctors.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::with('user', 'patients')->find($id);
        // return response()->json($doctor);
        return view('doctors.view', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all()->pluck('name', 'id');
        $regions = Region::all()->pluck('name', 'id');
        $doctor = Doctor::with('user')->find($id);
        return view('doctors.edit_doctor', compact('roles', 'regions', 'doctor'));
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
        //register as user first

        $user = User::find($request->userid);
        $user->name = $request->firstname . " " . $request->lastname;
        $user->email = $request->email;
        $roles = $request->roles ? $request->roles : [];
        $user->assignRole($roles);
        $user->save();

        $doctor = Doctor::find($id);
        $doctor->firstname = $request->firstname;
        $doctor->lastname = $request->lastname;
        $doctor->phone = $request->phone;
        $doctor->gender = $request->gender;
        $doctor->date_of_birth = $request->date_of_birth;
        $doctor->nationId = $request->nationId;
        $doctor->medicalSchool = $request->medicalSchool;
        $doctor->medicalRegisterNumber = $request->medicalRegisterNumber;
        $doctor->health_facility = $request->health_facility;
        $doctor->health_facility_type = $request->health_facility_type;
        $doctor->section = $request->section;
        $doctor->currentemployer_otherinfo = $request->currentemployer_otherinfo;
        $doctor->box = $request->box;
        $doctor->cellphone = $request->cellphone;
        $doctor->other_email = $request->other_email;
        $doctor->effective_communication = $request->effective_communication;
        $doctor->customer_care = $request->customer_care;
        $doctor->medical_ethics = $request->medical_ethics;
        $doctor->telehealth = $request->telehealth;
        $doctor->region_id = $request->region;
        $doctor->district_id = $request->districts;
        $doctor->save();


        return redirect()->route('admin.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $doctor = Doctor::where('user_id', $id);
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor Deleted Successful!');
    }

    public function report(Request $request)
    {
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
        $queryBuilder = Doctor::select([
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

    public function report_index()
    {
        $doctors = Doctor::all();
        $start_date = Carbon::today()->toDateString();
        $end_date = Carbon::now()->toDateString();
        return view('doctors.report', compact('doctors', 'start_date', 'end_date'));
    }

    public function preview_report(Request $request)
    {

        if ($request->doctorId == '0') {
            $doctors = Doctor::with(['patients' => function ($q) use ($request) {
                return $q->whereBetween('created_at', [$request->startDate, $request->endDate . ' 23:59:59']);
            }])
                ->get();
            return response()->json(["data" => $doctors], 200);
        }
        // $enddatetime =  $request->endDate.' 23:59:59';
        $doctors = Doctor::where('id', $request->doctorId)
            ->with(['patients' => function ($q) use ($request) {
                return $q->whereBetween('created_at', [$request->startDate, $request->endDate . ' 23:59:59']);
            }])
            ->get();
        return response()->json(["data" => $doctors], 200);
    }

    public function getCalls($id)
    {
        $calls = Call::where('doctor_id', $id)->get();
        return view('doctors.calls')->with(compact('calls'));
    }

    public function notification()
    {
        $start_date = Carbon::today()->toDateString();
        $end_date = Carbon::now()->toDateString();
        return view('reports.notification', compact('start_date', 'end_date'));

    }

    public function getNotification(Request $request)
    {
        $doctors = Smslog::whereBetween('created_at', [$request->startDate, $request->endDate . ' 23:59:59'])->get();
        return response()->json(["data" => $doctors], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\Cdr;
use App\Model\Prescription;
use App\User;
use App\Model\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $online_doctors = User::where('status','0')->count(); 
        $prescriptions = Prescription::where('user_id',Auth::id())->count();
        $today_consaltation = Prescription::where('user_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->count();
        $today_patient = Patient::where('doctor_id',Auth::id())->whereDate('created_at', \Carbon\Carbon::today())->count();
        $seven_patient = Patient::where('doctor_id',Auth::id())->whereBetween('created_at',  [Carbon::now()->subDays(7), Carbon::now()])->count();
        $total_patient = Patient::where('doctor_id',Auth::id())->count();
        $totalivr = Cdr::where('service','IVR')->whereDate('created_at', Carbon::today())->count();
        $totaldoctor = Cdr::where('service','Dr-Calling')->whereDate('created_at', Carbon::today())->count();
        $totalnonselection = Cdr::where('service',null)->whereDate('created_at', Carbon::today())->count();
        return view('home',compact('online_doctors','prescriptions','today_consaltation','today_patient','total_patient','totalnonselection','totaldoctor','totalivr','seven_patient'));
    }


    public function dashboard()
    {
        $online_doctors = User::where('status','0')->count(); 
        $prescriptions = Prescription::count();
        $today_consaltation = Prescription::whereDate('created_at', \Carbon\Carbon::today())->count();
        $today_patient = Patient::whereDate('created_at', \Carbon\Carbon::today())->count();
        $seven_patient = Patient::whereBetween('created_at',  [Carbon::now()->subDays(7), Carbon::now()])->count();
        $total_patient = Patient::count();
        $totalivr = Cdr::where('service','IVR')->whereDate('created_at', Carbon::today())->count();
        $totaldoctor = Cdr::where('service','Dr-Calling')->whereDate('created_at', Carbon::today())->count();
        $totalnonselection = Cdr::where('service',null)->whereDate('created_at', Carbon::today())->count();
        return view('home',compact('online_doctors','prescriptions','today_consaltation','today_patient','total_patient','totalnonselection','totaldoctor','totalivr','seven_patient'));
    }  
}


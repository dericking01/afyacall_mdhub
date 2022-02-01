<?php

namespace App\Http\Controllers\API\Doctor;

use App\Model\Doctor;
use App\User;
use App\Http\Controllers\Controller;
use DB;
use Cache;

class ActiveDoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {

        $doctors_online =  User::select('id','phone')->where('status','0')->get();
        $doctors_offline =  User::select('id','phone')->where('status','1')->get();
        return response()->json(['online_doctors' => $doctors_online,'offline_doctor'=>$doctors_offline]);
    }
}
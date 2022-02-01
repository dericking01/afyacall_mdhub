<?php

namespace App\Http\Controllers\API\Schedule;

use App\Model\Schedule;
use App\Http\Controllers\Controller;

class DoctorSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::where('date', '=>', \Carbon\Carbon::now()->format('Y-m-d'))
                        ->orWhere('start_time', '=>', \Carbon\Carbon::now()->toTimeString())
                        ->get(['doctor_id', 'date', 'start_time', 'end_time']);
                        
        return response()->json($schedules);
    }
}
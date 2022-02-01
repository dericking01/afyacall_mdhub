<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Doctor;
use App\Model\Schedule;

class CalendarController extends Controller
{

    public function index(){

        $events = [];
        $doctors = Doctor::with('schedules')->get();


        // return response()->json($doctors);

        $schedules = Schedule::with('doctor')->get();
        // return response()->json($schedules);



        foreach ($schedules as $key => $schedule) {

            $events[] = [
                'title' =>  'Dr. '. $schedule->doctor['firstname'] .' '. $schedule->doctor['lastname'],
                'start' =>  $schedule->date,
                'url'   => route('admin.myschedule.index'),
            ];
           
        }

       
    
        return view('calendar.index',compact('events','doctors'));
    }
}

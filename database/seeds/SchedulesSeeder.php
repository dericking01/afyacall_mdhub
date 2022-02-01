<?php

use Illuminate\Database\Seeder;
use App\Model\Schedule;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'date' => Carbon\Carbon::now()->format('Y-m-d'), 
            'start_time' => Carbon\Carbon::now()->toTimeString(),
            'end_time' => Carbon\Carbon::now()->addHour()->toTimeString(),
            'doctor_id' => 1,
        ]);
    }
}

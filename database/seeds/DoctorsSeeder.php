<?php

use Illuminate\Database\Seeder;
use App\Model\Doctor;

class DoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
            'firstname' => 'Julius',
            'lastname' => 'John',
            'phone' => '0746805383',
            'region_id' => '1',
            'district_id' => '1',
            'user_id' => 1,
        ]);



    }
}

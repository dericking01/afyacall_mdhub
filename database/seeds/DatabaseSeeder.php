<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(ZonesSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(WardsSeeder::class);
        $this->call(StreetsSeeder::class);        
        $this->call(DoctorsSeeder::class);
        $this->call(SchedulesSeeder::class);
    }
}

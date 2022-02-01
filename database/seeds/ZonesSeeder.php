<?php

use Illuminate\Database\Seeder;
use App\Model\Zone;

class ZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Zone::create([
            'name' => 'Central',
        ]);

        Zone::create([
            'name' => 'Coastal',
        ]);

        Zone::create([
            'name' => 'Lake',
        ]);

        Zone::create([
            'name' => 'Northern',
        ]);

        Zone::create([
            'name' => 'Southern Highlands',
        ]);

        Zone::create([
            'name' => 'Zanzibar',
        ]);
    }
}

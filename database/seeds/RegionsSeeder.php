<?php

use Illuminate\Database\Seeder;
use App\Model\Region;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create(['name' => 'Arusha', 'postcode' => '23000', 'zone_id' => $this->getZoneByName('Northern')]);
        Region::create(['name' => 'Dar es Salaam', 'postcode' => '11000', 'zone_id' => $this->getZoneByName('Coastal')]);
        Region::create(['name' => 'Dodoma', 'postcode' => '41000', 'zone_id' => $this->getZoneByName('Central')]);
        Region::create(['name' => 'Geita', 'postcode' => '30000', 'zone_id' => $this->getZoneByName('Lake')]);
        Region::create(['name' => 'Iringa', 'postcode' => '51000', 'zone_id' => $this->getZoneByName('Southern Highlands')]);
        Region::create(['name' => 'Kagera', 'postcode' => '35000', 'zone_id' => $this->getZoneByName('Lake')]);
        Region::create(['name' => 'Katavi', 'postcode' => '50000', 'zone_id' => $this->getZoneByName('Southern Highlands')]);
        Region::create(['name' => 'Kigoma', 'postcode' => '47000', 'zone_id' => $this->getZoneByName('Central')]);
        Region::create(['name' => 'Kilimanjaro', 'postcode' => '25000', 'zone_id' => $this->getZoneByName('Northern')]);
        Region::create(['name' => 'Lindi', 'postcode' => '65000', 'zone_id' => $this->getZoneByName('Coastal')]);
        Region::create(['name' => 'Manyara', 'postcode' => '27000', 'zone_id' => $this->getZoneByName('Northern')]);
        Region::create(['name' => 'Mara', 'postcode' => '31000', 'zone_id' => $this->getZoneByName('Lake')]);
        Region::create(['name' => 'Mbeya', 'postcode' => '53000', 'zone_id' => $this->getZoneByName('Southern Highlands')]);
        Region::create(['name' => 'Mjini Magharibi', 'postcode' => '71000', 'zone_id' => $this->getZoneByName('Zanzibar')]);
        Region::create(['name' => 'Morogoro', 'postcode' => '67000', 'zone_id' => $this->getZoneByName('Coastal')]);
        Region::create(['name' => 'Mtwara', 'postcode' => '63000', 'zone_id' => $this->getZoneByName('Coastal')]);
        Region::create(['name' => 'Mwanza', 'postcode' => '33000', 'zone_id' => $this->getZoneByName('Lake')]);
        Region::create(['name' => 'Njombe', 'postcode' => '59000', 'zone_id' => $this->getZoneByName('Southern Highlands')]);
        Region::create(['name' => 'Pemba North', 'postcode' => '75000', 'zone_id' => $this->getZoneByName('Zanzibar')]);
        Region::create(['name' => 'Pemba South', 'postcode' => '74000', 'zone_id' => $this->getZoneByName('Zanzibar')]);
        Region::create(['name' => 'Pwani', 'postcode' => '61000', 'zone_id' => $this->getZoneByName('Coastal')]);
        Region::create(['name' => 'Rukwa', 'postcode' => '55000', 'zone_id' => $this->getZoneByName('Southern Highlands')]);
        Region::create(['name' => 'Ruvuma', 'postcode' => '57000', 'zone_id' => $this->getZoneByName('Southern Highlands')]);
        Region::create(['name' => 'Shinyanga', 'postcode' => '37000', 'zone_id' => $this->getZoneByName('Lake')]);
        Region::create(['name' => 'Simiyu', 'postcode' => '39000', 'zone_id' => $this->getZoneByName('Lake')]);
        Region::create(['name' => 'Singida', 'postcode' => '43000', 'zone_id' => $this->getZoneByName('Central')]);
        Region::create(['name' => 'Tabora', 'postcode' => '45000', 'zone_id' => $this->getZoneByName('Central')]);
        Region::create(['name' => 'Tanga', 'postcode' => '21000', 'zone_id' => $this->getZoneByName('Northern')]);
        Region::create(['name' => 'Unguja North', 'postcode' => '73000', 'zone_id' => $this->getZoneByName('Zanzibar')]);
        Region::create(['name' => 'Unguja South', 'postcode' => '72000', 'zone_id' => $this->getZoneByName('Zanzibar')]);

    }

    // private function getRandomUserId() {
    //     $user = \App\User::inRandomOrder()->first();
    //     return $user->id;
    // }

    private function getZoneByName($name) {
        $zone = \App\Model\Zone::where('name', $name)->first();
        return $zone->id;
    }

}

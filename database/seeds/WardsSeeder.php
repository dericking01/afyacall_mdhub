<?php

use Illuminate\Database\Seeder;
use App\Model\Ward;

class WardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ward::create(['name' => 'Magomeni', 'postcode' => '14101', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Mzimuni', 'postcode' => '14102', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Ndugumbi', 'postcode' => '14104', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Tandale', 'postcode' => '14106', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Makumbusho', 'postcode' => '14107', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Mwananyamala', 'postcode' => '14108', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Hananasif', 'postcode' => '14109', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Kinondoni', 'postcode' => '14110', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Msasani', 'postcode' => '14111', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Mikocheni', 'postcode' => '14112', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Kijitonyama', 'postcode' => '14113', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Kigogo', 'postcode' => '14118', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Kawe', 'postcode' => '14121', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Kunduchi', 'postcode' => '14122', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Bunju', 'postcode' => '14125', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Mbweni', 'postcode' => '14126', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Mbezi Juu', 'postcode' => '14128', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Makongo', 'postcode' => '14129', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Wazo', 'postcode' => '14130', 'district_id' => $this->getDistrictByName('Kinondoni')]);
        Ward::create(['name' => 'Mabwepande', 'postcode' => '14134', 'district_id' => $this->getDistrictByName('Kinondoni')]);

    }

    private function getDistrictByName($name) {
        $district = \App\Model\District::where('name', $name)->first();
        return $district->id;
    }
}

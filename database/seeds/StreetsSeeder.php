<?php

use Illuminate\Database\Seeder;
use App\Model\Street;

class StreetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Street::create(['name' => 'Suna', 'ward_id' => $this->getWardByName('Magomeni')]);
        Street::create(['name' => 'Makuti A', 'ward_id' => $this->getWardByName('Magomeni')]);
        Street::create(['name' => 'Makuti B', 'ward_id' => $this->getWardByName('Magomeni')]);
        Street::create(['name' => 'Dossi', 'ward_id' => $this->getWardByName('Magomeni')]);
        Street::create(['name' => 'Idrisa', 'ward_id' => $this->getWardByName('Magomeni')]);
        Street::create(['name' => 'Idrisa', 'ward_id' => $this->getWardByName('Mzimuni')]);
        Street::create(['name' => 'Makumbusho', 'ward_id' => $this->getWardByName('Mzimuni')]);
        Street::create(['name' => 'Mtambani', 'ward_id' => $this->getWardByName('Mzimuni')]);
        Street::create(['name' => 'Mwinyimkuu', 'ward_id' => $this->getWardByName('Mzimuni')]);
        Street::create(['name' => 'Mpakani', 'ward_id' => $this->getWardByName('Ndugumbi')]);
        Street::create(['name' => 'Mikoroshini', 'ward_id' => $this->getWardByName('Ndugumbi')]);
        Street::create(['name' => 'Makanya', 'ward_id' => $this->getWardByName('Ndugumbi')]);
        Street::create(['name' => 'Vigaeni', 'ward_id' => $this->getWardByName('Ndugumbi')]);
        Street::create(['name' => 'Mtogole', 'ward_id' => $this->getWardByName('Tandale')]);
        Street::create(['name' => 'Kwa Tumbo', 'ward_id' => $this->getWardByName('Tandale')]);
        Street::create(['name' => 'Pakacha', 'ward_id' => $this->getWardByName('Tandale')]);
        Street::create(['name' => 'Sokoni', 'ward_id' => $this->getWardByName('Tandale')]);
        Street::create(['name' => 'Mkunduge', 'ward_id' => $this->getWardByName('Tandale')]);
        Street::create(['name' => 'Muhaltani', 'ward_id' => $this->getWardByName('Tandale')]);
        Street::create(['name' => 'Makumbusho', 'ward_id' => $this->getWardByName('Makumbusho')]);
        Street::create(['name' => 'Minazini', 'ward_id' => $this->getWardByName('Makumbusho')]);
        Street::create(['name' => 'Mchangani', 'ward_id' => $this->getWardByName('Makumbusho')]);
        Street::create(['name' => 'Kisiwani', 'ward_id' => $this->getWardByName('Makumbusho')]);
        Street::create(['name' => 'Mbuyuni', 'ward_id' => $this->getWardByName('Makumbusho')]);
        Street::create(['name' => 'Singano', 'ward_id' => $this->getWardByName('Makumbusho')]);
        Street::create(['name' => 'Kambangwa', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Msisiri B', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Msisiri A', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Bwawani', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Mwinjuma', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Kwa Kopa', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Msolomi', 'ward_id' => $this->getWardByName('Mwananyamala')]);
        Street::create(['name' => 'Hananasif', 'ward_id' => $this->getWardByName('Hananasif')]);
        Street::create(['name' => 'Kisutu', 'ward_id' => $this->getWardByName('Hananasif')]);
        Street::create(['name' => 'Mkunguni A', 'ward_id' => $this->getWardByName('Hananasif')]);
        Street::create(['name' => 'Mkunguni B', 'ward_id' => $this->getWardByName('Hananasif')]);
        Street::create(['name' => 'Kawawa', 'ward_id' => $this->getWardByName('Hananasif')]);
        Street::create(['name' => 'Kumbukumbu', 'ward_id' => $this->getWardByName('Kinondoni')]);
        Street::create(['name' => 'Kinondoni Mjini', 'ward_id' => $this->getWardByName('Kinondoni')]);
        Street::create(['name' => 'Kinondoni Shamba', 'ward_id' => $this->getWardByName('Kinondoni')]);
        Street::create(['name' => 'Ada Estate', 'ward_id' => $this->getWardByName('Kinondoni')]);
        Street::create(['name' => 'Oysterbay', 'ward_id' => $this->getWardByName('Msasani')]);
        Street::create(['name' => 'Masaki', 'ward_id' => $this->getWardByName('Msasani')]);
        Street::create(['name' => 'Mikoroshoni', 'ward_id' => $this->getWardByName('Msasani')]);
        Street::create(['name' => 'Bonde la Mpunga', 'ward_id' => $this->getWardByName('Msasani')]);
        Street::create(['name' => 'Makangira', 'ward_id' => $this->getWardByName('Msasani')]);
        Street::create(['name' => 'Mikocheni A', 'ward_id' => $this->getWardByName('Mikocheni')]);
        Street::create(['name' => 'Mikocheni B', 'ward_id' => $this->getWardByName('Mikocheni')]);
        Street::create(['name' => 'Regent Estate', 'ward_id' => $this->getWardByName('Mikocheni')]);
        Street::create(['name' => 'Ally H. Mwinyi', 'ward_id' => $this->getWardByName('Mikocheni')]);
        Street::create(['name' => 'TPDC', 'ward_id' => $this->getWardByName('Mikocheni')]);
        Street::create(['name' => 'Darajani', 'ward_id' => $this->getWardByName('Mikocheni')]);
        Street::create(['name' => 'Kijitonyama', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Alimaua A', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Alimaua B', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Mpakani A', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Mpakani B', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Bwawani', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Mwenge', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Nzasa', 'ward_id' => $this->getWardByName('Kijitonyama')]);
        Street::create(['name' => 'Kigogo Kati', 'ward_id' => $this->getWardByName('Kigogo')]);
        Street::create(['name' => 'Kigogo Mkwajuni', 'ward_id' => $this->getWardByName('Kigogo')]);
        Street::create(['name' => 'Kigogo Mbuyuni', 'ward_id' => $this->getWardByName('Kigogo')]);
        Street::create(['name' => 'Mzimuni', 'ward_id' => $this->getWardByName('Kawe')]);
        Street::create(['name' => 'Ukwamani', 'ward_id' => $this->getWardByName('Kawe')]);
        Street::create(['name' => 'Mbezi Beach A', 'ward_id' => $this->getWardByName('Kawe')]);
        Street::create(['name' => 'Mbezi Beach B', 'ward_id' => $this->getWardByName('Kawe')]);
        Street::create(['name' => 'Pwani', 'ward_id' => $this->getWardByName('Kunduchi')]);
        Street::create(['name' => 'Kilongawima', 'ward_id' => $this->getWardByName('Kunduchi')]);
        Street::create(['name' => 'Mtongani', 'ward_id' => $this->getWardByName('Kunduchi')]);
        Street::create(['name' => 'Tegeta', 'ward_id' => $this->getWardByName('Kunduchi')]);
        Street::create(['name' => 'Ununio', 'ward_id' => $this->getWardByName('Kunduchi')]);
        Street::create(['name' => 'Kondo', 'ward_id' => $this->getWardByName('Kunduchi')]);
        Street::create(['name' => 'Boko', 'ward_id' => $this->getWardByName('Bunju')]);
        Street::create(['name' => 'Bunju A', 'ward_id' => $this->getWardByName('Bunju')]);
        Street::create(['name' => 'Kilungule', 'ward_id' => $this->getWardByName('Bunju')]);
        Street::create(['name' => 'Busihaya', 'ward_id' => $this->getWardByName('Bunju')]);
        Street::create(['name' => 'Dovya', 'ward_id' => $this->getWardByName('Bunju')]);
        Street::create(['name' => 'Mkoani', 'ward_id' => $this->getWardByName('Bunju')]);
        Street::create(['name' => 'Maputo', 'ward_id' => $this->getWardByName('Mbweni')]);
        Street::create(['name' => 'Mbweni', 'ward_id' => $this->getWardByName('Mbweni')]);
        Street::create(['name' => 'Teta', 'ward_id' => $this->getWardByName('Mbweni')]);
        Street::create(['name' => 'Malindi Estate', 'ward_id' => $this->getWardByName('Mbweni')]);
        Street::create(['name' => 'Mpiji Mbweni', 'ward_id' => $this->getWardByName('Mbweni')]);
        Street::create(['name' => 'Jogoo', 'ward_id' => $this->getWardByName('Mbezi Juu')]);
        Street::create(['name' => 'Ndumbwi', 'ward_id' => $this->getWardByName('Mbezi Juu')]);
        Street::create(['name' => 'Mbezi Mtoni', 'ward_id' => $this->getWardByName('Mbezi Juu')]);
        Street::create(['name' => 'Mbezi Kati', 'ward_id' => $this->getWardByName('Mbezi Juu')]);
        Street::create(['name' => 'Mbezi Juu', 'ward_id' => $this->getWardByName('Mbezi Juu')]);
        Street::create(['name' => 'Changanyikeni', 'ward_id' => $this->getWardByName('Makongo')]);
        Street::create(['name' => 'Mbuyuni', 'ward_id' => $this->getWardByName('Makongo')]);
        Street::create(['name' => 'Mlalakuwa', 'ward_id' => $this->getWardByName('Makongo')]);
        Street::create(['name' => 'Makongo', 'ward_id' => $this->getWardByName('Makongo')]);
        Street::create(['name' => 'Wazo', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Salasala', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Kilimahewa', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Madale', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Mivumoni', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Kisanga', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Kilimahewa Juu', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Nakasangwe', 'ward_id' => $this->getWardByName('Wazo')]);
        Street::create(['name' => 'Bunju B', 'ward_id' => $this->getWardByName('Mabwepande')]);
        Street::create(['name' => 'Mabwe Pande', 'ward_id' => $this->getWardByName('Mabwepande')]);
        Street::create(['name' => 'Mjimpya', 'ward_id' => $this->getWardByName('Mabwepande')]);
        Street::create(['name' => 'Kihonzile', 'ward_id' => $this->getWardByName('Mabwepande')]);
        Street::create(['name' => 'Mbopo', 'ward_id' => $this->getWardByName('Mabwepande')]);
    }

    private function getWardByName($name) {
        $district = \App\Model\Ward::where('name', $name)->first();
        return $district->id;
    }
}

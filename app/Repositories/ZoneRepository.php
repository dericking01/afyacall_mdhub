<?php

namespace App\Repositories;

use App\Model\Zone;

class ZoneRepository implements ZoneRepositoryInterface
{
    /**
     * Get's total Zones
     *
     * @return int
     */
    public function count()
    {
        return Zone::count();
    }

    /**
     * Get's all Zones.
     *
     * @return mixed
     */
    public function all()
    {
        return Zone::all();
    }

    /**
     * Get's all latest created Zones.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number)
    {
        return Zone::orderBy('created_at', 'desc')->take($number)->get();
    }

    /**
     * Get's a Zone by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Zone::findOrFail($id);
    }

    /**
     * Stores a Zone.
     *
     * @param array
     * @return collection
     */
    public function store(array $postData)
    {
        $zone = Zone::firstOrCreate([
            'phone_number' => $postData['phone_number']],
            [
                'first_name' => $postData['first_name'],
                'middle_name' => $postData['middle_name'],
                'last_name' => $postData['last_name'],
                'email' => $postData['email'],
                'zonename' => $postData['zonename'],
                'manager_id' => $postData['manager_id'],
                'agency_id' => $postData['agency_id'],
                'agency_location_id' => $postData['agency_location_id'],
                'manager_location_id' => $postData['manager_location_id'],
                'dob' => $postData['dob'],
                'password' => app('hash')->make($postData['password']),
            ]);
        $zone->assignRole($postData['roles']);

        return $zone;
    }

    /**
     * Updates a zone.
     *
     * @param int
     * @param array
     * @return collection
     */
    public function update($id, array $postData)
    {
        $zone = Zone::findOrFail($id);
        $zone->update([
            'first_name' => $postData['first_name'],
            'middle_name' => $postData['middle_name'],
            'last_name' => $postData['last_name'],
            'email' => $postData['email'],
            'zonename' => $postData['zonename'],
            'phone_number' => $postData['phone_number'],
            'manager_id' => $postData['manager_id'],
            'agency_id' => $postData['agency_id'],
            'agency_location_id' => $postData['agency_location_id'],
            'manager_location_id' => $postData['manager_location_id'],
            'dob' => $postData['dob'],
        ]);
        $zone->syncRoles($postData['roles']);

        return $zone;
    }

    /**
     * Deletes a Zone.
     *
     * @param int
     */
    public function destroy($id)
    {
        Zone::findOrFail($id)->delete();
    }

}

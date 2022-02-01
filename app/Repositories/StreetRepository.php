<?php

namespace App\Repositories;

use App\Model\Street;

class StreetRepository implements StreetRepositoryInterface
{
    /**
     * Get's total Streets
     *
     * @return int
     */
    public function count()
    {
        return Street::count();
    }

    /**
     * Get's all Streets.
     *
     * @return mixed
     */
    public function all()
    {
        return Street::with(['ward'])->get();
    }

    /**
     * Get's all latest created Streets.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number)
    {
        return Street::with(['ward'])->orderBy('created_at', 'desc')->take($number)->get();
    }

    /**
     * Get's a Street by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Street::with(['ward'])->findOrFail($id);
    }

    /**
     * Stores a Street.
     *
     * @param array
     * @return collection
     */
    public function store(array $postData)
    {
        $street = Street::firstOrCreate([
            'phone_number' => $postData['phone_number']],
            [
                'first_name' => $postData['first_name'],
                'middle_name' => $postData['middle_name'],
                'last_name' => $postData['last_name'],
                'email' => $postData['email'],
                'streetname' => $postData['streetname'],
                'manager_id' => $postData['manager_id'],
                'agency_id' => $postData['agency_id'],
                'agency_location_id' => $postData['agency_location_id'],
                'manager_location_id' => $postData['manager_location_id'],
                'dob' => $postData['dob'],
                'password' => app('hash')->make($postData['password']),
            ]);
        $street->assignRole($postData['roles']);

        return $street;
    }

    /**
     * Updates a street.
     *
     * @param int
     * @param array
     * @return collection
     */
    public function update($id, array $postData)
    {
        $street = Street::findOrFail($id);
        $street->update([
            'first_name' => $postData['first_name'],
            'middle_name' => $postData['middle_name'],
            'last_name' => $postData['last_name'],
            'email' => $postData['email'],
            'streetname' => $postData['streetname'],
            'phone_number' => $postData['phone_number'],
            'manager_id' => $postData['manager_id'],
            'agency_id' => $postData['agency_id'],
            'agency_location_id' => $postData['agency_location_id'],
            'manager_location_id' => $postData['manager_location_id'],
            'dob' => $postData['dob'],
        ]);
        $street->syncRoles($postData['roles']);

        return $street;
    }

    /**
     * Deletes a Street.
     *
     * @param int
     */
    public function destroy($id)
    {
        Street::findOrFail($id)->delete();
    }

}

<?php

namespace App\Repositories;

use App\Model\Ward;

class WardRepository implements WardRepositoryInterface
{
    /**
     * Get's total wards
     *
     * @return int
     */
    public function count()
    {
        return Ward::count();
    }

    /**
     * Get's all wards.
     *
     * @return mixed
     */
    public function all()
    {
        return Ward::with(['district', 'streets'])->get();
    }

    /**
     * Get's all latest created wards.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number)
    {
        return Ward::with(['district', 'streets'])->orderBy('created_at', 'desc')->take($number)->get();
    }

    /**
     * Get's a ward by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Ward::with(['district', 'streets'])->findOrFail($id);
    }

    /**
     * Stores a ward.
     *
     * @param array
     * @return collection
     */
    public function store(array $postData)
    {
        $ward = Ward::firstOrCreate([
            'phone_number' => $postData['phone_number']],
            [
                'first_name' => $postData['first_name'],
                'middle_name' => $postData['middle_name'],
                'last_name' => $postData['last_name'],
                'email' => $postData['email'],
                'wardname' => $postData['wardname'],
                'manager_id' => $postData['manager_id'],
                'agency_id' => $postData['agency_id'],
                'agency_location_id' => $postData['agency_location_id'],
                'manager_location_id' => $postData['manager_location_id'],
                'dob' => $postData['dob'],
                'password' => app('hash')->make($postData['password']),
            ]);
        $ward->assignRole($postData['roles']);

        return $ward;
    }

    /**
     * Updates a ward.
     *
     * @param int
     * @param array
     * @return collection
     */
    public function update($id, array $postData)
    {
        $ward = Ward::findOrFail($id);
        $ward->update([
            'first_name' => $postData['first_name'],
            'middle_name' => $postData['middle_name'],
            'last_name' => $postData['last_name'],
            'email' => $postData['email'],
            'wardname' => $postData['wardname'],
            'phone_number' => $postData['phone_number'],
            'manager_id' => $postData['manager_id'],
            'agency_id' => $postData['agency_id'],
            'agency_location_id' => $postData['agency_location_id'],
            'manager_location_id' => $postData['manager_location_id'],
            'dob' => $postData['dob'],
        ]);
        $ward->syncRoles($postData['roles']);

        return $ward;
    }

    /**
     * Deletes a ward.
     *
     * @param int
     */
    public function destroy($id)
    {
        Ward::findOrFail($id)->delete();
    }

}

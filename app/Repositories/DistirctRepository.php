<?php

namespace App\Repositories;

use App\Model\District;

class DistrictRepository implements DistrictRepositoryInterface
{
    /**
     * Get's total Districts
     *
     * @return int
     */
    public function count()
    {
        return District::count();
    }

    /**
     * Get's all Districts.
     *
     * @return mixed
     */
    public function all()
    {
			return  District::with(['region', 'wards'])->get();
    }

    /**
     * Get's all latest created Districts.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number)
    {
        return District::with(['region', 'wards'])->orderBy('created_at', 'desc')->take($number)->get();
    }

    /**
     * Get's a District by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return District::with(['region', 'wards'])->findOrFail($id);
    }

    /**
     * Stores a District.
     *
     * @param array
     * @return collection
     */
    public function store(array $postData)
    {
        $district = District::firstOrCreate([
            'name' => 'required',
            'region_id' => 'required',
        ]);

        return $district;
    }

    /**
     * Updates a district.
     *
     * @param int
     * @param array
     * @return collection
     */
    public function update($id, array $postData)
    {
        $district = District::findOrFail($id);
        $district->update([
            'name' => 'required',
            'region_id' => 'required',
        ]);

        return $district;
    }

    /**
     * Deletes a District.
     *
     * @param int
     */
    public function destroy($id)
    {
        District::findOrFail($id)->delete();
		}

    /**
     * Deletes districts.
     *
     * @param array
     */
    public function massDestroy($ids)
    {
        $entries = District::whereIn('id', $ids)->get();

        foreach ($entries as $entry) {
            $entry->delete();
        }
    }

}

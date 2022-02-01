<?php

namespace App\Repositories;

use App\Model\Region;

class RegionRepository implements RegionRepositoryInterface
{
    /**
     * Get's total regions
     *
     * @return int
     */
    public function count()
    {
        return Region::count();
    }

    /**
     * Get's all regions.
     *
     * @return mixed
     */
    public function all()
    {
        $regions = Region::with(['districts', 'districts.wards', 'districts.wards.streets'])
            ->get();

        foreach ($regions as $key => $value) {
            $districts = $regions[$key]->districts;

            foreach ($districts as $district => $value) {
                $wards = $districts[$district]->wards;
                foreach ($districts[$district]->wards as $ward => $value) {
                    $streets = $districts[$district]->wards[$ward]->streets;
                }
            }
        }

        return compact('regions');
    }

    /**
     * Get's all latest created regions.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number)
    {
        return Region::with(['districts', 'districts.wards', 'districts.wards.streets'])
            ->orderBy('created_at', 'desc')
            ->take($number)
            ->get();
    }

    /**
     * Get's a region by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Region::with(['districts', 'districts.wards', 'districts.wards.streets'])
            ->findOrFail($id);
    }

    /**
     * Stores a region.
     *
     * @param array
     * @return collection
     */
    public function store(array $postData)
    {
        $region = Region::create([
            'name' => $postData['name'],
            'postcode' => $postData['postcode'],
        ]);
        return $region;
    }

    /**
     * Updates a region.
     *
     * @param int
     * @param array
     * @return collection
     */
    public function update($id, array $postData)
    {
        $region = Region::findOrFail($id);
        $region->update([
            'name' => $postData['name'],
            'postcode' => $postData['postcode'],
        ]);

        return $region;
    }

    /**
     * Deletes a region.
     *
     * @param int
     */
    public function destroy($id)
    {
        Region::findOrFail($id)->delete();
    }

    /**
     * Deletes a region.
     *
     * @param int
     */
    public function massDestroy($ids)
    {
        $entries = Region::whereIn('id', $ids)->get();

        foreach ($entries as $entry) {
            $entry->delete();
        }
    }
}

<?php

namespace App\Repositories;

interface RegionRepositoryInterface
{
    /**
     * Get's total regions
     *
     * @return int
     */
    public function count();

    /**
     * Get's all regions.
     *
     * @return mixed
     */
    public function all();

    /**
     * Get's all latest created regions.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number);

    /**
     * Get's a region by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Stores a region.
     *
     * @param array
     */
    public function store(array $postData);

    /**
     * Updates a region.
     *
     * @param int
     * @param array
     */
    public function update($id, array $postData);

    /**
     * Deletes a region.
     *
     * @param int
     */
    public function destroy($id);

    /**
     * Deletes regions.
     *
     * @param array
     */
    public function massDestroy($ids);

}

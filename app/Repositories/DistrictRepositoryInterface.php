<?php

namespace App\Repositories;

interface DistrictRepositoryInterface
{
    /**
     * Get's total districts
     *
     * @return int
     */
    public function count();

    /**
     * Get's all districts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Get's all latest created districts.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number);

    /**
     * Get's a district by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Stores a district.
     *
     * @param array
     */
    public function store(array $postData);

    /**
     * Updates a district.
     *
     * @param int
     * @param array
     */
    public function update($id, array $postData);

    /**
     * Deletes a district.
     *
     * @param int
     */
    public function destroy($id);

}

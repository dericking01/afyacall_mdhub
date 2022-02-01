<?php

namespace App\Repositories;

interface WardRepositoryInterface
{
    /**
     * Get's total wards
     *
     * @return int
     */
    public function count();

    /**
     * Get's all wards.
     *
     * @return mixed
     */
    public function all();

    /**
     * Get's all latest created wards.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number);

    /**
     * Get's a ward by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Stores a ward.
     *
     * @param array
     */
    public function store(array $postData);

    /**
     * Updates a ward.
     *
     * @param int
     * @param array
     */
    public function update($id, array $postData);

    /**
     * Deletes a ward.
     *
     * @param int
     */
    public function destroy($id);

}

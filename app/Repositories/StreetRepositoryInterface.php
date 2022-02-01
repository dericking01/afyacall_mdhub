<?php

namespace App\Repositories;

interface StreetRepositoryInterface
{
    /**
     * Get's total streets
     *
     * @return int
     */
    public function count();

    /**
     * Get's all streets.
     *
     * @return mixed
     */
    public function all();

    /**
     * Get's all latest created streets.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number);

    /**
     * Get's a street by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Stores a street.
     *
     * @param array
     */
    public function store(array $postData);

    /**
     * Updates a street.
     *
     * @param int
     * @param array
     */
    public function update($id, array $postData);

    /**
     * Deletes a street.
     *
     * @param int
     */
    public function destroy($id);

}

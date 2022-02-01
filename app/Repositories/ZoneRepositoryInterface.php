<?php

namespace App\Repositories;

interface ZoneRepositoryInterface
{
    /**
     * Get's total zones
     *
     * @return int
     */
    public function count();

    /**
     * Get's all zones.
     *
     * @return mixed
     */
    public function all();

    /**
     * Get's all latest created zones.
     *
     * @param int
     * @return mixed
     */
    public function latestCreated($number);

    /**
     * Get's a zone by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Stores a zone.
     *
     * @param array
     */
    public function store(array $postData);

    /**
     * Updates a zone.
     *
     * @param int
     * @param array
     */
    public function update($id, array $postData);

    /**
     * Deletes a zone.
     *
     * @param int
     */
    public function destroy($id);

}

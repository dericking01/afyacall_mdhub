<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLocationReportsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropViewTotalPatientsPerRegion());
        DB::statement($this->dropViewTotalPatientsPerDistrict());
        DB::statement($this->dropViewTotalDoctorsPerRegion());
        DB::statement($this->dropViewTotalDoctorsPerDistrict());
        DB::statement($this->createViewTotalPatientsPerRegion());
        DB::statement($this->createViewTotalPatientsPerDistrict());
        DB::statement($this->createViewTotalDoctorsPerRegion());
        DB::statement($this->createViewTotalDoctorsPerDistrict());
    }

    private function createViewTotalPatientsPerRegion(): string
    {
        return <<<SQL
                CREATE VIEW `total_patients_per_region` AS
                SELECT
                    r.id AS `region_id`, r.name AS `region_name`, count(p.id) AS `total_patients`
                FROM 
                    regions r
                LEFT JOIN patients p ON r.id = p.region_id
                GROUP BY
                    r.id, r.name
                ;
                SQL;
    }

    private function createViewTotalPatientsPerDistrict(): string
    {
        return <<<SQL
                CREATE VIEW `total_patients_per_district` AS
                SELECT
                    r.id AS `region_id`, r.name AS `region_name`, di.id AS `district_id`, di.name AS `district_name`, count(p.id) AS `total_patients`
                FROM 
                    districts di
                LEFT JOIN regions r ON di.region_id = r.id
                LEFT JOIN patients p ON di.id = p.district_id
                GROUP BY
                    r.id, r.name, di.id, di.name
                ;      
                SQL;
    }

    private function createViewTotalDoctorsPerRegion(): string
    {
        return <<<SQL
                CREATE VIEW `total_doctors_per_region` AS
                SELECT
                    r.id AS `region_id`, r.name AS `region_name`, count(d.id) AS `total_doctors`
                FROM 
                    regions r
                LEFT JOIN doctors d ON r.id = d.region_id
                GROUP BY
                    r.id, r.name
                ;
                SQL;
    }

    private function createViewTotalDoctorsPerDistrict(): string
    {
        return <<<SQL
                CREATE VIEW `total_doctors_per_district` AS
                SELECT
                    r.id AS `region_id`, r.name AS `region_name`, di.id AS `district_id`, di.name AS `district_name`, count(d.id) AS `total_doctors`  
                FROM 
                    districts di
                LEFT JOIN regions r ON di.region_id = r.id
                LEFT JOIN doctors d ON di.id = d.district_id
                GROUP BY
                    r.id, r.name, di.id, di.name
                ;
                SQL;
    }

    private function dropViewTotalPatientsPerRegion(): string
    {
        return <<<SQL
                DROP VIEW IF EXISTS `total_patients_per_region`;
                SQL;
    }

    private function dropViewTotalPatientsPerDistrict(): string
    {
        return <<<SQL
                DROP VIEW IF EXISTS `total_patients_per_district`;
                SQL;
    }
    
    private function dropViewTotalDoctorsPerRegion(): string
    {
        return <<<SQL
                DROP VIEW IF EXISTS `total_doctors_per_region`;
                SQL;
    }
    
    private function dropViewTotalDoctorsPerDistrict(): string
    {
        return <<<SQL
                DROP VIEW IF EXISTS `total_doctors_per_district`;
                SQL;
    }
}

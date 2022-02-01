<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Model\TotalDoctorsPerDistrict;
use App\Model\TotalDoctorsPerRegion;
use App\Model\TotalPatientsPerDistrict;
use App\Model\TotalPatientsPerRegion;
use App\Model\Region;
use Exception;

class ReportsController extends Controller
{
    public function index()
    {
        $regions = Region::get();
        return view('regions.report')->with(compact('regions'));
    }

    public function getTotalPatientsAllRegions()
    {
        try {
            $totalPatients = TotalPatientsPerRegion::get();
            return response()->json(["data" => $totalPatients], 200);
        } catch (Exception $e) {
            return response()->json(["data" => []], 500);
        }
    }
    
    public function getTotalPatientsPerRegion($region_id)
    {
        try {
            $totalPatients = TotalPatientsPerDistrict::where('region_id', $region_id)->get();
            return response()->json(["data" => $totalPatients], 200);
        } catch (Exception $e) {
            return response()->json(["data" => []], 500);
        }
    } 

    public function getTotalDoctorsAllRegions()
    {
        try {
            $totalDoctors = TotalDoctorsPerRegion::get();
            return response()->json(["data" => $totalDoctors], 200);
        } catch (Exception $e) {
            return response()->json(["data" => []], 500);
        }
    }

    public function getTotalDoctorsPerRegion($region_id)
    {
        try {
            $totalDoctors = TotalDoctorsPerDistrict::where('region_id', $region_id)->get();
            return response()->json(["data" => $totalDoctors], 200);
        } catch (Exception $e) {
            return response()->json(["data" => []], 500);
        }
    }
}

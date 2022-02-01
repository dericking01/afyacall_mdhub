<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Model\District;
use App\Model\Region;
use App\Repositories\DistrictRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    protected $district;

    /**
     *
     * @param DistrictRepositoryInterface $district
     */
    public function __construct(DistrictRepositoryInterface $district)
    {
        $this->district = $district;
    }

    /**
     * Display a listing of District.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('total_count')) {
            return response()->json(District::count());
        }

        if ($request->has('latest_created')) {
            $number = !empty($request->get('latest_created')) ? $request->get('latest_created') : 5;
            $latestedCreatedDistricts = District::orderBy('created_at', 'desc')->take($number)->get();
            foreach ($latestedCreatedDistricts as $key => $value) {
                $region = $latestedCreatedDistricts[$key]->region;
                $wards = $latestedCreatedDistricts[$key]->wards;
            }
            return response()->json($latestedCreatedDistricts);
        }

        $districts = District::with(['region', 'wards'])->get();
        foreach ($districts as $key => $value) {
            $region = $districts[$key]->region;
            $wards = $districts[$key]->wards;
        }

        return view('districts.index')->with(compact('districts'));

    }

    /**
     * Create District.
     */
    public function create()
    {
        $regions = Cache::rememberForever('regions', function () {
            return DB::table('regions')->get();
        });
        return view('districts.create')->with(compact('regions'));
    }

    /**
     * Display a District.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $district = District::find($id);
        $region = $district->region;
        $wards = $district->wards;
        $streets = $district->streets;
        return view('districts.show')->with(compact('district'));
    }

    /**
     * Store a new District.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'region' => 'required',
        ]);

        $regionId = !empty($request->get('region')) ? $request->get('region') : null;
        $region = Region::findOrFail($regionId);

        $district = new District;
        $district->name = $request->get('name');
        $district->region()->associate($region);
        $district->save();

        return redirect('admin/districts/create')
            ->with(['success' => 'District added successfully'])
            ->with(compact('district'));
    }

    /**
     * Edit a district.
     */
    public function edit($id)
    {
        $district = $this->district->get($id);

        $regions = Cache::rememberForever('regions', function () {
            return DB::table('regions')->get();
        });

        return view('districts.edit')->with(compact('district', 'regions'));
    }

    /**
     * Update District in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'region' => 'required',
        ]);

        $regionId = !empty($request->get('region')) ? $request->get('region') : null;
        $region = Region::findOrFail($regionId);

        $district = District::findOrFail($id);
        $district->name = $request->get('name');
        $district->region()->associate($region);
        $district->save();

        return redirect('admin/districts/'.$id.'/edit')
            ->with(['success' => 'District updated successfully'])
            ->with(compact('district'));
    }

    /**
     * Remove District from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $district = District::findOrFail($id);
            $district->delete();
        } catch (Exception $exception) {
            return redirect('admin/districts')->with([
                'error'=>'District cannot be deleted. It may be referenced to other records.'
            ]);
        }

        return redirect('admin/districts')->with([
            'success'=>'District Deleted Successfully.'
        ]);
    }

    /**
     * Delete all selected District at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->get('ids')) {
            $entries = District::whereIn('id', $request->get('ids'))->get();

            foreach ($entries as $entry) {
                try {
                    $entry->delete();
                } catch (Exception $exception) {
                    return redirect('admin/districts')->with([
                        'error'=>'District cannot be deleted. It may be referenced to other records.'
                    ]);
                }
            }
        }
        return redirect('admin/districts')->with([
            'success'=>'Districts Deleted Successfully'
        ]);
    }

    public function wards($id)
    {
        $district = District::findOrFail($id);
        $wards = $district->wards;

        if ($wards->isEmpty()) {
            $data = [
                'success' => false,
                'error_message' => 'Cannot get wards',
                'data' => []
            ];
        } else {
            $wardResults = [];
            foreach ($wards as $ward) {
                $wardResults[] = [
                    'id' => $ward['id'],
                    'text' => $ward['name']
                ];
            }
            $data = [
                'success' => true,
                'data' => $wardResults
            ];
        }

        return response()->json($data);
    }
    
    /**
     * @param string $district District-name
     * 
     * @return int
     */
    public static function getId($district)
    {
        $district = DB::table('districts')->where('name', 'like', $district)->first();
        $data = [
            'success' => true,
            'id' => (isset($district->id) ? $district->id : ''),
        ];
        return response()->json($data);
    }

}

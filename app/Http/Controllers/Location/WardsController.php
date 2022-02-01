<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Model\District;
use App\Model\Ward;
use App\Repositories\WardRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class WardsController extends Controller
{
    protected $ward;

    /**
     *
     * @param WardRepositoryInterface $ward
     */
    public function __construct(WardRepositoryInterface $ward)
    {
        $this->ward = $ward;
    }
    /**
     * Display a listing of Ward.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('total_count')) {
            return response()->json(Ward::count());
        }

        if ($request->has('latest_created')) {
            $number = !empty($request->get('latest_created')) ? $request->get('latest_created') : 5;
            $latestedCreatedWards = Ward::orderBy('created_at', 'desc')->take($number)->get();
            foreach ($latestedCreatedWards as $key => $value) {
                $region = $latestedCreatedWards[$key]->region;
                $district = $latestedCreatedWards[$key]->district->makeHidden('region');
                $streets = $latestedCreatedWards[$key]->streets;
                $latestedCreatedWards[$key]['region'] = $district->region;
            }
            return response()->json($latestedCreatedWards);
        }

        $wards = Ward::with(['district', 'streets'])->get();
        foreach ($wards as $key => $value) {
            $region = $wards[$key]->region;
            $district = $wards[$key]->district->makeHidden('region');
            $streets = $wards[$key]->streets;
            $wards[$key]['region'] = $district->region;
        }

        return response()->json($wards);
        return view('wards.index')->with(compact('wards'));
    }

    /**
     * Display a Ward.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ward = Ward::with(['district', 'streets'])->find($id);
        $region = $ward->region;
        $district = $ward->district->makeHidden('region');
        $streets = $ward->streets;
        $ward['region'] = $district->region;

        return view('regions.show')->with(compact('ward'));
    }

    /**
     * Create Ward.
     */
    public function create()
    {
        $wards = Cache::rememberForever('districts', function () {
            return DB::table('districts')->get();
        });
        return view('wards.create')->with(compact('wards'));
    }

    /**
     * Store a new Ward.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'district' => 'required',
            'postcode' => 'nullable|digits:5',
        ]);

        $districtId = !empty($request->get('district')) ? $request->get('district') : null;
        $district = District::with('region')->findOrFail($districtId);

        $ward = new Ward;
        $ward->name = $request->get('name');
        $ward->postcode = $request->get('postcode');
        $ward->district()->associate($district);
        $ward->save();

        return redirect('admin/wards/create')
            ->with(['success' => 'Ward added successfully'])
            ->with(compact('ward'));
    }

    /**
     * Edit a ward.
     */
    public function edit($id)
    {
        $ward = $this->ward->get($id);

        $districts = Cache::rememberForever('districts', function () {
            return DB::table('districts')->get();
        });

        return view('wards.edit')->with(compact('districts', 'ward'));
    }

    /**
     * Update Ward in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'district' => 'required',
            'postcode' => 'nullable|digits:5',
        ]);

        $districtId = !empty($request->get('district')) ? $request->get('district') : null;   
        $district = District::with('region')->findOrFail($districtId);

        $ward = Ward::findOrFail($id);
        $ward->name = $request->get('name');
        $ward->postcode = $request->get('postcode');
        $ward->district()->associate($district);
        $ward->save();

        return redirect('admin/wards/'.$id.'/edit')
            ->with(['success' => 'Ward updated successfully'])
            ->with(compact('ward'));
    }

    /**
     * Remove Ward from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ward = Ward::findOrFail($id);
            $ward->delete();
        } catch (Exception $exception) {
            return redirect('admin/wards')->with([
                'error'=>'Ward cannot be deleted. It may be referenced to other records'
            ]);
        }
        return redirect('admin/wards')->with([
            'success'=>'Ward Deleted Successfully'
        ]);
    }

    /**
     * Delete all selected Ward at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->get('ids')) {
            $entries = Ward::whereIn('id', $request->get('ids'))->get();

            foreach ($entries as $entry) {
                try {
                    $entry->delete();
                } catch (Exception $exception) {
                    return redirect('admin/wards')->with([
                        'error'=>'Wards cannot be deleted. It may be referenced to other records.'
                    ]);
                }
            }
        }
        return redirect('admin/wards')->with([
            'success'=>'Wards Deleted Successfully.'
        ]);
    }

    public function streets($id)
    {
        $ward = Ward::with(['district', 'streets'])->findOrFail($id);
        $streets = $ward->streets;

        if ($streets->isEmpty()) {
            $data = [
                'success' => false,
                'error_message' => 'Cannot get streets',
                'data' => []
            ];
        } else {
            $streetResults = [];
            foreach ($streets as $street) {
                $streetResults[] = [
                    'id' => $street['id'],
                    'text' => $street['name']
                ];
            }
            $data = [
                'success' => true,
                'data' => $streetResults
            ];
        }

        return response()->json($data);
    }

    /**
     * @param string $ward Ward-name
     * 
     * @return int
     */
    public static function getId($ward)
    {
        $ward = DB::table('wards')->where('name', 'like', $ward)->first();
        $data = [
            'success' => true,
            'id' => (isset($ward->id) ? $ward->id : ''),
        ];
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Model\District;
use App\Model\Street;
use App\Model\Ward;
use App\Repositories\StreetRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class StreetsController extends Controller
{
    protected $street;

    /**
     *
     * @param StreetRepositoryInterface $street
     */
    public function __construct(StreetRepositoryInterface $street)
    {
        $this->street = $street;
    }

    /**
     * Display a listing of Street.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('total_count')) {
            return response()->json(Street::count());
        }

        if ($request->has('latest_created')) {
            $number = !empty($request->get('latest_created')) ? $request->get('latest_created') : 5;
            $latestedCreatedStreets = Street::orderBy('created_at', 'desc')->take($number)->get();
            foreach ($latestedCreatedStreets as $key => $value) {
                $ward = $latestedCreatedStreets[$key]->ward;
                $district = $latestedCreatedStreets[$key]->ward()->findOrFail($ward->id)->district;
                $region = $district->region;
                $latestedCreatedStreets[$key]['region'] = $region;
                $latestedCreatedStreets[$key]['district'] = $district->makeHidden('region');
            }
            return response()->json($latestedCreatedStreets);
        }

        $streets = Street::all();
        foreach ($streets as $key => $value) {
            $ward = $streets[$key]->ward;
            $district = $streets[$key]->ward()->findOrFail($ward->id)->district;
            $region = $district->region;
            $streets[$key]['region'] = $region;
            $streets[$key]['district'] = $district->makeHidden('region');
        }
        return view('streets.index')->with(compact('streets'));
    }

    /**
     * Display a Street.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $street = Street::findOrFail($id);
        $ward = $street->ward;
        $district = $street->ward()->findOrFail($ward->id)->district;
        $region = $district->region;
        $street['region'] = $region;
        $street['district'] = $district->makeHidden('region');

        return view('regions.show')->with(compact('street'));
    }

    /**
     * Create street.
     */
    public function create()
    {
        $wards = Cache::rememberForever('wards', function () {
            return DB::table('wards')->get();
        });
        return view('streets.create')->with(compact('wards'));
    }

    /**
     * Store a new Street.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ward' => 'required',
        ]);

        $wardId = !empty($request->get('ward')) ? $request->get('ward') : null;
        $ward = Ward::with('district')->findOrFail($wardId);

        $street = new Street;
        $street->name = $request->get('name');
        $street->ward()->associate($ward);
        $street->save();

        return redirect('admin/streets/create')
            ->with(['success' => 'Street added successfully'])
            ->with(compact('street'));
    }

    /**
     * Edit a street.
     */
    public function edit($id)
    {
        $street = $this->street->get($id);

        $wards = Cache::rememberForever('wards', function () {
            return DB::table('wards')->get();
        });

        return view('streets.edit')->with(compact('street', 'wards'));
    }

    /**
     * Update Street in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ward' => 'required',
        ]);

        $wardId = !empty($request->get('ward')) ? $request->get('ward') : null;
        $ward = Ward::with('district')->findOrFail($wardId);

        $street = Street::findOrFail($id);
        $street->name = $request->get('name');
        $street->ward()->associate($ward);
        $street->save();

		return redirect('admin/streets/'.$id.'/edit')
			->with(['success' => 'Street updated successfully'])
			->with(compact('street'));
    }

    /**
     * Remove Street from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $street = Street::findOrFail($id);
            $street->delete();
        } catch (Exception $exception) {
            return redirect('admin/streets')->with([
                'error'=>'Street cannot be deleted. It may be referenced to other records'
            ]);
        }

        return redirect('admin/streets')->with([
            'success'=>'Street Deleted Successfully'
        ]);
    }

    /**
     * Delete all selected Street at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->get('ids')) {
            $entries = Street::whereIn('id', $request->get('ids'))->get();

            foreach ($entries as $entry) {
                try {
                    $entry->delete();
                } catch (Exception $exception) {
                    return redirect('admin/streets')->with([
                        'error'=>'Street cannot be deleted. It may be referenced to other records'
                    ]);
                }
            }
        }
        return redirect('admin/streets')->with([
            'success'=>'Streets Deleted Successfully'
        ]);
    }

    /**
     * @param string $street Street-name
     * 
     * @return int
     */
    public static function getId($street)
    {
        $street = DB::table('streets')->where('name', 'like', $street)->first();
        $data = [
            'success' => true,
            'id' => (isset($street->id) ? $street->id : ''),
        ];
        return response()->json($data);
    }

}

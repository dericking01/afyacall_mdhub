<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\RegionStoreRequest;
use App\Repositories\RegionRepositoryInterface;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Pnlinh\InfobipSms\Facades\InfobipSms;

class RegionsController extends Controller
{
    protected $_region;

    /**
     *
     * @param RegionRepositoryInterface $region
     */
    public function __construct(RegionRepositoryInterface $region)
    {
        $this->region = $region;
    }

    /**
     * Display a listing of Region.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = $this->region->all();
        return view('regions.index')->with($regions);
    }

    /**
     * Create region view.
     */
    public function create()
    {
        return view('regions.create');
    }

    /**
     * Display a Region.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = $this->region->get($id);
        $districts = $region->districts;

        foreach ($districts as $district) {
            $wards = $district->wards;
            foreach ($district->wards as $ward) {
                $streets = $ward->streets;
            }
        }
        return view('regions.show')->with(compact('region'));
    }

    /**
     * Edit a Region.
     */
    public function edit($id)
    {
        $region = $this->region->get($id);
        $districts = $region->districts;

        foreach ($districts as $district) {
            $wards = $district->wards;
            foreach ($district->wards as $ward) {
                $streets = $$ward->streets;
            }
        }
        return view('regions.edit')->with(compact('region'));
    }

    /**
     * Store a new Region.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionStoreRequest $request)
    {
        $validatedData = $request->validated();
        $region = $this->region->store($validatedData);

        return redirect('admin/regions/create')
            ->with(['success' => 'Region added successfully'])
            ->with(compact('region'));
    }

    /**
     * Update Region in storage.
     *
     * @param  RegionStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, RegionStoreRequest $request)
    {
        $validatedData = $request->validated();
        $region = $this->region->update($id, $validatedData);

        return redirect('admin/regions/'.$id.'/edit')
            ->with(['success' => 'Region updated successfully'])
            ->with(compact('region'));
    }

    /**
     * Remove Region from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $region = $this->region->get($id);
            $region->delete();
        } catch (Exception $exception) {
            return redirect('admin/regions')->with([
                'error'=>'Region cannot be deleted. It may be referenced to other records.'
            ]);
        }
       
        return redirect('admin/regions')->with([
            'success'=>'Region cannot be deleted. It may be referenced to other records.'
        ]);
    }

    /**
     * Delete all selected Region at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->get('ids')) {
            $entries = $this->region->whereIn('id', $request->get('ids'))->get();

            foreach ($entries as $entry) {
                try {
                    $entry->delete();
                } catch (Exception $exception) {
                    return redirect('admin/regions')->with([
                        'error'=>'Region cannot be deleted. It may be referenced to other records.'
                    ]);
                }
            }
        }
        return redirect('admin/regions')->with([
            'success'=>'Regions Deleted Successfully'
        ]);
    }

    public function districts(Request $request)
    {
        $region = $this->region->get($request->id);
        $districts = $region->districts;

        if ($districts->isEmpty()) {
            $data = [
                'success' => false,
                'error_message' => 'Cannot get districts',
                'data' => []
            ];
        } else {
            $districtResults = [];
            foreach ($districts as $district) {
                $districtResults[] = [
                    'id' => $district['id'],
                    'text' => $district['name']
                ];
            }
            $data = [
                'success' => true,
                'data' => $districtResults
            ];
        }

        return response()->json($data);
    }
    
    /**
     * @param string $region Region-name
     * 
     * @return int
     */
    public static function getId($region)
    {
        $region = DB::table('regions')->where('name', 'like', $region)->first();
        $data = [
            'success' => true,
            'id' => (isset($region->id) ? $region->id : ''),
        ];
        return response()->json($data);
    }
}

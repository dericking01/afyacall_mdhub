<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Model\Zone;
use App\Repositories\ZoneRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    protected $zone;

    /**
     *
     * @param ZoneRepositoryInterface $zone
     */
    public function __construct(ZoneRepositoryInterface $zone)
    {
        $this->zone = $zone;
    }
    /**
     * Display a listing of Zone.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('total_count')) {
            return response()->json(Zone::count());
        }

        if ($request->has('latest_created')) {
            $number = !empty($request->get('latest_created')) ? $request->get('latest_created') : 5;
            $latestedCreatedZones = Zone::orderBy('created_at', 'desc')->take($number)->get();
            return response()->json($latestedCreatedZones);
        }

        // $activities = Zone::all();
        return view('zone.index')->with(compact('zone'));
    }

    /**
     * Create Zone.
     */
    public function create()
    {
        $zone = Cache::rememberForever('zone', function () {
            return DB::table('zone')->get();
        });
        return view('zone.create')->with(compact('zone'));
    }

    /**
     * Display a Zone.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zone::find($id);
        return view('regions.show')->with(compact('zone'));
    }

    /**
     * Store a new Zone.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $Zone = Zone::create([
            'name' => $request->get('name'),
        ]);

        return redirect('admin/zones/create')
            ->with(['success' => 'Zone added successfully'])
            ->with(compact('zone'));
    }
    /**
     * Edit a Zone.
     */
    public function edit($id)
    {
        $zone = $this->zone->get($id);

        $zone = Cache::rememberForever('zone', function () {
            return DB::table('zone')->get();
        });

        return view('zones.edit')->with(compact('zone'));
    }

    /**
     * Update Zone in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $Zone = Zone::findOrFail($id);
        $Zone->update([
            'name' => $request->get('name'),
        ]);

        return redirect('admin/zones/'.$id.'/edit')
            ->with(['success' => 'Zone updated successfully'])
            ->with(compact('zone'));}

    /**
     * Remove Zone from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Zone = Zone::findOrFail($id);
            $Zone->delete();
        } catch (Exception $exception) {
            return redirect('admin/zones')->with([
                'error'=>'Zones cannot be deleted. It may be referenced to other records'
            ]);
        }

        return redirect('admin/zones')->with([
            'success'=>'Zone Deleted Successfully'
        ]);
    }

    /**
     * Delete all selected Zone at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->get('ids')) {
            $entries = Zone::whereIn('id', $request->get('ids'))->get();

            foreach ($entries as $entry) {
                try {
                    $entry->delete();
                } catch (Exception $exception) {
                    return redirect('admin/zones')->with([
                        'error'=>'Zones cannot be deleted. It may be referenced to other records'
                    ]);
                }
            }
        }
        return redirect('admin/zones')->with([
            'success'=>'Zones Deleted Successfully'
        ]);
    }

}

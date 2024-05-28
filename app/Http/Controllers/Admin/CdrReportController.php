<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Call;
use App\Model\Cdr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class CdrReportController extends Controller
{
    public function index()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $calls = Call::with('user')->get();
        return view('admin.callsrecord.index', compact('calls'));
    }

    public function allcdr()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
	}
	$calls = Cdr::whereBetween('created_at',  [Carbon::now()->subDays(3), Carbon::now()])->orderBy('id', 'DESC')->get();
		//whereDate('created_at',Carbon::yesterday())->orderBy('id', 'DESC')->get();
        return view('admin.callsrecord.cdr', compact('calls'));
    }
}

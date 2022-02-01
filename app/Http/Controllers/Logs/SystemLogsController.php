<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SmsLog;

class SystemLogsController extends Controller
{
    public function userlogs()
    {
        $logs = \LogActivity::logActivityLists();
        return view('admin.userLogs.index',compact('logs'));
    }

    public function smslogs()
    {
        $logsms = SmsLog::all();
        return view('logs.smslogs',compact('logsms'));
    }

    public function emaillogs()
    {
        $logs = \LogActivity::logActivityLists();
        return view('admin.userLogs.index',compact('logs'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use romanzipp\QueueMonitor\Models\Monitor;

class UploadMonitorController extends Controller
{
    public function index()
    {
        $jobs = Monitor::where('name', 'App\Jobs\VideoUploadJob')
                       ->orderBy('started_at', 'desc')
                       ->paginate(15);

        return view('upload-monitor', compact('jobs'));
    }
}
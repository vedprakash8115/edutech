<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use romanzipp\QueueMonitor\Models\Monitor;
class UploadMonitor extends Component
{
    use WithPagination;

    public function render()
    {
        $jobs = Monitor::where('name', 'App\Jobs\VideoUploadJob')
                       ->orderBy('started_at', 'desc')
                       ->paginate(15);

        return view('livewire.upload-monitor', [
            'jobs' => $jobs
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;

class VideoUploadsComponent extends Component
{
    public $videoCourses;

    public function mount()
    {
        $this->videoCourses = VideoCourse::where('upload_progress', '>', 0)
                                         ->where('upload_progress', '<', 100)
                                         ->get();
    }

    public function render()
    {
        return view('livewire.video-uploads-component');
    }

    public function getListeners()
    {
        return [
            "echo:video-uploads,VideoUploaded" => 'updateUploadProgress',
        ];
    }

    public function updateUploadProgress($event)
    {
        $this->videoCourses = VideoCourse::where('upload_progress', '>', 0)
                                         ->where('upload_progress', '<', 100)
                                         ->get();
    }
}

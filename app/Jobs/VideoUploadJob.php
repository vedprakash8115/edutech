<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\VideoCourse;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    protected $videoCourse;
    protected $videoFile;

    public function __construct(VideoCourse $videoCourse, $videoFile)
    {
        $this->videoCourse = $videoCourse;
        $this->videoFile = $videoFile;
    }

    public function handle()
    {
        $destinationVideo = 'video';
        $videoFileName = time() . '_' . $this->videoFile->getClientOriginalName();
        
        // Simulate a time-consuming process
        $chunks = 10;
        $chunkSize = $this->videoFile->getSize() / $chunks;
        
        for ($i = 0; $i < $chunks; $i++) {
            // Simulate chunk upload
            usleep(500000); // Sleep for 0.5 seconds to simulate upload time
            
            $progress = ($i + 1) * (100 / $chunks);
            $this->queueProgress($progress);
        }

        // Move the file
        $this->videoFile->move(public_path($destinationVideo), $videoFileName);

        // Create a new entry in the videos table
        $this->videoCourse->videos()->create([
            'video_path' => $destinationVideo . '/' . $videoFileName
        ]);

        $this->queueProgress(100);
    }
}
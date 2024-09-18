<?php

// First, let's create a new job:

namespace App\Jobs;

use App\Models\VideoCourse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessVideoUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $courseId;
    protected $videoPath;
    protected $originalFileName;

    /**
     * Create a new job instance.
     *
     * @param int $courseId
     * @param string $videoPath
     * @param string $originalFileName
     */
    public function __construct($courseId, $videoPath, $originalFileName)
    {
        $this->courseId = $courseId;
        $this->videoPath = $videoPath;
        $this->originalFileName = $originalFileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $videoCourse = VideoCourse::findOrFail($this->courseId);

            $destinationVideo = 'video';
            $videoFileName = time() . '_' . $this->originalFileName;
            
            // Move the file from temporary storage to the final destination
            \Storage::move($this->videoPath, public_path($destinationVideo) . '/' . $videoFileName);

            // Create a new entry in the videos table
            $videoCourse->videos()->create([
                'video_path' => $destinationVideo . '/' . $videoFileName
            ]);

            Log::info('Video uploaded successfully for course: ' . $this->courseId);
        } catch (\Exception $e) {
            Log::error('Error processing video upload: ' . $e->getMessage());
        }
    }
}
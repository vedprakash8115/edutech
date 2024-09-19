<?php

namespace App\Jobs;

use App\Models\VideoCourse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProcessVideoCourse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $courseData;
    protected $bannerPath;
    protected $videoPaths;

    /**
     * Create a new job instance.
     *
     * @param array $courseData
     * @param string|null $bannerPath
     * @param array $videoPaths
     */
    public function __construct(array $courseData, $bannerPath = null, array $videoPaths = [])
    {
        $this->courseData = $courseData;
        $this->bannerPath = $bannerPath;
        $this->videoPaths = $videoPaths;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Handle Banner Upload
            if ($this->bannerPath) {
                $destinationPath = 'upload_banner';
                $bannerFileName = time() . '_' . basename($this->bannerPath);
                Storage::disk('public')->move($this->bannerPath, $destinationPath . '/' . $bannerFileName);
                $this->courseData['banner'] = $destinationPath . '/' . $bannerFileName;
            }

            // Calculate Course Duration
            $fromDate = Carbon::parse($this->courseData['from']);
            $toDate = Carbon::parse($this->courseData['to']);
            $courseDuration = $fromDate->diffInDays($toDate);
            $this->courseData['course_duration'] = $courseDuration;

            // Create Video Course
            $videoCourse = VideoCourse::create($this->courseData);

            // Handle Multiple Video Uploads
            foreach ($this->videoPaths as $path) {
                $destinationVideo = 'video';
                $videoFileName = time() . '_' . basename($path);
                Storage::disk('public')->move($path, $destinationVideo . '/' . $videoFileName);

                // Create a new entry in the videos table
                $videoCourse->videos()->create([
                    'video_path' => $destinationVideo . '/' . $videoFileName,
                ]);
            }

            Log::info('Video Course created successfully: ' . $videoCourse->id);
        } catch (\Exception $e) {
            Log::error('Error processing video course: ' . $e->getMessage());
            // You might want to implement a way to notify the user of this error
        }
    }
}




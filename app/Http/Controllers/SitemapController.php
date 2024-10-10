<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\VideoCourse; // Use your VideoCourse model

class SitemapController extends Controller
{
    public function index()
    {
        // Start creating the sitemap
        $sitemap = Sitemap::create();

        // Add static URLs
        $sitemap->add(Url::create('/')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/about')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.8));

        // Fetch all video courses from the database
        $videoCourses = VideoCourse::all();

        // Add dynamic video course URLs
        foreach ($videoCourses as $videoCourse) {
            $sitemap->add(Url::create("/course-details/{$videoCourse->id}")
                ->setLastModificationDate($videoCourse->updated_at) // Use the last updated date of the video course
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        // Write the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemap generated successfully.']);
    }
}

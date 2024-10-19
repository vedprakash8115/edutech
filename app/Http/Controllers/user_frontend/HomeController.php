<?php

namespace App\Http\Controllers\user_frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Slider;
use App\Models\SEO;
use App\Models\CourseCategory0;
use App\Models\VideoCourse;

class HomeController extends Controller
{
    public function index(){
        // Fetch top 4 testimonials with their associated user and role
        $testimonials = Testimonial::with(['user', 'role'])->take(4)->get();
        $route = request()->route()->getName();

if ($route == 'index') {
    try {
        $seos = SEO::where('page_slug', 'home')->firstOrFail();
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $seos = SEO::where('page_slug', 'default')->get();
    }
} else {
    $seos = SEO::where('page_slug', $route)->first() ?: SEO::where('page_slug', 'default')->first();
}

        // Fetch all sliders, you can add any sorting logic here, e.g. by position
        $sliders = Slider::orderBy('position', 'asc')->get();

        $categories = CourseCategory0::with(['videocourses'])->withCount('videoCourses')->latest()->take(4)->get();

        // Pass both testimonials and sliders to the frontend
        return view('frontend.index', compact('testimonials', 'sliders','categories','seos'));
    }

    public function details($id)
    {
        $route = request()->route()->getName();

        if ($route == 'index') {
            try {
                $seos = SEO::where('page_slug', 'home')->firstOrFail();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $seos = SEO::where('page_slug', 'default')->get();
            }
        } else {
            $seos = SEO::where('page_slug', $route)->first() ?: SEO::where('page_slug', 'default')->first();
        }
        // Fetch video by ID
        $video = VideoCourse::find($id);
    
        // If video is not found, handle it gracefully
        if (!$video) {
            return redirect()->route('index')->with('error', 'Video not found.');
        }
    
        // Pass the video data to the 'course-details' Blade view
        return view('frontend.details', compact('video' ,'seos'));
    }
    
    
}

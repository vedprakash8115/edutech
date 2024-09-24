<?php

namespace App\Http\Controllers\user_frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Slider;
use App\Models\CourseCategory0;
use App\Models\VideoCourse;

class HomeController extends Controller
{
    public function index(){
        // Fetch top 4 testimonials with their associated user and role
        $testimonials = Testimonial::with(['user', 'role'])->take(4)->get();

        // Fetch all sliders, you can add any sorting logic here, e.g. by position
        $sliders = Slider::orderBy('position', 'asc')->get();

        $categories = CourseCategory0::with(['videocourses'])->withCount('videoCourses')->latest()->take(4)->get();

        // Pass both testimonials and sliders to the frontend
        return view('frontend.index', compact('testimonials', 'sliders','categories'));
    }
}

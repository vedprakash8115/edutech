<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\VideoCourse;
use App\Models\CourseCategory0;

class StudentCourseController extends Controller
{
    public function index()
    {
        $courses = VideoCourse::all();
        $slider = Slider::all();
        return view('user-account.content.home', compact('slider','courses'));
    }
    public function details($id)
    {
        $course = VideoCourse::find($id)->with('videos');
        $slider = Slider::all();
        return view('user-account.content.course_detail', compact('slider','course'));
    }
    public function getCourses()
    {
        // Get all categories with their courses
        $categories = CourseCategory0::with('videoCourses')->get();
        
        // Transform the data for frontend consumption
        $courses = VideoCourse::with('courseCategory')->get()->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'category_id' => $course->course_category_id,
                'category_name' => $course->courseCategory->name,
                'description' => $course->description,
                'price' => $course->price,
                'discount_price' => $course->discount_price,
                'image' => $course->image_url ?? 'default-course-image.jpg',
                'features' => $course->features ?? ['Learn at your own pace', 'Expert instruction', '24/7 support'],
            ];
        });

        $categoryList = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name
            ];
        });

        return response()->json([
            'courses' => $courses,
            'categories' => $categoryList,
        ]);
    }
     
   public function courses()
{
    // Fetch categories along with their related videoCourses
    $categories = CourseCategory0::with('videoCourses')->get();

    // Debug and dump the videoCourses for all categories
    // dd($categories->pluck('videoCourses'));

    // Uncomment the next line to return the view after debugging
    return view('user-account.content.course_show', compact('categories'));
}

public function show($id)
{
    $course = VideoCourse::with('videos')->findOrFail($id);

    // You can add more related data here if needed
    // For example, if you have a reviews relationship:
    // $course->load('reviews');

    return view('user-account.content.course_detail', compact('course'));
}

// You can add more methods here for other course-related actions
// For example:

public function enroll(Request $request, $id)
{
    $course = VideoCourse::findOrFail($id);
    // Implement enrollment logic here
    // This could involve creating an enrollment record, processing payment, etc.
    
    return redirect()->back()->with('success', 'You have successfully enrolled in the course!');
}

public function watchVideo($courseId, $videoId)
{
    $course = VideoCourse::findOrFail($courseId);
    $video = $course->videos()->findOrFail($videoId);
    
    // Implement video watching logic here
    // This could involve checking if the user is enrolled, marking the video as watched, etc.
    
    return view('watch-video', compact('course', 'video'));
}


}

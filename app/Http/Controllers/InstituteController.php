<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InstituteController extends Controller
{
   public function index(){
        return view('ins.dashboard');
   }

   public function addcourse(){
      return view('ins.addcourse');
   }

   public function storeCourse(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Course::create([
            'name' => $request->name,
        ]);
        Alert::toast('Successfully added course!', 'success');


        return redirect()->back();
   }
   public function courseCategory(){
        $courses=Course::get();
        return view('ins.course_category',compact('courses'));
   }
   public function storeCategory(Request $request){
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'course_id' => 'required|exists:courses,id'
        ]);

        // Create a new category
        CourseCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $request->course_id
        ]);
        Alert::toast('Successfully added category!', 'success');

        return redirect()->back();
    }

   public function courseSubCategory(){
        return view('ins.course_subcategory');
    }
    public function storeSubCategory(Request $request){
        dd($request->all());
   }
}

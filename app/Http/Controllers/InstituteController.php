<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InstituteController extends Controller
{
    public function index()
    {
        return view('ins.dashboard');
    }

    public function addcourse()
    {
        return view('ins.addcourse');
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Course::create([
            'name' => $request->name,
        ]);
        Alert::toast('Successfully added course!', 'success');


        return redirect()->back();
    }
    public function courseList()
    {
        $courses = Course::get();
        return view('ins.course_list', compact('courses'));
    }
    public function getCoursesData()
    {
        $courses = Course::orderBy('id', 'desc')->where('status', 1)->select('id', 'name', 'status'); // Adjust the fields as necessary

        return DataTables::of($courses)
            ->addColumn('actions', function ($course) {
                return '<a href="' . route('edit_course', $course->id) . '" class="btn btn-info btn-md">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <form action="' . route('delete_course', $course->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-md">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function editCourse($id)
    {
        try {
            $single_data = Course::findOrFail($id);
            return view('ins.addcourse', compact('single_data'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Course not found');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while retrieving the course');
        }
    }

    public function updateCourse(Request $request, $id)
    {
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $course = Course::findOrFail($id);
            $course->update($validatedData);
            Alert::toast('Course updated successfully', 'success');
            return redirect()->route('course_list');
        } catch (ModelNotFoundException $e) {
            Alert::toast('Course not found', 'error');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::toast('An error occurred while updating the course', 'error');
            return redirect()->back();
        }
    }
    public function deleteCourse($id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                Alert::toast('Course not found.', 'error');
                return redirect()->back();
            }
            $course->update([
                'status' => 0
            ]);
            Alert::toast('Course Deleted Successfully!', 'success');
        } catch (\Exception $e) {

            Alert::toast('Error Deleting Course: ' . $e->getMessage(), 'error');
        }
        return redirect()->back();
    }

    public function courseCategory()
    {
        $courses = Course::get();
        $categories = CourseCategory::with('course')->where('status', 1)->get();
        return view('ins.course_category', compact('courses', 'categories'));
    }
    public function getCategoriesData()
    {
        $categories = CourseCategory::with('course')->orderBy('id', 'desc')->where('status', 1)->select('course_categories.*');
        return DataTables::of($categories)
            ->addColumn('actions', function ($category) {
                return '<a href="' . route('edit_category', $category->id) . '" class="btn btn-info btn-md">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <form action="' . route('delete_category', $category->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-md">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>';
            })
            ->editColumn('course_id', function ($category) {
                return $category->course->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function storeCategory(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'course_id' => 'required|exists:courses,id'
            ]);
            CourseCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'course_id' => $request->course_id
            ]);

            // Check if course_id is provided and update course level
            if ($request->course_id) {
                $course = Course::find($request->course_id);
                if ($course) {
                    if ($course->level == 1) {
                        $course->update([
                            'level' => 2,
                        ]);
                    }
                }
            }

            Alert::toast('Successfully added category!', 'success');
        } catch (ModelNotFoundException $e) {

            Alert::toast('Course not found.', 'error');
        } catch (Exception $e) {

            Alert::toast('An error occurred while adding the category.', 'error');
        }

        return redirect()->back();
    }

    public function editCategory($id)
    {
        $courses = Course::get();
        $categories = CourseCategory::with('course')->where('status', 1)->get();
        $single_data = CourseCategory::find($id);
        return view('ins.course_category', compact('single_data', 'courses', 'categories'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'course_id' => 'required|exists:courses,id'
        ]);

        // Find the category
        $category = CourseCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $request->course_id
        ]);

        Alert::toast('Category updated successfully!', 'success');

        return redirect()->route('course_category');
    }

    public function deleteCategory($id)
    {
        try {
            $cat = CourseCategory::find($id);

            if (!$cat) {
                Alert::toast('Category not found.', 'error');
                return redirect()->route('course_category');
            }
            $cat->update([
                'status' => 0
            ]);
            Alert::toast('Category deleted successfully!', 'success');
        } catch (\Exception $e) {

            Alert::toast('Error deleting category: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('course_category');
    }

    public function courseSubCategory()
    {
        $categories = CourseCategory::where('status', 1)->get(); // Adjusted to manage categories
        $subcategories = CourseSubCategory::with('category')->where('status', 1)->get();
        return view('ins.course_subcategory', compact('categories', 'subcategories'));
    }

    public function getSubcategoriesData()
    {
        $subcategories = CourseSubCategory::with('category')->orderBy('id', 'desc')->where('status', 1)->get();
        return DataTables::of($subcategories)
            ->addColumn('actions', function ($subcategory) {
                return '<a href="' . route('edit_subcategory', $subcategory->id) . '" class="btn btn-info btn-md">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <form action="' . route('delete_subcategory', $subcategory->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-md">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>';
            })
            ->editColumn('category_id', function ($subcategory) {
                return $subcategory->category->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function storeSubCategory(Request $request)
    {
        try {
            // Validate request data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:course_categories,id'
            ]);
            CourseSubCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id
            ]);
            $category = CourseCategory::find($request->category_id);
            if ($category) {
                $course = Course::find($category->course_id);
                if ($course) {
                    if ($course->level == 2) {
                        $course->update([
                            'level' => 3,
                        ]);
                    }
                } else {
                    throw new ModelNotFoundException('Course not found.');
                }
            } else {
                throw new ModelNotFoundException('Category not found.');
            }

            Alert::toast('Successfully added subcategory!', 'success');
        } catch (ModelNotFoundException $e) {
            Alert::toast($e->getMessage(), 'error');
        } catch (Exception $e) {
            Alert::toast('An error occurred while adding the subcategory.', 'error');
        }

        return redirect()->back();
    }

    public function editSubcategory($id)
    {
        $categories = CourseCategory::get();
        $subcategories = CourseSubCategory::with('category')->where('status', 1)->get();
        $single_data = CourseSubCategory::find($id);
        return view('ins.course_subcategory', compact('single_data', 'categories', 'subcategories'));
    }

    public function updateSubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:course_categories,id'
        ]);

        // Find the subcategory
        $subcategory = CourseSubCategory::findOrFail($id);
        $subcategory->update([
            'name' => $request->name ?? $subcategory->name,
            'description' => $request->description ?? $subcategory->description,
            'category_id' => $request->category_id ?? $subcategory->category_id
        ]);

        Alert::toast('Subcategory updated successfully!', 'success');

        return redirect()->route('course_subcategory');
    }

    public function deleteSubcategory($id)
    {
        try {
            $subcategory = CourseSubCategory::find($id);

            if (!$subcategory) {
                Alert::toast('Subcategory not found.', 'error');
                return redirect()->route('course_subcategory');
            }
            $subcategory->update([
                'status' => 0
            ]);
            Alert::toast('Subcategory deleted successfully!', 'success');
        } catch (\Exception $e) {

            Alert::toast('Error deleting subcategory: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('course_subcategory');
    }
}

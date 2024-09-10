<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\CourseCategory0;
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

    public function categoryLevel0()
    {
        return view('ins.categories.category_l0');
    }

    public function storeLevel0(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_category0s,name',
        ]);
        CourseCategory0::create([
            'name' => $request->name,
        ]);
        Alert::toast('Successfully added Category Level 0!', 'success');


        return redirect()->back();
    }
    public function level0List()
    {
        $category_l0 =CourseCategory0::get();
        return view('ins.categories.category_l0', compact('category_l0'));
    }
    // public function getLevel0Data()
    // {
    //     $courses =CourseCategory0::orderBy('id', 'desc')->where('status', 1)->select('id', 'name', 'status'); // Adjust the fields as necessary

    //     return DataTables::of($courses)
    //         ->addColumn('actions', function ($course) {
    //             return '<a href="' . route('edit_level0', $course->id) . '" class="btn btn-info btn-md">
    //                     <i class="fa fa-pencil" aria-hidden="true"></i>
    //                 </a>
    //                 <form action="' . route('delete_level0', $course->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
    //                     ' . csrf_field() . '
    //                     ' . method_field('DELETE') . '
    //                     <button type="submit" class="btn btn-danger btn-md">
    //                         <i class="fa fa-trash" aria-hidden="true"></i>
    //                     </button>
    //                 </form>';
    //         })
    //         ->rawColumns(['actions'])
    //         ->make(true);
    // }
    public function getLevel0Data()
    {
        $categories = CourseCategory0::where('status', 1)->select('course_category0s.*');
        return DataTables::of($categories)
            ->addColumn('actions', function ($category) {
                return '<a href="' . route('edit_level0', $category->id) . '" class="btn btn-info btn-md">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <form action="' . route('delete_level0', $category->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
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
    public function editLevel0($id)
    {
        try {
            $single_data = CourseCategory0::findOrFail($id);
            return view('ins.categories.category_l0', compact('single_data'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Course not found');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while retrieving the course');
        }
    }

    public function updateLevel0(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:course_category0s,name,' . $id,
                ],
            ]);

            $category0 =CourseCategory0::findOrFail($id);
            $category0->update($validatedData);
            Alert::toast('Category level 0 updated successfully', 'success');
            return redirect()->route('addlevel0');
        } catch (ModelNotFoundException $e) {
            Alert::toast('Category level 0 not found', 'error');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::toast('An error occurred while updating the Category level 0', 'error');
            return redirect()->back();
        }
    }
    public function deleteLevel0($id)
    {
        try {
            $category0 =CourseCategory0::find($id);

            if (!$category0) {
                Alert::toast('Category level 0 not found.', 'error');
                return redirect()->back();
            }
            $category0->delete();
            Alert::toast('Category level 0 Deleted Successfully!', 'success');
        } catch (\Exception $e) {

            Alert::toast('Error Deleting Category level 0: ' . $e->getMessage(), 'error');
        }
        return redirect()->back();
    }

    public function CategoryLevel1()
    {
        $category_l0 =CourseCategory0::get();
        $categories = CourseCategory::with('catLevel0')->where('status', 1)->get();
        return view('ins.categories.category_l1', compact('category_l0', 'categories'));
    }
    public function getLevel1Data()
    {
        $categories = CourseCategory::with('catLevel0')->orderBy('id', 'desc')->where('status', 1)->select('course_categories.*');
        return DataTables::of($categories)
            ->addColumn('actions', function ($category) {
                return '<a href="' . route('edit_level1', $category->id) . '" class="btn btn-info btn-md">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <form action="' . route('delete_level1', $category->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-md">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>';
            })
            ->editColumn('cat0_id', function ($category) {
                return $category->catLevel0->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function StoreLevel1(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:course_categories,name',
                // 'description' => 'required|string',
                'cat0_id' => 'required|exists:course_category0s,id'
            ]);
            CourseCategory::create([
                'name' => $request->name,
                // 'description' => $request->description,
                'cat0_id' => $request->cat0_id
            ]);

            // Check if cat0_id is provided and update course level
            if ($request->cat0_id) {
                $category0 =CourseCategory0::find($request->cat0_id);
                if ($category0) {
                    if ($category0->level == 1) {
                        $category0->update([
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

    public function editLevel1($id)
    {
        $category_l0 =CourseCategory0::get();
        $categories = CourseCategory::with('catLevel0')->where('status', 1)->get();
        $single_data = CourseCategory::find($id);
        return view('ins.categories.category_l1', compact('single_data', 'category_l0', 'categories'));
    }

    public function updateLevel1(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_categories,name,' . $id,
            // 'description' => 'required|string',
            'cat0_id' => 'required|exists:course_category0s,id'
        ]);

        // Find the category
        $category = CourseCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            // 'description' => $request->description,
            'cat0_id' => $request->cat0_id
        ]);

        Alert::toast('Category updated successfully!', 'success');

        return redirect()->route('category_level1');
    }

    public function deleteLevel1($id)
    {
        try {
            $cat = CourseCategory::find($id);

            if (!$cat) {
                Alert::toast('Category not found.', 'error');
                return redirect()->route('course_category');
            }
            $cat->delete();
            Alert::toast('Category deleted successfully!', 'success');
        } catch (\Exception $e) {

            Alert::toast('Error deleting category: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('category_level1');
    }

    public function courseSubCategory()
    {
        $categories = CourseCategory::where('status', 1)->get(); // Adjusted to manage categories
        $subcategories = CourseSubCategory::with('category')->where('status', 1)->get();
        return view('ins.categories.category_l2', compact('categories', 'subcategories'));
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
            $request->validate([
                'name' => 'required|string|max:255|unique:course_sub_categories,name',
                // 'description' => 'required|string',
                'category_id' => 'required|exists:course_categories,id'
            ]);
            CourseSubCategory::create([
                'name' => $request->name,
                // 'description' => $request->description,
                'category_id' => $request->category_id
            ]);
            $category = CourseCategory::find($request->category_id);
            if ($category) {
                $category0 =CourseCategory0::find($category->cat0_id);
                if ($category0) {
                    if ($category0->level == 2) {
                        $category0->update([
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
        return view('ins.categories.category_l2', compact('single_data', 'categories', 'subcategories'));
    }

    public function updateSubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_sub_categories,name,' . $id,
            // 'description' => 'required|string',
            'category_id' => 'required|exists:course_categories,id'
        ]);

        // Find the subcategory
        $subcategory = CourseSubCategory::findOrFail($id);
        $subcategory->update([
            'name' => $request->name ?? $subcategory->name,
            // 'description' => $request->description ?? $subcategory->description,
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
            $subcategory->delete();
            Alert::toast('Subcategory deleted successfully!', 'success');
        } catch (\Exception $e) {

            Alert::toast('Error deleting subcategory: ' . $e->getMessage(), 'error');
        }

        return redirect()->route('course_subcategory');
    }
}

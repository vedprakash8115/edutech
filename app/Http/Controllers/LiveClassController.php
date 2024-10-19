<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use Carbon\Carbon;
use DataTables;
use App\Models\CourseCategory0;
use App\Models\CourseCategory;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\LiveClassesDataTable;
use App\Models\CourseSubCategory;
use App\Models\VideoCourse;
use App\Models\LiveClassPdf;
use App\Http\Requests\StoreliveClassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class LiveClassController extends Controller
{
    public function index(LiveClassesDataTable $dataTable, Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $courses = VideoCourse::all();
            // Get all live classes for Yajra data table
            $liveClasses = LiveClass::paginate($perPage)->appends($request->query());

            // Fetch current classes (i.e., classes currently ongoing)
            $currentClasses = LiveClass::where('from', '<=', now())
                                       ->where('to', '>=', now())
                                       ->latest()
                                       ->take(4)
                                       ->get(); // No pagination needed for current/upcoming classes

            // Fetch upcoming classes (i.e., classes that will start in the future)
            $upcomingClasses = LiveClass::where('from', '>', now())
                                        ->latest()
                                        ->take(4)
                                        ->get();
    
            $categories = CourseCategory0::all();
            $request->session()->forget('single_data');

            // Pass both current and upcoming classes along with the Yajra data table
            return $dataTable->render('ins.content.liveclass', [
                'liveClasses' => $liveClasses,       // For the Yajra data table
                'currentClasses' => $currentClasses, // For the current live classes box
                'upcomingClasses' => $upcomingClasses, // For the upcoming classes box
                'categories' => $categories,
                'courses' => $courses,
            ]);
        } catch (Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            Alert::toast('An error occurred while loading live classes.', 'error');
            return redirect()->back();
        }
    }

    public function getCategoryOptions($parentId)
    {
        try {
            $category = CourseCategory::where('cat0_id', $parentId)->get();
            return response()->json($category);
        } catch (Exception $e) {
            Log::error('Error in getCategoryOptions: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching categories.'], 500);
        }
    }

    public function getCategory_2Options($parentId)
    {
        try {
            $category = CourseSubCategory::where('category_id', $parentId)->get();
            return response()->json($category);
        } catch (Exception $e) {
            Log::error('Error in getCategory_2Options: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching subcategories.'], 500);
        }
    }

    public function getData()
    {
        try {
            $liveClasses = LiveClass::select(['id', 'course_name', 'language', 'discount_type', 'discount_price', 'original_price', 'course_duration', 'from', 'to']);
            return DataTables::of($liveClasses)->toJson();
        } catch (Exception $e) {
            Log::error('Error in getData: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching live class data.'], 500);
        }
    }

    public function create()
    {
        try {
            return view('ins.content.liveclass');
        } catch (Exception $e) {
            Log::error('Error in create method: ' . $e->getMessage());
            Alert::toast('An error occurred while loading the create form.', 'error');
            return redirect()->back();
        }
    }

    public function store(StoreliveClassRequest $request)
    {
        try {
            // Validate the input data
            $validatedData = $request->validated();

            // Handle banner upload (as before)
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $destinationPath = 'upload_banner';
                $fileName = time() . '_' . $bannerFile->getClientOriginalName();
                $bannerFile->move(public_path($destinationPath), $fileName);
                $validatedData['banner'] = $destinationPath . '/' . $fileName;
            }

            // Set the status to active
            $validatedData['status'] = 1;

            // Create the live class entry in the database
            $liveClass = LiveClass::create($validatedData);

            // Handle multiple PDF uploads and store in `live_class_pdfs` table
            if ($request->hasFile('course_pdfs')) {
                foreach ($request->file('course_pdfs') as $pdfFile) {
                    $fileName = time() . '_' . $pdfFile->getClientOriginalName();
                    $destinationPath = 'pdfs'; // Folder for storing PDFs
                    $pdfFile->move(public_path($destinationPath), $fileName);

                    // Save each PDF path to the live_class_pdfs table
                    LiveClassPdf::create([
                        'live_class_id' => $liveClass->id,
                        'pdf_path' => $destinationPath . '/' . $fileName
                    ]);
                }
            }

            // Show success message
            Alert::toast('Live Class has been added successfully', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            // Log error for debugging
            Log::error('Error in store method: ' . $e->getMessage());

            // Show error message
            Alert::toast('An error occurred while creating the live class.', 'error');
            return redirect()->back()->withInput();
        }
    }


    public function edit($id, Request $request, LiveClassesDataTable $dataTable)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $liveClasses = LiveClass::paginate($perPage)->appends($request->query());
            $single_data = LiveClass::findOrFail($id);
            $categories = CourseCategory0::all();

            $currentClasses = LiveClass::where('from', '<=', now())
            ->where('to', '>=', now())
            ->get(); // No pagination needed for current/upcoming classes

            // Fetch upcoming classes (i.e., classes that will start in the future)
            $upcomingClasses = LiveClass::where('from', '>', now())->get();

            Alert::toast('You are editing a Live Class.', 'info');

            return $dataTable->render('ins.content.liveclass', [
                'liveClasses' => $liveClasses,
                'categories' => $categories,
                'currentClasses' => $currentClasses, // For the current live classes box
                'upcomingClasses' => $upcomingClasses, // For the upcoming classes box
                'single_data' => $single_data
            ]);
        } catch (Exception $e) {
            Log::error('Error in edit method: ' . $e->getMessage());
            Alert::toast('An error occurred while loading the edit form.', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'course_name' => 'required|string|max:255',
                'language' => 'required|string|max:255',

                'is_paid' => 'boolean',
                'price' => 'nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'from' => 'required|date',
                'to' => 'nullable|date',
                'cat_level_0' => 'required|integer',
                'cat_level_1' => 'nullable|integer',
                'cat_level_2' => 'nullable|integer',
                'course_duration' => 'required',
            ]);
            $liveClass = LiveClass::findOrFail($id);
            if ($request->input('is_paid') == 0) {
                $validatedData['price'] = null;
                $validatedData['discount_price'] = null;
            }

               if ($request->hasFile('course_pdfs')) {
                foreach ($request->file('course_pdfs') as $pdfFile) {
                    $fileName = time() . '_' . $pdfFile->getClientOriginalName();
                    $destinationPath = 'pdfs'; // Folder for storing PDFs
                    $pdfFile->move(public_path($destinationPath), $fileName);

                    // Save each PDF path to the live_class_pdfs table
                    LiveClassPdf::create([
                        'live_class_id' => $liveClass->id,
                        'pdf_path' => $destinationPath . '/' . $fileName
                    ]);
                }
            }
            if ($request->input('is_paid') == 1 && is_null($request->input('price'))) {
                Alert::toast('The price is required for paid courses.', 'error');
                return redirect()->back()->withInput();
            }


            $liveClass->update($validatedData);

            Alert::toast('Live Class updated successfully', 'success');
            return redirect()->route('liveclass');
        } catch (Exception $e) {
            Log::error('Error in update method: ' . $e->getMessage());
            Alert::toast('An error occurred while updating the live class.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $liveClass = LiveClass::findOrFail($id);
            $liveClass->delete();

            Alert::toast('Live Class deleted successfully', 'success');
            return redirect()->route('liveclass');
        } catch (Exception $e) {
            Log::error('Error in destroy method: ' . $e->getMessage());
            Alert::toast('An error occurred while deleting the live class.', 'error');
            return redirect()->back();
        }
    }

    public function resetSession(Request $request)
    {
        try {
            $request->session()->forget('single_data');
            Alert::toast('Session data cleared successfully', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Error in resetSession method: ' . $e->getMessage());
            Alert::toast('An error occurred while clearing session data.', 'error');
            return redirect()->back();
        }
    }
}
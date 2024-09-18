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
use App\Http\Requests\StoreLiveClassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class LiveClassController extends Controller
{
    public function index(LiveClassesDataTable $dataTable, Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $liveClasses = LiveClass::paginate($perPage)->appends($request->query());
            $categories = CourseCategory0::all();
            $request->session()->forget('single_data');

            return $dataTable->render('ins.content.liveclass', [
                'liveClasses' => $liveClasses,
                'categories' => $categories
            ]);
        } catch (Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while loading live classes.');
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
            Alert::error('Error', 'An error occurred while loading the create form.');
            return redirect()->back();
        }
    }

    public function store(StoreLiveClassRequest $request)
    {
        try {
            $validatedData = $request->validated();
    
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $destinationPath = 'upload_banner';
                $fileName = time() . '_' . $bannerFile->getClientOriginalName();
                $bannerFile->move(public_path($destinationPath), $fileName);
                $validatedData['banner'] = $destinationPath . '/' . $fileName;
            }
    
            $fromDate = Carbon::parse($validatedData['from']);
            $toDate = Carbon::parse($validatedData['to']);
    
           
    
            // Format duration as HH:MM:SS
            // $courseDuration = sprintf('%02d:%02d:00', $hours, $minutes);
    
            // $validatedData['course_duration'] = $courseDuration;
            $validatedData['status'] = 1;
    
            LiveClass::create($validatedData);
    
            Alert::success('Success', 'Live Class has been added successfully');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while creating the live class.');
            return redirect()->back();
        }
    }
    

    public function show(LiveClass $liveClass) 
    {
        // Implementation if needed
    }

    public function edit($id, Request $request, LiveClassesDataTable $dataTable)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $liveClasses = LiveClass::paginate($perPage)->appends($request->query());
            $single_data = LiveClass::findOrFail($id);
            $categories = CourseCategory0::all();

            Alert::info('Info', 'You are editing a Live Class.');

            return $dataTable->render('ins.content.liveclass', [
                'liveClasses' => $liveClasses,
                'categories' => $categories,
                'single_data' => $single_data
            ]);
        } catch (Exception $e) {
            Log::error('Error in edit method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while loading the edit form.');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'course_name' => 'required|string|max:255',
                'language' => 'required|string|max:255',
                'discount_type' => 'required|string|max:255',
                'is_paid' => 'boolean',
                'price' => 'nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'from' => 'required|date',
                'to' => 'required|date',
                'cat_level_0' => 'required|integer',
                'cat_level_1' => 'nullable|integer',
                'cat_level_2' => 'nullable|integer',
                'course_duration' => 'required',
            ]);
    
            // Check if is_paid is 0, set price and discount_price to null
            if ($request->input('is_paid') == 0) {
                $validatedData['price'] = null;
                $validatedData['discount_price'] = null;
            }
    
            // Check if is_paid is 1, ensure price is provided
            if ($request->input('is_paid') == 1 && is_null($request->input('price'))) {
                return redirect()->back()->withErrors([
                    'price' => 'The price is required for paid courses.'
                ])->withInput();
            }
    
            // Find the live class by ID
            $liveClass = LiveClass::findOrFail($id);
    
            // Update the live class with the validated data
            $liveClass->update($validatedData);
    
            // Success alert
            Alert::success('Success', 'Live Class updated successfully');
            return redirect()->route('liveclass');
        } catch (\Exception $e) {
            // Log the error and return with an error alert
            Log::error('Error in update method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while updating the live class.');
            return redirect()->back()->withInput();
        }
    }
    

    public function destroy($id)
    {
        try {
            $liveClass = LiveClass::findOrFail($id);
            $liveClass->delete();

            Alert::success('Success', 'Live Class deleted successfully');
            return redirect()->route('liveclass');
        } catch (Exception $e) {
            Log::error('Error in destroy method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while deleting the live class.');
            return redirect()->back();
        }
    }

    public function resetSession(Request $request)
    {
        try {
            $request->session()->forget('single_data');
            Alert::success('Success', 'Session data cleared successfully');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Error in resetSession method: ' . $e->getMessage());
            Alert::error('Error', 'An error occurred while clearing session data.');
            return redirect()->back();
        }
    }
}
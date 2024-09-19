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
    
            $validatedData['status'] = 1;
    
            LiveClass::create($validatedData);
    
            Alert::toast('Live Class has been added successfully', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage());
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

            Alert::toast('You are editing a Live Class.', 'info');

            return $dataTable->render('ins.content.liveclass', [
                'liveClasses' => $liveClasses,
                'categories' => $categories,
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
    
            if ($request->input('is_paid') == 0) {
                $validatedData['price'] = null;
                $validatedData['discount_price'] = null;
            }
    
            if ($request->input('is_paid') == 1 && is_null($request->input('price'))) {
                Alert::toast('The price is required for paid courses.', 'error');
                return redirect()->back()->withInput();
            }
    
            $liveClass = LiveClass::findOrFail($id);
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
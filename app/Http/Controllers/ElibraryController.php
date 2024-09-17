<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory0;
use App\Models\ELibrary;
use App\Models\ELibraryFile;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\ELibraryDataTable;
use Exception;
use Illuminate\Support\Facades\Log;

class ElibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(ElibraryDataTable $dataTable, Request $request)
{

        // Fetch paginated elibrary items
        $perPage = $request->input('per_page', 10);
        $elibraryItems = Elibrary::paginate($perPage)->appends($request->query());
        $categories = CourseCategory0::all();
        // Render the DataTable view with elibraryItems data
        return $dataTable->render('ins.content.e_library', [
            'elibraryItems' => $elibraryItems,
            'categories'=>$categories,
        ]);
    // } catch (\Exception $e) {
    //     Log::error('Error in index method: ' . $e->getMessage());
    //     Alert::error('Error', 'An error occurred while loading e-library items.');
    //     return redirect()->back();
    // }
}

    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the input data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'cat_level_0' => 'required|exists:course_categories,id',
                'cat_level_1' => 'nullable|exists:course_categories,id',
                'cat_level_2' => 'nullable|exists:course_categories,id',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_paid' => 'boolean',
                'price' => 'nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'files' => 'nullable',
                'files.*' => 'mimes:pdf,doc,docx,txt', // Validate multiple files
                'description' => 'nullable|string',
            ]);
    
            // Handle banner upload
            $bannerPath = null;
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $bannerFileName = time() . '_' . $bannerFile->getClientOriginalName();
                $bannerDestinationPath = 'upload_banner';
                $bannerFile->move(public_path($bannerDestinationPath), $bannerFileName);
                $bannerPath = $bannerDestinationPath . '/' . $bannerFileName;
            }
    
            // Create eLibrary entry
            $eLibrary = Elibrary::create([
                'title' => $validatedData['title'],
                'cat_level_0' => $validatedData['cat_level_0'],
                'cat_level_1' => $validatedData['cat_level_1'],
                'cat_level_2' => $validatedData['cat_level_2'],
                'banner' => $bannerPath,
                'is_paid' => $validatedData['is_paid'] ?? false,
                'price' => $validatedData['price'],
                'discount_price' => $validatedData['discount_price'],
                'description' => $validatedData['description'],
            ]);
    
            // Handle file uploads for multiple files
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $fileDestinationPath = 'elibrary';
                    $file->move(public_path($fileDestinationPath), $fileName);
    
                    // Store file data in a separate table (related to eLibrary)
                    ElibraryFile::create([
                        'elibrary_id' => $eLibrary->id,
                        'file_path' => $fileDestinationPath . '/' . $fileName,
                    ]);
                }
            }
    
            // Success notification with SweetAlert
            Alert::success('Success', 'E-Library item added successfully.');
            return redirect()->route('elibrary');
    
        } catch (Exception $e) {
            // Error notification with SweetAlert
            Alert::error('Error', 'Something went wrong. Please try again.');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElibraryDataTable $dataTable, $id, Request $request)
    {
        $single_data = ELibrary::findOrFail($id);
    
        // Fetch paginated elibrary items (similar to the index method)
        $perPage = $request->input('per_page', 10);
        $elibraryItems = Elibrary::paginate($perPage)->appends($request->query());
        
        $categories = CourseCategory0::all(); // Assuming you have a Category model
    
        // Render the DataTable view with elibraryItems data
        return $dataTable->render('ins.content.e_library', [
            'single_data' => $single_data,
            'elibraryItems' => $elibraryItems,
            'categories' => $categories,
        ]);


        // $single_data = VideoCourse::with('videos')->findOrFail($id);
    
        // // Handle pagination for DataTables
        // $perPage = $request->input('per_page', 10);
        // $videoCourses = VideoCourse::with('videos')->paginate($perPage)->appends($request->query());

        // return $dataTable->render('ins.content.videocourse', [
        //     'single_data' => $single_data,
        //     'videoCourses' => $videoCourses,
        // ]);
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
            // Find the E-Library item by ID or throw an exception if not found
            $eLibrary = ELibrary::findOrFail($id);
            $categories = CourseCategory0::all();
            // Validate the request inputs
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'cat_level_0' => 'required',
                'cat_level_1' => 'required',
                'cat_level_2' => 'required',
                'is_paid' => 'boolean',
                'price' => 'required_if:is_paid,1|nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'banner' => 'nullable|image|max:2048', // 2MB Max
                'description' => 'nullable|string',
            ]);
    
            // Handle banner upload if a new one is provided
            if ($request->hasFile('banner')) {
                // Store new banner in 'public/upload_banner' directory
                $banner = $request->file('banner');
                $bannerName = time() . '_' . $banner->getClientOriginalName();
                $banner->move(public_path('upload_banner'), $bannerName);
    
                // Add the new banner path to the validated data
                $validatedData['banner'] = 'upload_banner/' . $bannerName;
    
                // Optionally, delete the old banner if it exists
                // if ($eLibrary->banner && Storage::exists(public_path($eLibrary->banner))) {
                //     Storage::delete(public_path($eLibrary->banner));
                // }
            }
    
            // Update the E-Library item using the validated data
            $eLibrary->update($validatedData);
    
            // Success alert and redirect
            Alert::success('Success', 'E-Library item updated successfully.');
            return redirect()->route('elibrary');
            
        
    }
    
    public function files(Request $request, $id)
    {
        // Fetch the eLibrary item along with related files, filtered by the given ID, and paginate the result
        $elibraryItems = ELibrary::with('files')
            ->where('id', $id)
            ->paginate(10);  // Apply pagination after filtering by ID
        
        return view('ins.content.files', ['elibraryItems'=>$elibraryItems]);
    }
    

public function deleteMultiple(Request $request)
{
    $fileIds = $request->input('files');

    if (!$fileIds) {
        return redirect()->back()->with('error', 'No files selected for deletion.');
    }

    try {
        $files = ELibraryFile::whereIn('id', $fileIds)->get();

        foreach ($files as $file) {
            // if ($file->file_path && Storage::exists($file->file_path)) {
            //     Storage::delete($file->file_path);
            // }
            $file->delete();
        }

        Alert::success('Success', 'Selected files deleted successfully.');
        return redirect()->route('elibrary');
    } catch (\Exception $e) {
        Log::error('Error deleting files: ' . $e->getMessage());
        Alert::error('Error', 'An error occurred while deleting the files.');
        return redirect()->back();
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function uploadFiles(Request $request)
{
    // Validate that files are provided and an elibrary_id is given
    $request->validate([
        'image.*' => 'required|file', // Add file types as per your requirement
        'elibrary_id' => 'required|exists:elibraries,id',
    ]);

    $elibraryId = $request->elibrary_id;
    $files = $request->file('image');
    
    if ($files) {
        foreach ($files as $file) {
            // Define the path where you want to move the file
            $filePath = 'elibrary/';
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move the file to the public path
            $file->move($filePath, $fileName);

            // Save the file path in the database
            ElibraryFile::create([
                'elibrary_id' => $elibraryId,
                'file_path' => $filePath . $fileName,
            ]);
        }
    }

    // Using SweetAlert for success notification
    alert()->success('Success', 'Files uploaded successfully!');

    return redirect()->back();
}

    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory0;
use App\Models\Elibrary;
use App\Models\ElibraryFile;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\ElibraryDataTable;
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
            'categories' => $categories,
        ]);
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
                'cat_level_0' => 'required',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_paid' => 'boolean',
                'price' => 'nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'files' => 'required|array', // Ensure that 'files' is an array
                'files.*' => 'required|max:10240', // Validate each file
                'course_duration' => 'required',
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
                // 'cat_level_1' => $validatedData['cat_level_1'],
                // 'cat_level_2' => $validatedData['cat_level_2'],
                'banner' => $bannerPath,
                'is_paid' => $validatedData['is_paid'] ?? false,
                'price' => $validatedData['price'],
                'discount_price' => $validatedData['discount_price'],
                'description' => $validatedData['description'],
                'course_duration' => $validatedData['course_duration'],
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

            // Success notification with SweetAlert toast
            Alert::toast('E-Library item added successfully.', 'success');
            return redirect()->route('elibrary');

        } catch (Exception $e) {
            // Error notification with SweetAlert toast
            Alert::toast('Something went wrong. Please try again.', 'error');
            return redirect()->route('elibrary')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElibraryDataTable $dataTable, $id, Request $request)
    {
        $single_data = Elibrary::findOrFail($id);

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the E-Library item by ID or throw an exception if not found
        $eLibrary = Elibrary::findOrFail($id);
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
            'banner' => 'nullable|image|max:2048',
            'course_duration' => 'required',
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
        }

        // Update the E-Library item using the validated data
        $eLibrary->update($validatedData);

        // Success alert and redirect with SweetAlert toast
        Alert::toast('E-Library item updated successfully.', 'success');
        return redirect()->route('elibrary');
    }

    /**
     * Display files of a specific resource.
     */
    public function files(Request $request, $id)
    {
        // Fetch the eLibrary item along with related files, filtered by the given ID, and paginate the result
        $elibraryItems = Elibrary::with('files')
            ->where('id', $id)
            ->paginate(10);  // Apply pagination after filtering by ID

        return view('ins.content.files', ['elibraryItems' => $elibraryItems]);
    }

    /**
     * Delete multiple files.
     */
    public function deleteMultiple(Request $request)
    {
        $fileIds = $request->input('files');

        if (!$fileIds) {
            return redirect()->back()->with('error', 'No files selected for deletion.');
        }

        try {
            $files = ElibraryFile::whereIn('id', $fileIds)->get();

            foreach ($files as $file) {
                $file->delete();
            }

            // Success toast notification
            Alert::toast('Selected files deleted successfully.', 'success');
            return redirect()->route('elibrary');
        } catch (Exception $e) {
            Log::error('Error deleting files: ' . $e->getMessage());
            // Error toast notification
            Alert::toast('An error occurred while deleting the files.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Handle file uploads.
     */
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

            // Success alert with SweetAlert toast
            Alert::toast('Files uploaded successfully.', 'success');
        }

        return response()->json(['message' => 'Files uploaded successfully.']);
    }
}

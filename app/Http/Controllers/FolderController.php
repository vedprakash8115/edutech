<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use App\Models\VideoCourse;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    // Display the folder structure for a specific video course or a folder
    public function index(Request $request,$id)
    {
        // Controller (rendering the view)
        $allFolders = Folder::where('video_course_id', $id)->get();

        $videoCourse = VideoCourse::with(['folders' => function ($query) {
            $query->whereNull('parent_folder_id'); // Only fetch root folders
        }])->findOrFail($id);
        $currentRouteIsRootLevel = true;

        $filesAtRoot = File::where('video_course_id', $id)
        ->whereNull('folder_id')
        ->get();

        return view('ins.content.folders.folders', compact('videoCourse','currentRouteIsRootLevel','filesAtRoot','allFolders'));
    }
    public function showFolder(Request $request,$id)
    {

    
        // Fetch the folder by ID
        $folder = Folder::with(['subfolders', 'files'])->findOrFail($id);
        $videoCourse = $folder->videoCourse;
        $allFolders = Folder::where('video_course_id', $videoCourse->id)->get();


        // Generate breadcrumbs if needed
        $breadcrumbs = $this->getBreadcrumbs($folder);
        $currentRouteIsRootLevel = false;

        

        return view('ins.content.folders.folders', compact('folder', 'breadcrumbs','currentRouteIsRootLevel','videoCourse','allFolders'));
    }

    
    // Create a new folder (either in a video course or within an existing folder)
    public function createFolder(Request $request, $videoCourseId)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id' // Optional, can be null for root-level folders
        ]);

        // Create a new folder, either under a parent folder or as a root folder
        Folder::create([
            'name' => $request->name,
            'video_course_id' => $videoCourseId,
            'parent_folder_id' => $request->parent_id // null if it's a root folder
        ]);

        return back()->with('success', 'Folder created successfully.');
    }

    // Upload files to a folder
    public function uploadFile(Request $request, $videoCourseId, $folderId = null)
    {
        // Validate the file upload
        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
        ]);
    
        // Check if folderId is null (root level), otherwise find subfolder
        if (is_null($folderId)) {
            $folderId = null; // Root level, folder ID is null
        } else {
            // Subfolder level, find the folder or fail
            $folder = Folder::findOrFail($folderId);
            $folderId = $folder->id; // Set folder ID for subfolder
        }
    
        // Store the file manually in the 'public/files' directory
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('files'); // This is the 'public/files' directory
    
        // Move the file to the public/files directory
        $file->move($destinationPath, $filename);
    
        // Determine the file type based on MIME type
        $mimeType = $file->getClientMimeType();
        $fileType = $this->determineFileType($mimeType);
    
        // Create a new file record in the database
        File::create([
            'name' => $file->getClientOriginalName(),
            'path' => 'files/' . $filename, // Save the relative path to the file in the database
            'type' => $fileType,
            'folder_id' => $folderId, // Null for root, or set for subfolders
            'video_course_id' => $videoCourseId, // Always provided
        ]);
    
        return back()->with('success', 'File uploaded successfully.');
    }
    


    // Helper function to determine file type based on MIME type
    private function determineFileType($mimeType)
    {
        if (strpos($mimeType, 'image') !== false) {
            return 'image';
        } elseif (strpos($mimeType, 'video') !== false) {
            return 'video';
        } elseif (strpos($mimeType, 'pdf') !== false) {
            return 'pdf';
        } else {
            return 'other';
        }
    }
    protected function getBreadcrumbs(Folder $folder)
    {
        $breadcrumbs = [];
        $currentFolder = $folder;

        // Traverse up to the root folder
        while ($currentFolder) {
            $breadcrumbs[] = [
                'id' => $currentFolder->id,
                'name' => $currentFolder->name,
            ];
            $currentFolder = $currentFolder->parentFolder;
        }

        return array_reverse($breadcrumbs); // Reverse to get the correct order
    }

    public function rename(Request $request, $folderId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder = Folder::findOrFail($folderId);
        $folder->update(['name' => $request->name]);

        return back()->with('success', 'Folder renamed successfully.');
    }

    // Delete Folder
    public function delete($folderId)
    {
        $folder = Folder::findOrFail($folderId);
        $folder->delete(); // This will cascade delete all subfolders and files

        return back()->with('success', 'Folder deleted successfully.');
    }

    public function searchFolders(Request $request, $videoCourseId)
    {
        $searchTerm = $request->input('query');

        // Search folders by name within the specific video course
        $folders = Folder::where('video_course_id', $videoCourseId)
            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        // Return JSON response
        return response()->json($folders);
    }
    


}

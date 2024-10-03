<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use App\Models\FolderHierarchy;
use App\Models\VideoCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $folder = Folder::create([
            'name' => $request->name,
            'video_course_id' => $videoCourseId,
            'parent_folder_id' => $request->parent_id // null if it's a root folder
        ]);

        $this->updateClosureTable($folder, $request->parent_id);

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

    protected function updateClosureTable(Folder $folder, $parentId = null)
    {
        // Use a transaction to ensure data consistency
        \DB::transaction(function () use ($folder, $parentId) {
    
            // Clear any existing descendants/ancestors for this folder
            FolderHierarchy::where('descendant_id', $folder->id)->delete();
    
            // Always create a self-relation (folder is its own ancestor with depth 0)
            FolderHierarchy::create([
                'ancestor_id' => $folder->id,
                'descendant_id' => $folder->id,
                'depth' => 0,
            ]);
    
            if ($parentId) {
                $parentFolder = Folder::findOrFail($parentId);
    
                // Insert the parent and all of its ancestors as ancestors of this folder
                foreach ($parentFolder->ancestors as $ancestor) {
                    FolderHierarchy::create([
                        'ancestor_id' => $ancestor->id,
                        'descendant_id' => $folder->id,
                        'depth' => $ancestor->pivot->depth + 1,
                    ]);
                }
    
                // Direct parent-child relationship (depth 1)
                FolderHierarchy::create([
                    'ancestor_id' => $parentFolder->id,
                    'descendant_id' => $folder->id,
                    'depth' => 1,
                ]);
            }
        });
    }
    

    public function showHierarchy($videoCourseId)
    {
        // Fetch root folders for the given video course with depth = 0 and parent_folder_id = null
        $rootFolders = Folder::whereHas('ancestors', function($query) {
                $query->where('folder_hierarchy.depth', 0);
            })
            ->where('parent_folder_id', null) // Ensure the folder has no parent in the folders table
            ->where('video_course_id', $videoCourseId) // Filter by video course
            ->get();

        return view('ins.content.folders.hierarchy', compact('rootFolders'));
    }

    
    public function loadSubfolders($folderId)
    {
        // Fetch direct subfolders of the parent (depth = 1 relative to this folder)
        $subfolders = Folder::whereHas('ancestors', function($query) use ($folderId) {
            $query->where('ancestor_id', $folderId)
                  ->where('depth', 1);
        })->get();
    
        // Return the subfolders as JSON response for the AJAX call
        return response()->json($subfolders);
    }
    



}

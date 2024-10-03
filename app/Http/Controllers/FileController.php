<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function index(){

    }
    public function renameFile(Request $request, $fileId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Assuming you have a File model
        $file = File::findOrFail($fileId);
        // You might want to include logic here to ensure the new name doesn't conflict with existing files
        $file->update(['name' => $request->name]);

        return back()->with('success', 'File renamed successfully.');
    }

    public function deleteFile($fileId)
    {
        $file = File::findOrFail($fileId);
        $file->delete(); // This will remove the file from the storage

        return back()->with('success', 'File deleted successfully.');
    }


}
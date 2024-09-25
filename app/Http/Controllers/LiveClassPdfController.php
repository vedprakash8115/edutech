<?php

namespace App\Http\Controllers;

use App\Models\LiveClassPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LiveClassPdfController extends Controller
{
    public function index($id)
    {
        $pdfs = LiveClassPdf::where('live_class_id', $id)->get();
        return view('ins.content.live-class-pdfs', compact('pdfs'));
        
    }

    public function upload(Request $request , $id)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240', // Max 10MB
            'title' => 'required|string|max:255',
        ]);

        $pdfs = LiveClassPdf::where('live_class_id', $id)->get();
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $path = $file->store('live-class-pdfs', 'public');

            LiveClassPdf::create([
                
                'pdf_path' => $path,
            ]);

            return redirect()->route('live-class-pdfs.index')->with('success', 'PDF uploaded successfully.');
        }

        return back()->with('error', 'Failed to upload PDF.');
    }

    public function delete($id)
    {
        $pdf = LiveClassPdf::findOrFail($id);
        Storage::disk('public')->delete($pdf->file_path);
        $pdf->delete();

        return redirect()->route('live-class-pdfs.index')->with('success', 'PDF deleted successfully.');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('pdf_ids', []);
        $pdfs = LiveClassPdf::whereIn('id', $ids)->get();

        foreach ($pdfs as $pdf) {
            Storage::disk('public')->delete($pdf->file_path);
            $pdf->delete();
        }

        return redirect()->route('live-class-pdfs.index')->with('success', 'Selected PDFs deleted successfully.');
    }
}
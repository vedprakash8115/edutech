<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('admin.themes.index', compact('themes'));
    }

    // Activate a theme
    public function activate($id)
    {
        // Deactivate all themes
        Theme::query()->update(['is_active' => false]);

        // Activate the selected theme
        $theme = Theme::findOrFail($id);
        $theme->is_active = true;
        $theme->save();

        return redirect()->back()->with('success', 'Theme activated successfully.');
    }

    // Preview a theme
    public function preview($id)
    {
        $theme = Theme::findOrFail($id);
        return view('admin.themes.preview', compact('theme'));
    }

    // Store new theme
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'preview_image' => 'nullable|image',
            'path' => 'required|string'
        ]);

        // Handle preview image upload
        $imagePath = null;
        if ($request->hasFile('preview_image')) {
            $imagePath = $request->file('preview_image')->store('theme_previews', 'public');
        }

        Theme::create([
            'name' => $request->name,
            'preview_image' => $imagePath,
            'path' => $request->path,
        ]);

        return redirect()->back()->with('success', 'Theme added successfully.');
    }
}

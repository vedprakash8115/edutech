<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Slider;
use App\Models\VideoCourse;
use App\Models\liveClass;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return response()->json($themes);
    }
    public function render()
    {
        return view("admin.themes.index");
    }

    public function preview($id)
    {
        $theme = Theme::findOrFail($id);
        $slider = Slider::all();
        // Generate preview HTML based on the theme
        $previewHtml = view($theme->path, compact('slider'), ['theme' => $theme])->render();
        return response($previewHtml);
    }

   public function apply(Request $request)
{
    $request->validate([
        'theme_id' => 'required|exists:themes,id',
    ]);

    // Set the status of all themes to 0 (inactive)
    Theme::where('is_active', 1)->update(['is_active' => 0]);

    // Set the selected theme's status to 1 (active)
    $selectedTheme = Theme::find($request->theme_id);
    $selectedTheme->is_active = 1;
    $selectedTheme->save();

    // return response()->json(['success' => 'Theme Applied']);
    return redirect()->back()->with('success', 'Theme applied successfully successfully!');
}

}
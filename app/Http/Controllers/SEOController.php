<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SEO;
use Illuminate\Support\Facades\Validator;
class SEOController extends Controller
{
    public function index()
    {
        $seo = SEO::all();
        return view('admin.seo.index', compact('seo'));
    }

    public function create()
    {
        return view('admin.seo.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_slug' => 'required|max:255',
            'title' => 'required|max:60',
            'meta_description' => 'required|max:160',
            'meta_keywords' => 'nullable|max:255',
            'viewport' => 'nullable|max:255',
            'robots' => 'nullable|max:255',
            'author' => 'nullable|max:255',
            'copyright' => 'nullable|max:255',
            'og_title' => 'nullable|max:60',
            'og_type' => 'nullable|max:255',
            'og_url' => 'nullable|url|max:255',
            'og_image' => 'nullable|url|max:255',
            'og_description' => 'nullable|max:160',
            'og_site_name' => 'nullable|max:255',
            'og_locale' => 'nullable|max:255',
            'og_audio' => 'nullable|url|max:255',
            'og_video' => 'nullable|url|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'robots_txt' => 'nullable',
            'schema_markup' => 'nullable',
            'sitemap_url' => 'nullable|url|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('error', 'Validation failed. Please check your input.');
        }
    
        $seoSetting = SEO::where('page_slug', $request->input('page_slug'))->first();
    
        if ($seoSetting) {
            // If a SEO setting with the same page slug exists, update it
            $seoSetting->fill($request->all());
            $seoSetting->save();
    
            return redirect()->route('seo.index')
                             ->with('success', 'SEO setting updated successfully.');
        } else {
            // If no SEO setting with the same page slug exists, create a new one
            try {
                $seoSetting = new SEO();
                $seoSetting->fill($request->all());
                $seoSetting->save();
    
                return redirect()->route('seo.index')
                                 ->with('success', 'SEO setting saved successfully.');
            } catch (\Exception $e) {
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'An error occurred while saving SEO setting. Please try again.');
            }
        }
    }

    public function edit($id)
    {
        $seo = SEO::findOrFail($id);
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'page_slug' => 'required|max:255',
            'title' => 'required|max:60',
            'meta_description' => 'required|max:160',
            'meta_keywords' => 'nullable|max:255',
            'viewport' => 'nullable|max:255',
            'robots' => 'nullable|max:255',
            'author' => 'nullable|max:255',
            'copyright' => 'nullable|max:255',
            'og_title' => 'nullable|max:60',
            'og_type' => 'nullable|max:255',
            'og_url' => 'nullable|url|max:255',
            'og_image' => 'nullable|url|max:255',
            'og_description' => 'nullable|max:160',
            'og_site_name' => 'nullable|max:255',
            'og_locale' => 'nullable|max:255',
            'og_audio' => 'nullable|url|max:255',
            'og_video' => 'nullable|url|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'robots_txt' => 'nullable',
            'schema_markup' => 'nullable',
            'sitemap_url' => 'nullable|url|max:255',
        ]);

        $seo = SEO::findOrFail($id);
        $seo->update($request->all());

        return redirect()->route('seo.index')->with('success', 'SEO data updated successfully.');
    }

    public function destroy($id)
    {
        $seo = SEO::findOrFail($id);
        $seo->delete();

        return redirect()->route('seo.index')->with('success', 'SEO data deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SEO;

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
        $request->validate([
            'page_slug' => 'required',
            'meta_title' => 'required|max:60',
            'meta_description' => 'required|max:160',
        ]);

        SEO::create($request->all());
        return redirect()->route('seo.index')->with('success', 'SEO Data created successfully');
    }

    public function edit(SEO $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, SEO $seo)
    {
        $request->validate([
            'meta_title' => 'required|max:60',
            'meta_description' => 'required|max:160',
        ]);

        $seo->update($request->all());
        return redirect()->route('seo.index')->with('success', 'SEO Data updated successfully');
    }
}

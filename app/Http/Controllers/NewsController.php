<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Storage;

class NewsController extends Controller
{
    public function index(NewsDataTable $dataTable)
    {
        // Load the view with the DataTable for listing, as well as forms for adding and editing.
        return $dataTable->render('ins.content.news', [
            // No news to edit initially
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Store the new image in the public directory
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('news_images'), $imageName); // Move to public/news_images directory

            // Save the new image path
            $validatedData['image'] = 'news_images/' . $imageName; // Save the relative path
        }

        News::create($validatedData);

        return redirect()->route('news.index')->with('success', 'New news item added successfully');
    }

    public function update(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($news->image) {
                // Delete the old image from the public directory
                $oldImagePath = public_path($news->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file
                }
            }

            // Store the new image in the public directory
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('news_images'), $imageName); // Move to public/news_images directory

            // Save the new image path
            $validatedData['image'] = 'news_images/' . $imageName; // Save the relative path
        }

        $news->update($validatedData);

        return redirect()->route('news.index')->with('success', 'News item updated successfully');
    }
    public function edit(News $news, NewsDataTable $dataTable)
    {
        // Pass the existing news data and the DataTable to the form view
        return $dataTable->render('ins.content.news', [
            'news' => $news,  // Pass the existing news data for editing
            'editNews' => $news, // Pass the same data to the edit view
        ]);
    }
    public function destroy($id)
    {
        // Find the news item by ID
        $news = News::findOrFail($id);

        // Delete the news item
        $news->delete();

        // Redirect back with a success message
        return redirect()->route('news.index')->with('success', 'News item deleted successfully');
    }


}

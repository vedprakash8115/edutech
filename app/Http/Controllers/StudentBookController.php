<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VideoCourse;
use Illuminate\Http\Request;
use App\Models\CourseCategory0;
// use App\Models\VideoCourse;
use App\Models\Book;
 use App\Http\Controllers\ModelNotFoundException;
 class StudentBookController extends Controller 
 {
    public function index(Request $request)
    {
        $query = Book::query();
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('course_name', 'like', "%{$search}%");
        }
    
        if ($request->input('category') && $request->input('category') !== 'all') {
            $query->where('course_name', $request->input('category'));
        }
    
        $books = $query->get();
         $courses = VideoCourse::all();
         
         return view('user-account.content.books', compact('courses', 'books'));
     }
 
     public function show($id)
{
    // Find all books that belong to the specified video course
    $books = Book::with('videoCourse')
                 ->where('videocourse_id', $id)
                 ->get();

    // Return a JSON response with the books details if it's an AJAX request
    if (request()->ajax()) {
        return response()->json([
            'books' => $books->map(function($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author' => $book->author,
                    'cover_image' => asset($book->cover_image),
                    'course_name' => $book->videoCourse->course_name ?? 'Uncategorized',
                    'is_paid' => $book->is_paid,
                    'price' => $book->price,
                    'discount_price' => $book->discount_price,
                    'description' => $book->description,
                ];
            })
        ]);
    }

    // Fallback: for non-AJAX requests, return a view (if needed)
    return view('user-account.content.book-details', compact('books'));
}
     
 }
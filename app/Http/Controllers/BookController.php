<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\VideoCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\DataTables\BookDataTable;
class BookController extends Controller
{ public function index(BookDataTable $dataTable , Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $videoCourses = VideoCourse::all();
        return $dataTable->render('ins.content.Books', compact('videoCourses'));
    }

    public function create()
    {
        $videoCourses = VideoCourse::all(); // Assuming you have a VideoCourse model
        return view('books.create', compact('videoCourses'));
    }



    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'author' => 'required|max:255',
               'isbn' => 'nullable|max:255|unique:books,isbn',

                'publication_year' => 'required|integer',
                'description' => 'nullable',
                'videocourse_id' => 'required|exists:video_courses,id',
                'is_paid' => 'nullable|boolean',
                'price' => 'nullable|required_if:is_paid,1|nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
                'cover_image' => 'nullable|image|max:2048', // 2MB Max
                'book_file' => 'nullable|mimes:pdf,epub,mobi|max:10240', // 10MB Max
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            $data = $request->all();
    
            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                $coverImage = $request->file('cover_image');
                $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
                $coverImage->move(public_path('images/cover_images'), $coverImageName);
                $data['cover_image'] = 'images/cover_images/' . $coverImageName;
            }
    
            // Handle book file upload
            if ($request->hasFile('book_file')) {
                $bookFile = $request->file('book_file');
                $bookFileName = time() . '_' . $bookFile->getClientOriginalName();
                $bookFile->move(public_path('files/book_files'), $bookFileName);
                $data['book_file'] = 'files/book_files/' . $bookFileName;
            }
    
            // Create the book record in the database
            $book = Book::create($data);
    
            return response()->json(['message' => 'Book created successfully', 'book' => $book], 201);
    
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error occurred while creating book: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);
    
            // Return a JSON error response
            return response()->json(['error' => 'Something went wrong while creating the book.'], 500);
        }
    }
    

    public function edit(Book $book, BookDataTable $dataTable)
    {
        $videoCourses = VideoCourse::all();
        return $dataTable->render('ins.content.Books', compact('book', 'videoCourses'));
    }

    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'nullable|max:255',
            'publication_year' => 'required|integer',
           
            'description' => 'nullable',
            'videocourse_id' => 'required|exists:video_courses,id',
            'is_paid' => 'nullable|boolean',
            'price' => 'required_if:is_paid,1|nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'cover_image' => 'nullable|image|max:2048', // 2MB Max
            'book_file' => 'nullable|mimes:pdf,epub,mobi|max:10240', // 10MB Max
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                File::delete(public_path($book->cover_image));
            }
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(public_path('images/cover_images'), $coverImageName);
            $data['cover_image'] = 'images/cover_images/' . $coverImageName;
        }

        if ($request->hasFile('book_file')) {
            if ($book->book_file) {
                File::delete(public_path($book->book_file));
            }
            $bookFile = $request->file('book_file');
            $bookFileName = time() . '_' . $bookFile->getClientOriginalName();
            $bookFile->move(public_path('files/book_files'), $bookFileName);
            $data['book_file'] = 'files/book_files/' . $bookFileName;
        }

        $book->update($data);

        return response()->json(['message' => 'Book updated successfully', 'book' => $book]);
    }

    public function destroy(Book $book)
    {
        // if ($book->cover_image) {
        //     File::delete(public_path($book->cover_image));
        // }
        // if ($book->book_file) {
        //     File::delete(public_path($book->book_file));
        // }
        $book->delete();
        return redirect()->back()->with('message', 'Book deleted successfully');

    }
}
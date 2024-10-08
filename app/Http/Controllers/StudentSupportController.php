<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\Query;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class StudentSupportController extends Controller
{
    // Display the list of support tickets for the logged-in student
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->orderBy('status')->get();
        return view('student.support.index', compact('tickets'));
    }

    // Show the form to create a new support ticket
    public function create()
    {
        $categories = TicketCategory::all();
        return view('student.support.create', compact('categories'));
    }

    // Store a newly created ticket
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'subject' => 'required|max:255',
            'category_id' => 'required',
            'priority' => 'required|in:low,medium,high',
            'description' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Adjust mime types and size if needed
        ]);
    
        // Create the ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subject' => $request->subject,
            'priority' => $request->priority,
            'description' => $request->description,
            'status' => 'open',
        ]);
    
        // Check if a file was uploaded
       
    
        // Redirect back to the index with success message
        return redirect()->route('student.support.index')->with('success', 'Ticket created successfully!');
    }
    

    // Show details of a specific support ticket
    public function show(Ticket $ticket)
    {
        $ticket->load('messages.sender', 'messages.attachments');

        if ($ticket->user_id != Auth::id()) {
            abort(403); // Prevent unauthorized access
        }
        return view('student.support.show', compact('ticket'));
    }
    public function reopenTicket(Request $request, $id)
    {
        // Find the ticket
        $ticket = Ticket::findOrFail($id);
    
        // Update the ticket status to 'reopened'
        $ticket->update(['status'=> 'open']);
    
        // Create a message with "Unsatisfied" from the current user
        $ticket->messages()->create([
            'message' => 'Unsatisfied',
            'sender_id' => auth()->user()->id, // Assuming the user is logged in
        ]);
    
        // return response()->json(['message' => '']);
        return redirect()->back()->with('success', 'Ticket has been reopened');

    }
    public function getMessages(Ticket $ticket)
    {
        $messages = $ticket->messages()->with('messages.sender')->get()->map(function ($message) {
            return [
                'sender_name' => $message->sender->name,
                'created_at' => $message->created_at->format('d-m-Y H:i'),
                'message' => $message->message,
            ];
        });
        return response()->json(['messages' => $messages]);
    }
    


    // Reply to a specific support ticket
    public function reply(Request $request, Ticket $ticket)
    {
        // Validate the message and file inputs with specific file types allowed
        $request->validate([
            'message' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Restrict to images (jpg, png) and pdf, 2MB max
        ]);
    
        // Prevent unauthorized access
        if ($ticket->user_id != Auth::id()) {
            abort(403);
        }
    
        // Create a new query associated with the ticket
        $query = Query::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);
    
        // Update ticket status to 'in_progress'
        $ticket->status = 'in_progress';
        $ticket->save();
    
        // Check if a file is uploaded
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');
    
            // Generate a unique file name with the current date
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Original file name without extension
            $extension = $file->getClientOriginalExtension(); // Get the file extension
            $currentDate = Carbon::now()->format('Ymd'); // Get current date in Ymd format
    
            // Create a new file name with the date appended
            $newFileName = $filename . '_' . $currentDate . '.' . $extension;
    
            // Move the file to the public/attachments directory
            $file->move(public_path('attachments'), $newFileName);
    
            // Save the file path to the attachments table
            Attachment::create([
                'query_id' => $query->id, // Associate with the created query
                'file_path' => 'attachments/' . $newFileName,
            ]);
    
            // Debug to check if the query object is created successfully
            dd($query);
        }
    
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
    

    
}


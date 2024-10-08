<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\Message;
use Illuminate\Http\Request;
use Auth;

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
        $request->validate([
            'subject' => 'required|max:255',
            'category_id' => 'required',
            'priority' => 'required|in:low,medium,high',
            'description' => 'required',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subject' => $request->subject,
            'priority' => $request->priority,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return redirect()->route('student.support.index')->with('success', 'Ticket created successfully!');

    }

    // Show details of a specific support ticket
    public function show(Ticket $ticket)
    {
        $ticket->load('messages.sender');
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
        $request->validate([
            'message' => 'required',
        ]);

        if ($ticket->user_id != Auth::id()) {
            abort(403); // Prevent unauthorized access
        }

        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        $ticket->status = 'in_progress'; // Update ticket status to 'in_progress'
        $ticket->save();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}


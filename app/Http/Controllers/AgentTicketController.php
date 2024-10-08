<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentTicketController extends Controller
{
    // Show all tickets assigned to the logged-in agent
    public function index()
    {
        $agentId = Auth::id();

        // Get tickets assigned to the current agent
        $tickets = Ticket::where('assigned_to', $agentId)
            ->orderBy('status', 'asc')
            ->get();

        return view('agent.tickets.index', compact('tickets'));
    }

    // Show the details of a specific ticket
    public function show(Ticket $ticket)
    {
        // Ensure that the logged-in agent is assigned to the ticket
        if ($ticket->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        $ticket->load('messages.sender');

        return view('agent.tickets.show', compact('ticket'));
    }

    // Resolve a ticket
    public function resolve(Request $request, Ticket $ticket)
    {
        // Ensure that the logged-in agent is assigned to the ticket
        if ($ticket->assigned_to !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        // Validate the resolution message
        $request->validate([
            'resolution_message' => 'required|string|min:10',
        ]);
    
        // Check which button was clicked using the 'action' input
        if ($request->input('action') === 'send_reply') {
            // Handle "Send Reply" action
            Message::create([
                'ticket_id' => $ticket->id,
                'message' => $request->resolution_message,
                'sender_id' => $ticket->assigned_to,
            ]);
    
            return redirect()->back()->with('success', 'Reply sent successfully!');
        } elseif ($request->input('action') === 'mark_resolved') {
            // Handle "Mark as Resolved" action
            $ticket->update([
                'status' => 'resolved',
            ]);
    
            // Create the message (as part of resolution)
            Message::create([
                'ticket_id' => $ticket->id,
                'message' => $request->resolution_message,
                'sender_id' => $ticket->assigned_to,
            ]);
    
            return redirect()->route('agent.tickets')->with('success', 'Ticket marked as resolved successfully!');
        }
    
        // Fallback for invalid action
        return redirect()->back()->with('error', 'Invalid action.');
    }
    
}

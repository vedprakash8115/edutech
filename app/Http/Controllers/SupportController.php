<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    // Display the list of tickets in the admin dashboard
    public function index()
    {
        $tickets = Ticket::with('user', 'assignedAgent', 'category')->orderBy('status')->get();
        return view('admin.support.index', compact('tickets'));
    }

    // Display details of a specific ticket
    public function show(Ticket $ticket)
    {
        $ticket->load('messages.sender', 'attachments', 'user', 'assignedAgent');
        $agents = User::query()->role('agent')->get();// List of support agents
        return view('admin.support.show', compact('ticket', 'agents'));
    }

    // Assign a ticket to a support agent
    public function assignAgent(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket->assigned_to = $request->assigned_to;
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket assigned successfully.');
    }

    // Update the ticket's status (e.g., open, in_progress, resolved, closed)
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }
}

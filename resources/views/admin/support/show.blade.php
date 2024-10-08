@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</h1>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Ticket Information</h5>
                <p><strong>Category:</strong> {{ $ticket->category->name }}</p>
                <p><strong>Student:</strong> {{ $ticket->user->name }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                <p><strong>Description:</strong> {{ $ticket->description }}</p>
            </div>
        </div>

        <!-- Messages Section -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Messages</h5>
                @foreach($ticket->messages as $message)
                    <div class="message">
                        <p><strong>{{ $message->sender->name }}:</strong> {{ $message->message }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Assign Agent Form -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Assign to Agent</h5>
                <form action="{{ route('admin.support.assign', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="assigned_to">Assign to</label>
                        <select name="assigned_to" class="form-control">
                            <option value="">Select Agent</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $ticket->assigned_to == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Assign</button>
                </form>
            </div>
        </div>

        <!-- Update Status Form -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Update Status</h5>
                <form action="{{ route('admin.support.status', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                </form>
            </div>
        </div>

    </div>
@endsection

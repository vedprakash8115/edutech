@extends('layout.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 fw-light text-primary">Ticket <span class="fw-bold"> - {{ $ticket->id }}</span></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('agent.tickets') }}" class="text-decoration-none">All Tickets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ticket #{{ $ticket->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 fw-light">
                        <span class="text-primary fw-normal">Subject:</span> 
                        {{ $ticket->subject }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-uppercase text-muted small">Submitted By</h6>
                            <p class="lead fw-light">{{ $ticket->user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-uppercase text-muted small">Status</h6>
                            <p>
                                <span class="badge status-badge px-3 py-2 {{ $ticket->status == 'open' ? 'status-open' : ($ticket->status == 'in progress' ? 'status-progress' : 'status-resolved') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted small">Description</h6>
                        <p class="text-dark">{{ $ticket->description }}</p>
                    </div>
                    <div class="text-muted">
                        <small><i class="far fa-clock me-1"></i> Created: {{ $ticket->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 fw-light text-primary">Conversation</h5>
                </div>
                <div class="card-body conversation-section">
                    @foreach($ticket->messages as $message)
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="avatar rounded-circle d-flex align-items-center justify-content-center">
                                    {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-medium">{{ $message->sender->name }}</h6>
                                    <small class="text-muted fw-light">{{ $message->created_at->format('d M Y, H:i') }}</small>
                                </div>
                                <p class="mb-0 message-text">{{ $message->message }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if($ticket->status != 'resolved')
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0 fw-light text-primary">Resolve Ticket</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('agent.tickets.resolve', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="resolution_message" class="form-label text-muted small text-uppercase">Resolution Message</label>
                                <textarea name="resolution_message" id="resolution_message" class="form-control" rows="5" required></textarea>
                                @error('resolution_message')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- "Send Reply" button -->
                            <button type="submit" name="action" value="send_reply" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-reply me-2"></i>Send Reply
                            </button>
                        
                            <!-- "Mark as Resolved" button -->
                            <button type="submit" name="action" value="mark_resolved" class="btn btn-success w-100">
                                <i class="fas fa-check-circle me-2"></i>Mark as Resolved
                            </button>
                        </form>
                        
                    </div>
                </div>
            @else
                <div class="card shadow-sm mb-4 border-0 bg-light">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-light"><i class="fas fa-check-circle me-2"></i>Resolved</h5>
                        <p class="resolution-message">{{ $ticket->resolution_message }}</p>
                    </div>
                </div>
            @endif

            <div class="d-grid gap-2">
                <a href="{{ route('agent.tickets') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to All Tickets
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
        color: #1a365d;
    }
    
    .card {
        border-radius: 0.75rem;
        transition: all 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .card-header {
        border-bottom: none;
        padding: 1.5rem;
    }
    
    .avatar {
        width: 2.75rem;
        height: 2.75rem;
        background-color: #e2e8f0;
        color: #1a365d;
        font-weight: 500;
    }
    
    .status-badge {
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-open {
        background-color: #fed7d7;
        color: #9b2c2c;
    }
    
    .status-progress {
        background-color: #feebc8;
        color: #9c4221;
    }
    
    .status-resolved {
        background-color: #c6f6d5;
        color: #276749;
    }
    
    .conversation-section {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .message-text {
        line-height: 1.6;
    }
    
    .resolution-message {
        font-style: italic;
        color: #4a5568;
    }
    
    .btn-primary {
        background-color: #2b6cb0;
        border-color: #2b6cb0;
    }
    
    .btn-outline-primary {
        color: #2b6cb0;
        border-color: #2b6cb0;
    }
    
    .text-primary {
        color: #2b6cb0 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush
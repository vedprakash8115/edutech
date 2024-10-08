@extends('layout.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa !important;
    }
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .table th {
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    .table td {
        vertical-align: middle;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    .btn-outline-primary {
        border-width: 2px;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-3xl font-light text-primary">
        <i class="fas fa-ticket me-2 text-primary"></i>Assigned Tickets
    </h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Subject</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td class="px-4 py-3">#{{ $ticket->id }}</td>
                            <td class="px-4 py-3 fw-medium">{{ $ticket->subject }}</td>
                            <td class="px-4 py-3">
                                <span class="badge bg-{{ $ticket->status === 'open' ? 'success' : 'secondary' }} text-white">
                                    <i class="fas fa-{{ $ticket->status === 'open' ? 'dot-circle' : 'check-circle' }} me-1"></i>
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <i class="far fa-calendar-alt me-1 text-muted"></i>
                                {{ $ticket->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('agent.tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-3"></i>
                                <p>No tickets assigned to you.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
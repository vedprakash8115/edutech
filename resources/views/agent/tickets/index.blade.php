@extends('layout.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
    .dataTables_wrapper .dataTables_length, 
    .dataTables_wrapper .dataTables_filter, 
    .dataTables_wrapper .dataTables_info, 
    .dataTables_wrapper .dataTables_processing, 
    .dataTables_wrapper .dataTables_paginate {
        color: #4a5568;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em;
        margin-left: 2px;
        border: 1px solid #e2e8f0;
        border-radius: 0.25rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #007bff;
        color: white !important;
        border-color: #007bff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e2e8f0;
        color: #2d3748 !important;
    }
    .custom-buttons {
        margin-bottom: 1rem;
    }
    .custom-buttons .btn {
        margin-right: 0.5rem;
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
        <div class="card-body">
            <div class="custom-buttons">
                <button id="refreshBtn" class="btn btn-outline-secondary">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item filter-option" data-filter="all" href="#">All</a></li>
                        <li><a class="dropdown-item filter-option" data-filter="open" href="#">Open</a></li>
                        <li><a class="dropdown-item filter-option" data-filter="closed" href="#">Closed</a></li>
                    </ul>
                </div>
            </div>
            <table id="ticketsTable" class="table table-hover mb-0">
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#ticketsTable').DataTable({
        "order": [[0, "desc"]],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "search": "",
            "searchPlaceholder": "Search tickets..."
        }
    });

    // Refresh button
    $('#refreshBtn').on('click', function() {
        table.ajax.reload();
    });

    // Filter dropdown
    $('.filter-option').on('click', function(e) {
        e.preventDefault();
        var filter = $(this).data('filter');
        if (filter === 'all') {
            table.column(2).search('').draw();
        } else {
            table.column(2).search(filter).draw();
        }
    });
});
</script>
@endsection
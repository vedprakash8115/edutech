@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-light text-primary">Support Tickets</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button id="refreshBtn" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item filter-option" data-filter="all" href="#">All</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="open" href="#">Open</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="in progress" href="#">In Progress</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="resolved" href="#">Resolved</a></li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="ticketSearch" placeholder="Search tickets...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0" id="ticketsTable">
                    <thead>
                        <tr class="bg-light">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Subject</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Student</th>
                            <th class="py-3 px-4">Assigned Agent</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Priority</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr class="ticket-row">
                            <td class="py-3 px-4">#{{ $ticket->id }}</td>
                            <td class="py-3 px-4 text-primary">{{ $ticket->subject }}</td>
                            <td class="py-3 px-4">
                                <span class="badge rounded-pill category-badge text-dark">{{ $ticket->category->name }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">{{ strtoupper(substr($ticket->user->name, 0, 1)) }}</div>
                                    <span class="text-dark">{{ $ticket->user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if($ticket->assignedAgent)
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2 bg-light text-dark">
                                            {{ strtoupper(substr($ticket->assignedAgent->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $ticket->assignedAgent->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">Unassigned</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge status-badge {{ $ticket->status == 'open' ? 'status-open' : ($ticket->status == 'in progress' ? 'status-progress text-danger' : 'status-resolved text-success') }} ">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge priority-badge priority-{{ strtolower($ticket->priority) }} text-dark">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.support.show', $ticket->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" 
                                            data-ticket-id="{{ $ticket->id }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this ticket? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
/* ... (keep all the existing styles) ... */

/* Additional styles for DataTables */
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
    background: #3182ce;
    color: white !important;
    border-color: #3182ce;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #edf2f7;
    color: #2d3748 !important;
}

.dataTables_wrapper .dataTables_length select {
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    padding: 0.25rem 2rem 0.25rem 0.5rem;
}

.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    padding: 0.25rem 0.5rem;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable
    const table = $('#ticketsTable').DataTable({
        "order": [[0, "desc"]],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "search": "",
            "searchPlaceholder": "Search tickets..."
        },
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "drawCallback": function(settings) {
            // Re-initialize delete buttons after draw
            initDeleteButtons();
        }
    });

    // Custom search box
    $('#ticketSearch').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Refresh button
    $('#refreshBtn').on('click', function() {
        table.ajax.reload();
    });

    // Filter dropdown
    $('.filter-option').on('click', function(e) {
        e.preventDefault();
        const filter = $(this).data('filter');
        if (filter === 'all') {
            table.column(5).search('').draw();
        } else {
            table.column(5).search(filter).draw();
        }
    });

    // Delete modal functionality
    function initDeleteButtons() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const ticketId = this.getAttribute('data-ticket-id');
                const actionUrl = `{{ route('admin.support.delete', '') }}/${ticketId}`;
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    }

    // Initial call to set up delete buttons
    initDeleteButtons();
});
</script>
@endpush
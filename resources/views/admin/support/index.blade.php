
@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-light text-primary">Support Tickets</h1>
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" class="form-control border-start-0 search-input" placeholder="Search tickets...">
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
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
                                <span class="badge rounded-pill category-badge">{{ $ticket->category->name }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-2">{{ strtoupper(substr($ticket->user->name, 0, 1)) }}</div>
                                    <span>{{ $ticket->user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if($ticket->assignedAgent)
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2 bg-light">
                                            {{ strtoupper(substr($ticket->assignedAgent->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $ticket->assignedAgent->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">Unassigned</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge status-badge {{ $ticket->status == 'open' ? 'status-open' : ($ticket->status == 'in progress' ? 'status-progress' : 'status-resolved') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge priority-badge priority-{{ strtolower($ticket->priority) }}">
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
                <div id="noResults" class="text-center py-4 d-none">
                    <div class="text-muted">
                        <i class="fas fa-search fa-3x mb-3"></i>
                        <h5>No tickets found</h5>
                        <p>Try adjusting your search terms</p>
                    </div>
                </div>
                <div id="loadingIndicator" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
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
<style>

.card {
    border-radius: 0.75rem;
}

.search-input {
    border-color: #e2e8f0;
}

.search-input:focus {
    box-shadow: none;
    border-color: #2b6cb0;
}

.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #e2e8f0;
    color: #1a365d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 500;
}

.status-badge, .priority-badge {
    font-weight: 500;
    padding: 0.5rem 0.75rem;
}

.status-open { background-color: #fed7d7; color: #9b2c2c; }
.status-progress { background-color: #feebc8; color: #9c4221; }
.status-resolved { background-color: #c6f6d5; color: #276749; }

.priority-high { background-color: #fed7d7; color: #9b2c2c; }
.priority-medium { background-color: #feebc8; color: #9c4221; }
.priority-low { background-color: #e2e8f0; color: #2d3748; }

.category-badge {
    background-color: #ebf4ff;
    color: #2b6cb0;
    font-weight: 500;
}

.ticket-row {
    transition: all 0.2s ease-in-out;
}

.ticket-row:hover {
    background-color: #f8f9fa;
}

.action-buttons .btn {
    font-weight: 500;
}

/* Ensure dropdown menus are always on top */
.modal {
    z-index: 1060;
}

@media (max-width: 768px) {
    .table-responsive {
        border: 0;
    }

    .table-responsive table {
        display: block;
    }

    .table-responsive thead {
        display: none;
    }

    .table-responsive tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
    }

    .table-responsive td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
        padding: 0.75rem 1rem;
    }

    .table-responsive td::before {
        content: attr(data-label);
        font-weight: 500;
        margin-right: 1rem;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
}
    #noResults {
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #loadingIndicator {
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.3s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    const ticketsTableBody = document.querySelector('#ticketsTable tbody');
    const noResultsDiv = document.getElementById('noResults');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const originalTickets = ticketsTableBody.innerHTML;
    let searchTimeout;

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.trim().toLowerCase();
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        if (searchTerm === '') {
            // Restore original tickets immediately
            ticketsTableBody.innerHTML = originalTickets;
            ticketsTableBody.classList.remove('d-none');
            noResultsDiv.classList.add('d-none');
            return;
        }

        // Set new timeout for search
        searchTimeout = setTimeout(() => {
            // Show loading indicator
            ticketsTableBody.classList.add('d-none');
            noResultsDiv.classList.add('d-none');
            loadingIndicator.classList.remove('d-none');

            // Perform an AJAX request
            fetch(`/admin/support/tickets/search?searchTerm=${encodeURIComponent(searchTerm)}`)
                .then(response => response.json())
                .then(data => {
                    loadingIndicator.classList.add('d-none');
                    
                    if (data.length === 0) {
                        ticketsTableBody.classList.add('d-none');
                        noResultsDiv.classList.remove('d-none');
                    } else {
                        ticketsTableBody.classList.remove('d-none');
                        noResultsDiv.classList.add('d-none');
                        
                        // Update table with search results
                        ticketsTableBody.innerHTML = data.map(ticket => `
                            <tr class="ticket-row">
                                <td class="py-3 px-4">#${ticket.id}</td>
                                <td class="py-3 px-4 text-primary">${ticket.subject}</td>
                                <td class="py-3 px-4">
                                    <span class="badge rounded-pill category-badge">${ticket.category.name}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">${ticket.user.name.charAt(0).toUpperCase()}</div>
                                        <span>${ticket.user.name}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    ${ticket.assigned_agent ? `
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2 bg-light">
                                                ${ticket.assigned_agent.name.charAt(0).toUpperCase()}
                                            </div>
                                            <span>${ticket.assigned_agent.name}</span>
                                        </div>
                                    ` : '<span class="text-muted">Unassigned</span>'}
                                </td>
                                <td class="py-3 px-4">
                                    <span class="badge status-badge ${
                                        ticket.status === 'open' ? 'status-open' : 
                                        (ticket.status === 'in progress' ? 'status-progress' : 'status-resolved')
                                    }">
                                        ${ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="badge priority-badge priority-${ticket.priority.toLowerCase()}">
                                        ${ticket.priority.charAt(0).toUpperCase() + ticket.priority.slice(1)}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="action-buttons">
                                        <a href="/admin/support/tickets/${ticket.id}" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger delete-btn" 
                                                data-ticket-id="${ticket.id}"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `).join('');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingIndicator.classList.add('d-none');
                    // Handle error - you might want to show an error message to the user
                });
        }, 300); // 300ms delay
    });

    // Delete modal functionality
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn')) {
            const ticketId = e.target.getAttribute('data-ticket-id');
            deleteForm.action = `/admin/support/tickets/${ticketId}`;
        }
    });
});
</script>
@endpush
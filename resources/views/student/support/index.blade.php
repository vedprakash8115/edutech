@extends('user-account.layout.app')

@section('content')
<div class="card py-5" style="border-radius: 5px; margin:0;">
    <div class="card-body">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-primary fw-bold">Eductech Support</h1>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('student.support.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Create Query Ticket
            </a>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button id="refreshBtn" class="btn btn-outline-secondary me-2">
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
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="ticketSearch" placeholder="Search tickets...">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="ticketsTable" class="table table-hover bg-white shadow-sm rounded">
                    <thead class="bg-primary text-white">
                        <tr class="text-white">
                            <th class="text-white">ID</th>
                            <th class="text-white">Subject</th>
                            <th class="text-white">Category</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Priority</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $ticket->category->name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $ticket->status === 'open' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $ticket->priority === 'high' ? 'danger' : ($ticket->priority === 'medium' ? 'warning' : 'info') }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('student.support.show', $ticket->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@include('user-account.content.footer')
@include('user-account.content.fixed_button')
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    body {
        background-color: #f8f9fa;
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }
    .table thead th {
        border: none;
        color: #f8f9fa;
    }
    .table tbody tr {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .table tbody tr:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.7em;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3em 0.8em;
        margin-left: 2px;
        border: 1px solid #dee2e6;
        border-radius: 3px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #007bff;
        color: white !important;
        border-color: #007bff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e9ecef;
        color: #007bff !important;
    }
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
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
            var filter = $(this).data('filter');
            if (filter === 'all') {
                table.column(3).search('').draw();
            } else {
                table.column(3).search(filter).draw();
            }
        });
    });
</script>
@endpush
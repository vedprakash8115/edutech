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
                <i class="fas fa-plus-circle me-2"></i>Create Query chatroom
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover bg-white shadow-sm rounded">
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
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    // You can add any additional JavaScript here if needed
</script>
@endpush
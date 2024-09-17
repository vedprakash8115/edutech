@extends('layout.app')

@section('title', 'User List')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-secondary d-flex justify-content-between">
            <h3 class="card-title">User List</h3>
            <a class="btn btn-success" href="{{ route('users.create')}}">Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="users-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>City</th>
                        {{-- <th>State</th>
                        <th>Country</th>
                        <th>Pincode</th> --}}
                        <th>Status</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables will populate this area -->
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'mobile', name: 'mobile' },
                { data: 'address', name: 'address' },
                { data: 'city', name: 'city' },
                // { data: 'state', name: 'state' },
                // { data: 'country', name: 'country' },
                // { data: 'pincode', name: 'pincode' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'role', name: 'role' }, // Assuming role is a relation
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
@endsection

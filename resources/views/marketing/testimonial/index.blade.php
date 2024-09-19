@extends('layout.app')

@section('title', 'Testimonials')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-secondary d-flex justify-content-between">
                <h3 class="card-title">Testimonials List</h3>
                <a class="btn btn-success" href="{{ route('testimonials.create') }}">Add Testimonials</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="testimonials-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr.no.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Status</th>
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
            $('#testimonials-table').DataTable({

            });
        });
    </script>
    @endpush
@endsection

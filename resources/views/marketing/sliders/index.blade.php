@extends('layout.app')

@section('title', 'Sliders')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }
    </style>

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-secondary d-flex justify-content-between">
                <h3 class="card-title">Sliders List</h3>
                <a class="btn btn-success" href="{{ route('sliders.create') }}">Add Sliders</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="sliders-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr.no.</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Position</th>
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
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#sliders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('sliders.index') }}', // Set the route to fetch data
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'title', name: 'title' }, // Adjust according to your relationships
                    { data: 'image', name: 'image' },
                    { data: 'position', name: 'position' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });

        // Handle the status switch change
        $(document).on('change', '.status-switch', function() {
            let sliderID = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '/sliders/' + sliderID + '/status',
                type: 'PUT',
                data: { status: status, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: 'The Slider status has been updated successfully!',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: 'There was an error updating the status. Please try again.',
                        confirmButtonText: 'OK'
                    });

                    // Optionally revert the switch if the update failed
                    $(this).prop('checked', !status); // Revert the switch
                }
            });
        });

    </script>
    @endpush
@endsection

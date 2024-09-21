@extends('layout.app')

@section('title', 'Coupon')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-secondary d-flex justify-content-between">
                <h3 class="card-title">Coupons List</h3>
                <a class="btn btn-success" href="{{ route('coupons.create') }}">Add Coupon</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="coupons-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr.no.</th>
                            <th>User Type</th>
                            <th>Start</th>
                            <th>Expiry</th>
                            <th>Discount Type</th>
                            <th>Product</th>
                            <th>Coupon Code</th>
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
            $('#coupons-table').DataTable({

            });
        });
    </script>
    @endpush
@endsection

@extends('layout.app')
@section('title', 'Coupon')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center" style="box-shadow: 2px 4px 2px rgba(0, 0, 0, 0.19);">
                <h3 class="card-title text-white">Coupons List</h3>
                <a class="btn btn-light" href="{{ route('coupons.create') }}">Add Coupon</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="coupons-table" class="table table-hover table-bordered">
                        <thead class="thead-dark">
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
                            @foreach ($coupons as $index => $coupon)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $coupon->user_type }}</td>
                                    <td>{{ $coupon->start_date }}</td>
                                    <td>{{ $coupon->expiry_date }}</td>
                                    <td>{{ $coupon->discount_type }}</td>
                                    <td>{{ $coupon->product_type }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>
                                        <span class="badge {{ $coupon->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $coupon->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    @endpush
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#coupons-table').DataTable({
                "pageLength": 10,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
    @endpush
@endsection

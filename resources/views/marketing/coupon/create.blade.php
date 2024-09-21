@extends('layout.app')

@section('title', isset($single_data) ? 'Edit Coupon' : 'Add Coupon')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ isset($single_data) ? 'Edit Coupon' : 'Add Coupon' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($single_data->id)?route('coupons.update',$single_data->id):route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($single_data)
                        @method('put')
                    @endisset
                    <!-- Coupon Details Section -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_type">User Type</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="user_type">
                                    <option selected value="" disabled>...Please Select...</option>
                                    <option value="purchased_user">Purchased User</option>
                                    <option value="unpurchased_user">Unpurchased User</option>
                                    <option value="all_users">All Users</option>
                                    <option value="limited_user">Single / Multiple User</option>
                                    <option value="csv_data">CSV Data</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="coupon_code">Coupon Code</label>
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount_type">Discount Type</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="discount_type">
                                    <option selected value="" disabled>...Please Select...</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_type">Product</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="product_type">
                                    <option selected value="" disabled>...Please Select...</option>
                                    <option value="live_content">live Course</option>
                                    <option value="video_content">Video Course</option>
                                    <option value="mocktest_content">Mock-Test Course</option>
                                    <option value="elibrary_content">E-Library Course</option>
                                    <option value="bundle_content">Bundle Course</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount_type">Aspirants Applicant</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="inspirant_applicant">
                                    <option selected value="" disabled>...Please Select...</option>
                                    <option value="100-200">0-200</option>
                                    <option value="300-400">200-400</option>
                                    <option value="500-600">400-600</option>
                                    <option value="700-800">600-800</option>
                                    <option value="800-1000">800-1000</option>
                                    <option value="1000">Above 1k+</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary mt-3">{{ isset($single_data) ? 'Update Coupon' : 'Add Coupon' }}</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')

    <script>
        $(document).ready(function() {

        });

    </script>
    @endpush
@endsection

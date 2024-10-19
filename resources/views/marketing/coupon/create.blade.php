@extends('layout.app')
@section('title', isset($single_data) ? 'Edit Coupon' : 'Add Coupon')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($single_data) ? 'Edit Coupon' : 'Add Coupon' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($single_data->id)?route('coupons.update',$single_data->id):route('coupons.store') }}" method="POST" >
                @csrf
                @isset($single_data)
                @method('put')
                @endisset
    
                <!-- Coupon Details Section -->
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-select form-select-md mb-3" name="user_type">
                                <option value="" disabled {{ isset($single_data) ? '' : 'selected' }}>...Please Select...</option>
                                <option value="purchased_user" {{ isset($single_data) && $single_data->user_type == 'purchased_user' ? 'selected' : '' }}>Purchased User</option>
                                <option value="unpurchased_user" {{ isset($single_data) && $single_data->user_type == 'unpurchased_user' ? 'selected' : '' }}>Unpurchased User</option>
                                <option value="all_users" {{ isset($single_data) && $single_data->user_type == 'all_users' ? 'selected' : '' }}>All Users</option>
                                <option value="limited_user" {{ isset($single_data) && $single_data->user_type == 'limited_user' ? 'selected' : '' }}>Single / Multiple User</option>
                                <option value="csv_data" {{ isset($single_data) && $single_data->user_type == 'csv_data' ? 'selected' : '' }}>CSV Data</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="coupon_code">Coupon Code</label>
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ isset($single_data->coupon_code) ? $single_data->coupon_code : '' }}" required>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ isset($single_data->start_date) ? $single_data->start_date : '' }}" required>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control" value="{{ isset($single_data->expiry_date) ? $single_data->expiry_date : '' }}" required>
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_type">Discount Type</label>
                            <select class="form-select form-select-md mb-3" name="discount_type" id="discount_type">
                                <option value="" disabled {{ isset($single_data) ? '' : 'selected' }}>...Please Select...</option>
                                <option value="percentage" {{ isset($single_data) && $single_data->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ isset($single_data) && $single_data->discount_type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-4" id="fixedAmountField" style="display: {{ isset($single_data) && $single_data->discount_type == 'fixed' ? 'block' : 'none' }};">
                        <div class="form-group">
                            <label for="fixed_amount">Fixed Amount</label>
                            <input type="number" name="fixed_amount" id="fixed_amount" class="form-control" value="{{ isset($single_data->fixed_amount) ? $single_data->fixed_amount : '' }}" placeholder="Enter fixed amount">
                        </div>
                    </div>
    
                    <div class="col-md-4" id="percentageField" style="display: {{ isset($single_data) && $single_data->discount_type == 'percentage' ? 'block' : 'none' }};">
                        <div class="form-group">
                            <label for="percentage">Discount Percentage</label>
                            <input type="number" name="percentage" id="percentage" class="form-control" value="{{ isset($single_data->percentage) ? $single_data->percentage : '' }}" placeholder="Enter percentage" max="100">
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_type">Product</label>
                            <select class="form-select form-select-md mb-3" name="product_type" id="product_type">
                                <option value="" disabled {{ isset($single_data) ? '' : 'selected' }}>...Please Select...</option>
                                <option value="live_content" {{ isset($single_data) && $single_data->product_type == 'live_content' ? 'selected' : '' }}>Live Course</option>
                                <option value="video_content" {{ isset($single_data) && $single_data->product_type == 'video_content' ? 'selected' : '' }}>Video Course</option>
                                <option value="mocktest_content" {{ isset($single_data) && $single_data->product_type == 'mocktest_content' ? 'selected' : '' }}>Mock-Test Course</option>
                                <option value="elibrary_content" {{ isset($single_data) && $single_data->product_type == 'elibrary_content' ? 'selected' : '' }}>E-Library Course</option>
                                <option value="bundle_content" {{ isset($single_data) && $single_data->product_type == 'bundle_content' ? 'selected' : '' }}>Books</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" id="liveClassesDropdown" style="display:none;">
                        <div class="form-group">
                            <label for="live_class">Select <span id="target"></span></label>
                            <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="target_product_id[]" id="live_class" multiple style="height: 200px;" >
                                {{-- <option selected value="" disabled>...Please Select...</option> --}}
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inspirant_applicant">Aspirants Applicant</label>
                            <select class="form-select form-select-md mb-3" name="inspirant_applicant">
                                <option value="" disabled {{ !isset($single_data) ? 'selected' : '' }}>...Please Select...</option>
                                <option value="100-200" {{ isset($single_data) && $single_data->inspirant_applicant == '100-200' ? 'selected' : '' }}>0-200</option>
                                <option value="300-400" {{ isset($single_data) && $single_data->inspirant_applicant == '300-400' ? 'selected' : '' }}>200-400</option>
                                <option value="500-600" {{ isset($single_data) && $single_data->inspirant_applicant == '500-600' ? 'selected' : '' }}>400-600</option>
                                <option value="700-800" {{ isset($single_data) && $single_data->inspirant_applicant == '700-800' ? 'selected' : '' }}>600-800</option>
                                <option value="800-1000" {{ isset($single_data) && $single_data->inspirant_applicant == '800-1000' ? 'selected' : '' }}>800-1000</option>
                                <option value="1000" {{ isset($single_data) && $single_data->inspirant_applicant == '1000' ? 'selected' : '' }}>Above 1k+</option>
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
 document.getElementById('product_type').addEventListener('change', function() {
    const liveClassesDropdown = document.getElementById('liveClassesDropdown');
    const target = document.getElementById('target');
    const liveClassSelect = document.getElementById('live_class');
    let id;

    switch (this.value) {
        case 'live_content':
            id = 1;
            target.innerHTML = 'Live Class';
            liveClassesDropdown.style.display = 'block';
            break;
        case 'video_content':
            id = 2;
            target.innerHTML = 'Video Course';
            liveClassesDropdown.style.display = 'block';
            break;
        case 'mocktest_content':
            id = 3;
            target.innerHTML = 'Mock-Test Course';
            liveClassesDropdown.style.display = 'block';
            break;
        case 'elibrary_content':
            id = 4;
            target.innerHTML = 'E-Library Course';
            liveClassesDropdown.style.display = 'block';
            break;
        case 'bundle_content':
            id = 5;
            target.innerHTML = 'Books';
            liveClassesDropdown.style.display = 'block';
            break;
        default:
            liveClassesDropdown.style.display = 'none';
            return; // Exit the function if no valid product type is selected
    }

    // Fetch the live classes based on the selected product type
    fetch(`/live-classes/${id}`)
        .then(response => response.json())
        .then(data => {
            // Clear existing options
            liveClassSelect.innerHTML = '<option class="text-dark" selected value="" disabled>...Please Select...</option>';
            
            // Populate the select options
            data.forEach(liveClass => {
                const option = document.createElement('option');
                option.value = parseInt(liveClass.id,10);
                option.textContent = liveClass.course_name ? liveClass.course_name : liveClass.title;
                option.classList.add('text-dark');
                liveClassSelect.appendChild(option);
            });

            // Preselect options if `$single_data` is available
            const selectedClasses = @json(isset($single_data) ? $single_data->target_product_id : []);
            if (selectedClasses.length) {
                selectedClasses.forEach(selectedId => {
                    const optionToSelect = liveClassSelect.querySelector(`option[value="${selectedId}"]`);
                    if (optionToSelect) {
                        optionToSelect.selected = true;
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching live classes:', error));
});


    document.getElementById('discount_type').addEventListener('change', function() {
        const fixedAmountField = document.getElementById('fixedAmountField');
        const percentageField = document.getElementById('percentageField');

        if (this.value === 'fixed') {
            fixedAmountField.style.display = 'block';
            percentageField.style.display = 'none';
        } else if (this.value === 'percentage') {
            percentageField.style.display = 'block';
            fixedAmountField.style.display = 'none';
        } else {
            fixedAmountField.style.display = 'none';
            percentageField.style.display = 'none';
        }
    });
</script>

@endpush
@push('styles')
<style>
    .form-group label {
        font-weight: bold;
        font-size: 1.2em;
        color: #333;
    }
    .form-select {
        height: auto;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f8f8f8;
    }
    .form-select:hover {
        border-color: #80bdff;
        background-color: #fff;
    }
    .form-select option {
        padding: 10px;
        cursor: pointer;
    }
    .form-select option:hover {
        background-color: #e9ecef;
    }
    .form-group select[multiple] option::before {
        content: "\2713";
        margin-right: 10px;
        color: transparent;
    }
    .form-group select[multiple] option:checked::before {
        color: #28a745;
    }
    .form-group select[multiple] option:checked {
        background-color: #c3e6cb;
    }
</style>
@endpush
@endsection

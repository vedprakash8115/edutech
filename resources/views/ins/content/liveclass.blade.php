@extends('layout.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Live Class</h5>
                <small class="text-muted float-end">Manage Live Classes</small>
            </div>
            <div class="card-body p-4">
                <form method="POST" id="live_class_form" action="{{ isset($single_data) ? route('liveclass.update', $single_data->id) : route('liveclass.store') }}" enctype="multipart/form-data" class="needs-validation" data-aos="fade-up">
                    @csrf
                    @if(isset($single_data))
                        @method('PUT')
                    @endif
                    <div class="row g-4">
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                            <div class="form-floating">
                                <i class="fas fa-book form-icon"></i>
                                <input type="text" class="form-control" id="CourseName" placeholder="Course Name" name="course_name" value="{{ old('course_name', $single_data->course_name ?? '') }}" required>
                                <label for="CourseName" class="text-secondary">Course Name <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                            <div class="form-floating">
                                <i class="fas fa-language form-icon"></i>
                                <select class="form-select" id="Language" name="language" required>
                                    <option value="" selected disabled>Select Language</option>
                                    <option value="1" {{ (old('language', $single_data->language ?? '') == '1') ? 'selected' : '' }}>Hindi</option>
                                    <option value="2" {{ (old('language', $single_data->language ?? '') == '2') ? 'selected' : '' }}>English</option>
                                </select>
                                <label for="Language" class="text-secondary">Language <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                            <div class="form-floating">
                                <i class="fas fa-image form-icon"></i>
                                <input type="file" class="form-control" id="UploadBanner" name="banner" accept="image/*">
                                <label for="UploadBanner" class="text-secondary">Upload Banner</label>
                            </div>
                            @if(isset($single_data) && $single_data->banner)
                                <div class="mt-2">
                                    <img src="{{ asset($single_data->banner) }}" alt="Current Banner" class="img-fluid img-thumbnail" style="max-width: 200px; max-height: 60px;">
                                    <p class="text-muted small mt-1">Current banner image</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="400">
                            <div class="form-floating">
                                <i class="fas fa-percent form-icon"></i>
                                <select class="form-select" id="DiscountType" name="discount_type" required>
                                    <option value="" selected disabled>Select Discount Type</option>
                                    <option value="fixed" {{ (old('discount_type', $single_data->discount_type ?? '') == 'fixed') ? 'selected' : '' }}>Fixed</option>
                                    <option value="percentage" {{ (old('discount_type', $single_data->discount_type ?? '') == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                </select>
                                <label for="DiscountType" class="text-secondary">Discount Type <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                            <div class="form-floating">
                                <i class="fas fa-clock form-icon"></i>
                                <input type="time" class="form-control" value="{{ isset($single_data->Course_duration) ? \Carbon\Carbon::parse($single_data->Course_duration)->format('H:i') : '' }}" id="course_duration" name="course_duration" required>
                                <label for="course_duration" class="text-secondary">Course Duration <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="600">
                            <div class="form-floating">
                                <i class="fas fa-list form-icon"></i>
                                <select class="form-select" id="CategoryLevel0" name="cat_level_0" required>
                                    <option value="">Select Category Level 0</option>
                                    @foreach($categories as $option)
                                        <option value="{{ $option->id }}" {{ old('cat_level_0', $single_data->cat_level_0 ?? '') == $option->id ? 'selected' : '' }}>
                                            {{ $option->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="CategoryLevel0" class="text-secondary">Course Category <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" id="category-level-1" style="{{ isset($single_data->cat_level_0) ? 'display: block;' : 'display: none;' }}" data-aos="fade-right" data-aos-delay="700">
                            <div class="form-floating">
                                <i class="fas fa-list-ol form-icon"></i>
                                <select class="form-select" id="CategoryLevel1" name="cat_level_1">
                                    <option value="">Select Category Level 1</option>
                                </select>
                                <label for="CategoryLevel1" class="text-secondary">Category Level 1</label>
                            </div>
                        </div>
                        <div class="col-md-6" id="category-level-2" style="{{ isset($single_data->cat_level_1) ? 'display: block;' : 'display: none;' }}" data-aos="fade-left" data-aos-delay="800">
                            <div class="form-floating">
                                <i class="fas fa-list-ul form-icon"></i>
                                <select class="form-select" id="CategoryLevel2" name="cat_level_2">
                                    <option value="">Select Category Level 2</option>
                                </select>
                                <label for="CategoryLevel2" class="text-secondary">Category Level 2</label>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="900">
                            <div class="form-floating">
                                <i class="fas fa-calendar-alt form-icon"></i>
                                <input type="date" class="form-control" id="From" name="from" value="{{ old('from', isset($single_data->from) ? \Carbon\Carbon::parse($single_data->from)->format('Y-m-d') : '') }}" required>
                                <label for="From" class="text-secondary">From <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-delay="1000">
                            <div class="form-floating">
                                <i class="fas fa-calendar-check form-icon"></i>
                                <input type="date" class="form-control" id="to" name="to" value="{{ old('from', isset($single_data->to) ? \Carbon\Carbon::parse($single_data->to)->format('Y-m-d') : '') }}" required>
                                <label for="To" class="text-secondary">To <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-up" data-aos-delay="1100">
                            <div class="form-floating">
                                <i class="fas fa-align-left form-icon"></i>
                                <textarea class="form-control" id="AboutCourse" name="about_course" placeholder="Enter course details here" style="height: 100px;">{{ old('about_course', $single_data->about_course ?? '') }}</textarea>
                                <label for="AboutCourse" class="text-secondary">About Course</label>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-up" data-aos-delay="1200">
                            <div class="mb-3">
                                <h5 class="mb-3">Pricing</h5>
                                <input type="hidden" name="is_paid" value="0">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="isPaid" name="is_paid" value="1" {{ old('is_paid', $single_data->is_paid ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isPaid">Paid Item</label>
                                </div>
                                <div id="priceSection" style="{{ old('is_paid', $single_data->is_paid ?? false) ? 'display: block;' : 'display: none;' }}">
                                    <div class="form-floating mb-3">
                                        <i class="fas fa-dollar-sign form-icon"></i>
                                        <input type="number" class="form-control" id="Price" name="price" value="{{ old('price', $single_data->price ?? '') }}" placeholder="Price" min="0" step="0.01">
                                        <label for="Price" class="text-secondary">Regular Price</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <i class="fas fa-tags form-icon"></i>
                                        <input type="number" class="form-control" id="DiscountPrice" name="discount_price" value="{{ old('discount_price', $single_data->discount_price ?? '') }}" placeholder="Discount Price" min="0" step="0.01">
                                        <label for="DiscountPrice" class="text-secondary">Discounted Price</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4" data-aos="fade-up" data-aos-delay="1300">
                        <button type="button" class="btn btn-danger px-4" onclick="resetForm()" style="display: {{ isset($single_data) ? 'none' : 'inline' }}">
                            <i class="fas fa-undo-alt me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>{{ isset($single_data) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Live Classes</h5>
            </div>
            <div class="card-body">
               {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>



@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
<script>

AOS.init({
            duration: 1000,
            once: true
        });
    // Utility functions
const fetchCategoryData = async (url) => {
    try {
        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error('Error fetching category data:', error);
        return [];
    }
};

const populateDropdown = (selectElement, options) => {
    selectElement.innerHTML = '<option value="">Select Category</option>' +
        options.map(option => `<option value="${option.id}">${option.name}</option>`).join('');
};

const resetDropdown = (selectElement) => {
    selectElement.innerHTML = '<option value="">Select Category</option>';
};



document.getElementById('isPaid').addEventListener('change', function() {
        document.getElementById('priceSection').style.display = this.checked ? 'block' : 'none';
    });
// Category management
class CategoryManager {
    constructor() {
        this.level0 = document.getElementById('CategoryLevel0');
        this.level1 = document.getElementById('CategoryLevel1');
        this.level2 = document.getElementById('CategoryLevel2');
        this.level1Div = document.getElementById('category-level-1');
        this.level2Div = document.getElementById('category-level-2');

        this.initEventListeners();
    }

    initEventListeners() {
        this.level0.addEventListener('change', () => this.showCategoryLevel1());
        this.level1.addEventListener('change', () => this.showCategoryLevel2());
    }

    async showCategoryLevel1() {
        const categoryLevel0 = this.level0.value;
        if (!categoryLevel0) {
            this.resetLowerLevels(1);
            return;
        }

        const data = await fetchCategoryData(`/live-classes/cat1/${categoryLevel0}`);
        populateDropdown(this.level1, data);
        this.resetLowerLevels(2);
    }

    async showCategoryLevel2() {
        const categoryLevel1 = this.level1.value;
        if (!categoryLevel1) {
            this.resetLowerLevels(2);
            return;
        }

        const data = await fetchCategoryData(`/live-classes/cat2/${categoryLevel1}`);
        populateDropdown(this.level2, data);
    }

    resetLowerLevels(startLevel) {
        if (startLevel <= 1) {
            resetDropdown(this.level1);
        }
        if (startLevel <= 2) {
            resetDropdown(this.level2);
        }
    }

    async loadInitialData(level0Value, level1Value, level2Value) {
        // Always show all dropdowns
        this.level1Div.style.display = 'block';
        this.level2Div.style.display = 'block';

        if (level0Value) {
            this.level0.value = level0Value;
            await this.showCategoryLevel1();
            if (level1Value) {
                this.level1.value = level1Value;
                await this.showCategoryLevel2();
                if (level2Value) {
                    this.level2.value = level2Value;
                }
            }
        }
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', () => {
    const categoryManager = new CategoryManager();
    const level0Value = '{{ $single_data->cat_level_0 ?? '' }}';
    const level1Value = '{{ $single_data->cat_level_1 ?? '' }}';
    const level2Value = '{{ $single_data->cat_level_2 ?? '' }}';
    categoryManager.loadInitialData(level0Value, level1Value, level2Value);
});

// Function to reset the form (if needed)
function resetForm() {
        const form = document.getElementById('live_class_form');
        
        // Reset all fields
        form.reset();

        // Manually reset any custom components (like dropdowns, etc.)
        const categoryManager = new CategoryManager(); // Reset categories
        categoryManager.resetLowerLevels(1);

        // Clear file input (since `form.reset()` doesn't reset file inputs)
        const fileInput = document.getElementById('UploadBanner');
        if (fileInput) {
            fileInput.value = ''; // Reset the file input
        }

        console.log('Form reset triggered');
    }
</script>
<style>
       
    #videocourses-table {
        font-size: 14px;
        font-family: 'Arial', sans-serif;
    }
    
    #videocourses-table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    #videocourses-table tbody tr:hover {
        background-color: #f1f3f5;
    }
    .dataTables_wrapper .dataTables_length select
    {
        width: 100px;
    }
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        font-size: 14px;
        line-height: 1.5;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #ffffff;
        /* box-shadow: 0px 2px 2px #007bff */
        /* border: 1px solid #dee2e6; */
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .dt-buttons .btn {
        margin-right: 5px;
    }
    .form-floating {
            margin-bottom: 1.5rem;
        }
        .form-control, .form-select {
            padding-left: 2.5rem !important;
        }
        .form-floating label {
            padding-left: 2.5rem;
        }
        .form-icon {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #6c757d;
            z-index: 2;
        }
        </style>
@endsection

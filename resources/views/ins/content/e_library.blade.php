@extends('layout.app')

@section('content')

<div class="btn-container">
<button class="float-end btn-style" id="toggleBtn2" onclick="window.location.href='{{ isset($single_data) ? url('ins/content/e-library') : 'javascript:void(0)' }}'">
    {{ isset($single_data) ? 'View E-library' : 'Create New item' }} 

    <!-- Conditionally render the icon -->
    @if(isset($single_data))
        <i class="fa-solid fa-file-pdf"></i>
    @else
        <i class="fa-solid fa-circle-plus"></i>
    @endif
</button>
</div>

@if(!isset($single_data))
<div class="row my-4" id="table-container2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="card" id = "toggleDiv2" style="{{ isset($single_data) ? 'display: block;' : 'display: none;' }}">
    <div class="card-body p-4">
        <h5 class="card-title mb-4">{{ isset($single_data) ? 'Edit E-Library Item' : 'Add New E-Library Item' }}</h5>
        <form method="POST" id="e_library_form" action="{{ isset($single_data) ? route('elibrary.update', $single_data->id) : route('elibrary.store') }}" enctype="multipart/form-data" class="needs-validation">
            @csrf
            @if(isset($single_data))
                @method('PUT')
            @endif
            <div class="row g-3">
                <!-- Title -->
                <div class="col-md-12" data-aos="fade-up">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="Title" placeholder="Title" name="title" value="{{ old('title', $single_data->title ?? '') }}" required>
                        <label for="Title" class="text-secondary">
                            <i class="fas fa-heading"></i> Title <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
        
                <!-- Categories -->
                <div class="col-12" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="CategoryLevel0" name="cat_level_0" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $option)
                                        <option value="{{ $option->id }}" {{ old('cat_level_0', $single_data->cat_level_0 ?? '') == $option->id ? 'selected' : '' }}>
                                            {{ $option->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="CategoryLevel0" class="text-secondary">
                                    <i class="fas fa-list-alt"></i> Main Category <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4" id="category-level-1">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="CategoryLevel1" name="cat_level_1">
                                    <option value="">Select Subcategory</option>
                                </select>
                                <label for="CategoryLevel1" class="text-secondary">
                                    <i class="fas fa-list"></i> Subcategory
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4" id="category-level-2">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="CategoryLevel2" name="cat_level_2">
                                    <option value="">Select Sub-subcategory</option>
                                </select>
                                <label for="CategoryLevel2" class="text-secondary">
                                    <i class="fas fa-list-ul"></i> Sub-subcategory
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Duration -->
                <div class="col-md-6" data-aos="fade-up">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="{{ isset($single_data->course_duration) ? ($single_data->course_duration) : '' }}" id="course_duration" name="course_duration" required>
                        <label for="course_duration" class="text-secondary">
                            <i class="fas fa-clock"></i> Duration <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
        
                <!-- Banner Upload -->
                <div class="col-md-6" data-aos="fade-up">
                    <div class="mb-3">
                        <label for="UploadBanner" class="form-label text-secondary">
                            <i class="fas fa-image"></i> Thumbnail
                        </label>
                        <input type="file" class="form-control" id="UploadBanner" name="banner" accept="image/*">
                        @if(isset($single_data) && $single_data->banner)
                            <div class="mt-2">
                                <img src="{{ asset($single_data->banner) }}" alt="Current Banner" class="img-fluid img-thumbnail" style="max-width: 200px; max-height: 60px;">
                                <p class="text-muted small mt-1">Current thumbnail</p>
                            </div>
                        @endif
                    </div>
                </div>
        
                <!-- Upload Files -->
                @if(!isset($single_data))
                <div class="col-md-6" data-aos="fade-up">
                    <div class="mb-3">
                        <label for="UploadFile" class="form-label text-secondary">
                            <i class="fas fa-file-upload"></i> Upload E-Library Files
                        </label>
                        <input type="file" class="form-control" id="UploadFile" name="files[]" multiple required>
                    </div>
                </div>
                @endif
        
                <!-- Description -->
                <div class="col-12" data-aos="fade-up">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="Description" name="description" placeholder="Enter description here" style="height: 100px;">{{ old('description', $single_data->description ?? '') }}</textarea>
                        <label for="Description" class="text-secondary">
                            <i class="fas fa-align-left"></i> Description
                        </label>
                    </div>
                </div>
        
                <!-- Pricing Section (Moved to the bottom) -->
                <div class="col-md-12" data-aos="fade-up">
                    <h5 class="mb-3"><i class="fas fa-dollar-sign"></i> Pricing</h5>
        
                    <input type="hidden" name="is_paid" value="0">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="isPaid" name="is_paid" value="1" {{ old('is_paid', $single_data->is_paid ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isPaid">Paid Item</label>
                    </div>
        
                    <div id="priceSection" style="{{ old('is_paid', $single_data->is_paid ?? false) ? 'display: block;' : 'display: none;' }}">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="Price" name="price" value="{{ old('price', $single_data->price ?? '') }}" placeholder="Price" min="0" step="0.01">
                            <label for="Price" class="text-secondary">Regular Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="DiscountPrice" name="discount_price" value="{{ old('discount_price', $single_data->discount_price ?? '') }}" placeholder="Discount Price" min="0" step="0.01">
                            <label for="DiscountPrice" class="text-secondary">Discounted Price</label>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-4" data-aos="fade-up">
                @if(!isset($single_data))
                <button type="button" class="btn btn-danger px-4" onclick="resetForm()">
                    <i class="fas fa-undo-alt"></i> Reset
                </button>
                @endif
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i> {{ isset($single_data) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
</div>
{{-- <h1>Hi</h1> --}}

<form id="imageUploadForm" style="display: none;" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image[]" id="hiddenImageInput" multiple accept="video/*">
    <input type="hidden" name="course_id" id="hiddenCourseId">
</form>
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush


<Script>
    const createItem = document.getElementById('toggleBtn2');
    createItem.addEventListener('click', function() {
        var dataTable = document.getElementById('table-container2');
        var toggleDiv1 = document.getElementById('toggleDiv2');
        if (toggleDiv1.style.display === "none" || toggleDiv1.style.display === "") {
            toggleDiv1.style.display = "block";
            createItem.innerHTML = "View E-library <i class='fa-solid fa-file-pdf'></i>"
            dataTable.style.display = "none";

        } else {
            toggleDiv1.style.display = "none";   // Hide the div
            dataTable.style.display = "block";
            createItem.innerHTML = "Create E-library Item <i class='fa-solid fa-circle-plus'></i>"
        }
        
    });
</script>

<script>
    //    AOS.init();


       
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

    // Pricing switch functionality
    document.getElementById('isPaid').addEventListener('change', function() {
        document.getElementById('priceSection').style.display = this.checked ? 'block' : 'none';
    });
});

// Function to reset the form
function resetForm() {
    const form = document.getElementById('e_library_form');
    
    // Reset all fields
    form.reset();

    // Manually reset any custom components (like dropdowns, etc.)
    const categoryManager = new CategoryManager(); // Reset categories
    categoryManager.resetLowerLevels(1);

    // Clear file inputs
    document.getElementById('UploadBanner').value = '';
    document.getElementById('UploadFile').value = '';

    // Hide price section
    document.getElementById('priceSection').style.display = 'none';

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
        </style>
@endsection
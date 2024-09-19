@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Video Course</h5>
                    <small class="text-muted float-end">{{ isset($single_data) ? 'Edit Course' : 'Create New Course' }}</small>
                </div>
                <div class="card-body p-4" data-aos="fade-up" data-aos-duration="1000">
                    <form method="POST" action="{{ isset($single_data) ? route('videocourse.update', $single_data->id) : route('videocourse.store') }}" enctype="multipart/form-data" class="needs-validation">
                        @csrf
                        @if(isset($single_data))
                            @method('PUT')
                        @endif
                
                        <div class="row g-3">
                            <!-- Course Name with Icon -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <input type="text" class="form-control" id="CourseName" placeholder="Course Name" name="course_name" value="{{ old('course_name', $single_data->course_name ?? '') }}" required>
                                    <label for="CourseName" class="text-secondary"><i class="fas fa-book-open"></i> Course Name <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                
                            <!-- Language Select with Icon -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-left" data-aos-duration="1000">
                                    <select class="form-select" id="Language" name="language" required>
                                        <option value="" selected disabled>Select Language</option>
                                        <option value="1" {{ (old('language', $single_data->language ?? '') == '1') ? 'selected' : '' }}>Hindi</option>
                                        <option value="2" {{ (old('language', $single_data->language ?? '') == '2') ? 'selected' : '' }}>English</option>
                                    </select>
                                    <label for="Language" class="text-secondary"><i class="fas fa-language"></i> Language <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                
                            <!-- Banner Upload -->
                            <div class="col-md-6">
                                <div class="mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <label for="banner" class="form-label text-secondary"><i class="fas fa-image"></i> Upload Banner</label>
                                    <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
                                    @if(isset($single_data) && $single_data->banner)
                                        <div class="mt-2">
                                            <img src="{{ asset($single_data->banner) }}" alt="Current Banner" class="img-fluid img-thumbnail" style="max-width: 200px; max-height: 60px;">
                                            <p class="text-muted small mt-1">Current banner image</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                
                            <!-- Video Upload -->
                            @if(!isset($single_data))
                            <div class="col-md-6">
                                <div class="mb-3" data-aos="fade-left" data-aos-duration="1000">
                                    <label for="videos" class="form-label text-secondary"><i class="fas fa-video"></i> Upload Videos</label>
                                    <input type="file" class="form-control" id="videos" name="videos[]" accept="video/*" multiple>
                                </div>
                            </div>
                            @endif
                
                            <!-- Course Category -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <select class="form-select" id="CourseCategory" name="course_category_id" required>
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $option)
                                        <option value="{{ $option->id }}" {{ old('cat_level_0', $single_data->cat_level_0 ?? '') == $option->id ? 'selected' : '' }}>
                                            {{ $option->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="CourseCategory" class="text-secondary"><i class="fas fa-list-alt"></i> Course Category <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                
                            <!-- Date Fields -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-left" data-aos-duration="1000">
                                    <input type="date" class="form-control" id="from" name="from" value="{{ old('from', isset($single_data->from) ? \Carbon\Carbon::parse($single_data->from)->format('Y-m-d') : '') }}" required>
                                    <label for="from" class="text-secondary"><i class="fas fa-calendar-alt"></i> From <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                
                            <div class="col-md-12">
                                <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <input type="date" class="form-control" id="to" name="to" value="{{ old('to', isset($single_data->to) ? \Carbon\Carbon::parse($single_data->to)->format('Y-m-d') : '') }}" required>
                                    <label for="to" class="text-secondary"><i class="fas fa-calendar-alt"></i> To <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                
                            <!-- About Course -->
                            <div class="col-12">
                                <div class="form-floating mb-3" data-aos="fade-up" data-aos-duration="1000">
                                    <textarea class="form-control" id="AboutCourse" name="about_course" placeholder="Enter course details here" style="height: 100px;">{{ old('about_course', $single_data->about_course ?? '') }}</textarea>
                                    <label for="AboutCourse" class="text-secondary"><i class="fas fa-info-circle"></i> About Course</label>
                                </div>
                            </div>
                
                            <!-- Pricing Section - Full Width -->
                            <div class="col-12">
                                <div class="mb-3" data-aos="fade-up" data-aos-duration="1000">
                                    <h5 class="mb-3"><i class="fas fa-dollar-sign"></i> Pricing</h5>
                
                                    <!-- Hidden field to ensure false value is sent when unchecked -->
                                    <input type="hidden" name="is_paid" value="0">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="isPaid" name="is_paid" value="1" {{ old('is_paid', $single_data->is_paid ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isPaid">Paid Item</label>
                                    </div>
                
                                    <div id="priceSection" style="{{ old('is_paid', $single_data->is_paid ?? false) ? 'display: block;' : 'display: none;' }}">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="Price" name="price" value="{{ old('price', $single_data->price ?? '') }}" placeholder="Price" min="0" step="0.01">
                                            <label for="Price" class="text-secondary"><i class="fas fa-money-bill"></i> Regular Price</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="DiscountPrice" name="discount_price" value="{{ old('discount_price', $single_data->discount_price ?? '') }}" placeholder="Discount Price" min="0" step="0.01">
                                            <label for="DiscountPrice" class="text-secondary"><i class="fas fa-percentage"></i> Discounted Price</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                
                        <!-- Submit and Reset Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-danger px-4" onclick="resetForm()" style="display: {{ isset($single_data) ? 'none' : 'inline' }}">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">{{ isset($single_data) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    @if(!isset($single_data))
    <div class="row">
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
     <!-- Hidden form for image upload -->
     <form id="imageUploadForm" style="display: none;" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image[]" id="hiddenImageInput" multiple accept="video/*">
        <input type="hidden" name="course_id" id="hiddenCourseId">
    </form>

    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
    <script>
// AOS.init();

        function resetForm() {
            document.querySelector('form').reset();
        }
        document.getElementById('isPaid').addEventListener('change', function() {
        document.getElementById('priceSection').style.display = this.checked ? 'block' : 'none';
    });


        function addImage(courseId) {
            // Trigger the hidden file input
            const hiddenInput = document.getElementById('hiddenImageInput');
            const form = document.getElementById('imageUploadForm');

            document.getElementById('hiddenCourseId').value = courseId;
            
            hiddenInput.click();
            
            // When a file is selected, submit the form
            hiddenInput.onchange = function() {
                if (hiddenInput.files.length > 0) {
                    // Perform AJAX to upload image
                    const formData = new FormData(form);
                    formData.append('course_id', courseId);

                    $.ajax({
    url: '{{ route("videocourse.uploadVideos") }}',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        alert('Videos uploaded successfully!');
        $('#videocourses-table').DataTable().ajax.reload();
    },
    error: function(response) {
        if(response.responseJSON && response.responseJSON.errors) {
            let errors = response.responseJSON.errors;
            let errorMessage = '';
            for (let field in errors) {
                errorMessage += errors[field].join(', ') + '\n';
            }
            alert('Upload failed:\n' + errorMessage);
        } else {
            alert('Upload failed. Please try again.');
        }
    }
});

                }
            };
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

@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Video Course</h5>
                    <small class="text-muted float-end">{{ isset($single_data) ? 'Edit Course' : 'Create New Course' }}</small>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ isset($single_data) ? route('videocourse.update', $single_data->id) : route('videocourse.store') }}" enctype="multipart/form-data" class="needs-validation">
                        @csrf
                        @if(isset($single_data))
                            @method('PUT')
                        @endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="CourseName" placeholder="Course Name" name="course_name" value="{{ old('course_name', $single_data->course_name ?? '') }}" required>
                                    <label for="CourseName" class="text-secondary">Course Name <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="Language" name="language" required>
                                        <option value="" selected disabled>Select Language</option>
                                        <option value="1" {{ (old('language', $single_data->language ?? '') == '1') ? 'selected' : '' }}>Hindi</option>
                                        <option value="2" {{ (old('language', $single_data->language ?? '') == '2') ? 'selected' : '' }}>English</option>
                                    </select>
                                    <label for="Language" class="text-secondary">Language <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="OriginalPrice" name="original_price" value="{{ old('original_price', $single_data->original_price ?? '') }}" placeholder="Original Price" required min="0" step="0.01">
                                    <label for="OriginalPrice" class="text-secondary">Original Price <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="DiscountPrice" name="discount_price" value="{{ old('discount_price', $single_data->discount_price ?? '') }}" placeholder="Discount Price" required min="0" step="0.01">
                                    <label for="DiscountPrice" class="text-secondary">Discount Price <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="banner" class="form-label text-secondary">Upload Banner</label>
                                    <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
                                    @if(isset($single_data) && $single_data->banner)
                                        <div class="mt-2">
                                            <img src="{{ asset($single_data->banner) }}" alt="Current Banner" class="img-fluid img-thumbnail" style="max-width: 200px; max-height: 60px;">
                                            <p class="text-muted small mt-1">Current banner image</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if(!isset($single_data))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="videos" class="form-label text-secondary">Upload Videos</label>
                                    <input type="file" class="form-control" id="videos" name="videos[]" accept="video/*" multiple>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="CourseCategory" name="course_category_id" required>
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="1" {{ (old('course_category_id', $single_data->course_category_id ?? '') == '1') ? 'selected' : '' }}>CCC</option>
                                        <option value="2" {{ (old('course_category_id', $single_data->course_category_id ?? '') == '2') ? 'selected' : '' }}>PHP</option>
                                        <option value="3" {{ (old('course_category_id', $single_data->course_category_id ?? '') == '3') ? 'selected' : '' }}>DRUPAL</option>
                                    </select>
                                    <label for="CourseCategory" class="text-secondary">Course Category <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="from" name="from" value="{{ old('from', isset($single_data->from) ? \Carbon\Carbon::parse($single_data->from)->format('Y-m-d') : '') }}" required>
                                    <label for="from" class="text-secondary">From <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="to" name="to" value="{{ old('to', isset($single_data->to) ? \Carbon\Carbon::parse($single_data->to)->format('Y-m-d') : '') }}" required>
                                    <label for="to" class="text-secondary">To <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="AboutCourse" name="about_course" placeholder="Enter course details here" style="height: 100px;">{{ old('about_course', $single_data->about_course ?? '') }}</textarea>
                                    <label for="AboutCourse" class="text-secondary">About Course</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-danger px-4" onclick="resetForm()" style="display: {{ isset($single_data) ? 'none' : 'inline' }}">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">{{ isset($single_data) ? 'Update' : 'Save' }}</button>
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
        function resetForm() {
            document.querySelector('form').reset();
        }


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
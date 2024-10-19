@extends('layout.app')

@section('content')

<div class="btn-container">
<button class="float-end btn-style" id="toggleBtn" onclick="window.location.href='{{ isset($single_data) ? url('ins/video') : 'javascript:void(0)' }}'">
    {{ isset($single_data) ? 'View Courses' : 'Create New Course' }} 

    <!-- Conditionally render the icon -->
    @if(isset($single_data))
        <i class="fa-solid fa-video"></i>
    @else
        <i class="fa-solid fa-circle-plus"></i>
    @endif
</button>

</div>

@if(!isset($single_data))

    <div class="row" id="table-container">
        
        <div class="col-12">
            <div class="card">
                
                <div class="card-body">

                    <div class="table-responsive dataTables_wrapper" id="dataTables_wrapper">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="row" id="toggleDiv" style="{{ Request::is('ins/video/edit/*') ? 'display: block;' : 'display: none;' }}">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Video Course</h5>
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
                                    <label for="CourseName" class="text-secondary"><i class="fas fa-book-open"></i> Title <span class="text-secondary">*</span></label>
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
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-left" data-aos-duration="1000">
                                    <select class="form-select" id="CourseValidity" name="course_validity" required>
                                        <option value="" selected disabled>Select Course Validity</option>
                                        <option value="1" {{ (old('course_validity', $single_data->course_validity ?? '') == '1') ? 'selected' : '' }}>1 Month</option>
                                        <option value="6" {{ (old('course_validity', $single_data->course_validity ?? '') == '6') ? 'selected' : '' }}>6 Months</option>
                                        <option value="12" {{ (old('course_validity', $single_data->course_validity ?? '') == '12') ? 'selected' : '' }}>1 Year</option>
                                        <option value="24" {{ (old('course_validity', $single_data->course_validity ?? '') == '24') ? 'selected' : '' }}>2 Years</option>
                                        <option value="36" {{ (old('course_validity', $single_data->course_validity ?? '') == '36') ? 'selected' : '' }}>3 Years</option>
                                    </select>
                                    <label for="CourseValidity" class="text-secondary"><i class="fas fa-calendar-alt"></i> Course Validity <span class="text-secondary">*</span></label>
                                </div>
                            </div>
                            
                
                            <!-- Banner Upload -->
                            <div class="col-md-6">
                                <div class="mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <label for="banner" class="form-label text-secondary"><i class="fas fa-image"></i> Upload thumbnail</label>
                                    <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
                                    @if(isset($single_data) && $single_data->banner)
                                        <div class="mt-2">
                                            <img src="{{ asset($single_data->banner) }}" alt="Current Banner" class="img-fluid img-thumbnail" style="max-width: 200px; max-height: 60px;">
                                            <p class="text-muted small mt-1">Current thumbnail</p>
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
                
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <input type="date" class="form-control" id="to" name="to" value="{{ old('to', isset($single_data->to) ? \Carbon\Carbon::parse($single_data->to)->format('Y-m-d') : '') }}" required>
                                    <label for="to" class="text-secondary"><i class="fas fa-calendar-alt"></i> To <span class="text-secondary">*</span></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <div class="form-control d-flex flex-wrap align-items-center gap-2 multi-subject-container" onclick="focusInput(this)" style="min-height: 58px; cursor: text;">
                                        <div id="subjectTags" class="d-flex flex-wrap align-items-center gap-2">
                                            <!-- Subject tags will be inserted here -->
                                        </div>
                                        <input type="text" id="subjectInput" class="border-0 flex-grow-1 bg-transparent" style="outline: none; min-width: 60px;" placeholder="Add subjects" onkeydown="handleKeyDown(event)">
                                    </div>
                                    <label for="subjectInput" class="text-secondary">
                                        <i class="fas fa-calendar-alt"></i> Add subjects <span class="text-secondary">*</span>
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" id="subjectsHidden" name="subjects" value="">
                
                            <!-- About Course -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                                    <textarea type="text" class="form-control" id="AboutCourse" placeholder="About Course" name="about_course" value="{{ old('about_course', $single_data->about_course ?? '') }}" required></textarea>
                                    <label for="AboutCourse" class="text-secondary"><i class="fas fa-info-circle"></i> About Course <span class="text-secondary">*</span></label>
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
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="showOnWebsite" 
                                           name="show_on_website" 
                                           value="1" 
                                           {{ isset($single_data->show_on_website) && $single_data->show_on_website ? 'checked' : '' }}>
                                    <label class="form-check-label" for="showOnWebsite">Show on Website</label>
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
    let subjects = [];

    function handleKeyDown(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            addSubject();
        }
    }

    function addSubject() {
        const input = document.getElementById('subjectInput');
        const subject = input.value.trim();
        if (subject && !subjects.includes(subject)) {
            subjects.push(subject);
            renderSubjects();
            input.value = '';
        }
    }

    function removeSubject(subject) {
        subjects = subjects.filter(s => s !== subject);
        renderSubjects();
    }

    function renderSubjects() {
        const container = document.getElementById('subjectTags');
        container.innerHTML = subjects.map(subject => `
            <span class="badge bg-primary me-2 d-flex align-items-center">
                ${subject}
                <button type="button" class="btn-close btn-close-white ms-2" 
                        onclick="removeSubject('${subject}')" 
                        aria-label="Remove subject" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="Remove subject"></button>
            </span>
        `).join('');

        document.getElementById('subjectsHidden').value = JSON.stringify(subjects);
    }
</script>

<Script>
    const createCourseBtn = document.getElementById('toggleBtn');
    createCourseBtn.addEventListener('click', function() {
        var dataTable = document.getElementById('table-container');
        var toggleDiv = document.getElementById('toggleDiv');
        if (toggleDiv.style.display === "none" || toggleDiv.style.display === "") {
            toggleDiv.style.display = "block";  // Show the div
            createCourseBtn.innerHTML = "View Courses <i class='fa-solid fa-video'></i>"
            dataTable.style.display = "none";

        } else {
            toggleDiv.style.display = "none";   // Hide the div
            dataTable.style.display = "block";
            createCourseBtn.innerHTML = "Create new classes <i class='fa-solid fa-circle-plus'></i>"
        }
        
    });
</script>

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
    /* line-height: 1.25; */
    color: #007bff;
    cursor: pointer;
    /* background-color: #ffffff; */
    /* box-shadow: 0px 2px 2px #007bff */
    /* border: 1px solid #dee2e6; */
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    /* color: #0056b3;
    text-decoration: none;
    background-color: #e9ecef;
    border-color: #dee2e6; */
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

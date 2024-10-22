@extends('layout.app')

@section('content')
<div class="btn-container">
    <button class="float-end btn-style" id="toggleBtn1"
        onclick="window.location.href='{{ isset($single_data) ? url('ins/content') : 'javascript:void(0)' }}'">
        {{ isset($single_data) ? 'View classes' : 'Create Live class' }}

        <!-- Conditionally render the icon -->
        @if(isset($single_data))
            <i class="fa-solid fa-video"></i>
        @else
            <i class="fa-solid fa-circle-plus"></i>
        @endif
    </button>

</div>
<div class="container-fluid">
    <div class="row">
        <!-- Left Section (Yajra Table, 75% width) -->
        <div class="col-md-9">
            @if(!isset($single_data))
                <div class="row" id="table-container1">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Live Classes</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive"> <!-- Added table-responsive here -->
                                    {{ $dataTable->table(['class' => 'table table-bordered']) }}
                                    <!-- Updated with table class -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <!-- Form for adding/updating live classes -->
            <div class="row" id="toggleDiv1" style="{{ isset($single_data) ? 'display: block;' : 'display: none;' }}">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Create new live class</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" id="live_class_form"
                                action="{{ isset($single_data) ? route('liveclass.update', $single_data->id) : route('liveclass.store') }}"
                                enctype="multipart/form-data" class="needs-validation" data-aos="fade-up">
                                @csrf
                                @if(isset($single_data))
                                    @method('PUT')
                                @endif
                                <div class="col-md-6" id="choose-path" data-aos="fade-right" data-aos-delay="100">
                                    <div class="form-floating">
                                        <i class="fas fa-book form-icon"></i>
                                        <select class="form-control" id="coursePath" required>

                                        </select>
                                        <label for="CoursePath" class="text-secondary">Choose Path <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <!-- Placeholder div where the selected folder info will be shown -->
                                    <!-- <div id="selected-folder-info"></div> -->

                                </div>
                                <div id="folderDropdownContainer" class="mt-3"></div>

                                <div class="row g-4">
                                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                                        <div class="form-floating">
                                            <i class="fas fa-book form-icon"></i>
                                            <input type="text" class="form-control" id="CourseName"
                                                placeholder="Course Name" name="course_name"
                                                value="{{ old('course_name', $single_data->course_name ?? '') }}"
                                                required>
                                            <label for="CourseName" class="text-secondary">Course Title <span
                                                    class="text-danger">*</span></label>
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
                                            <label for="Language" class="text-secondary">Language <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                                        <div class="form-floating">
                                            <i class="fas fa-image form-icon"></i>
                                            <input type="file" class="form-control" id="UploadBanner" name="banner"
                                                accept="image/*">
                                            <label for="UploadBanner" class="text-secondary">Upload Thumbnail
                                                (Optional)</label>
                                        </div>
                                        @if(isset($single_data) && $single_data->banner)
                                            <div class="mt-2">
                                                <img src="{{ asset($single_data->banner) }}" alt="Current Banner"
                                                    class="img-fluid img-thumbnail"
                                                    style="max-width: 200px; max-height: 60px;">
                                                <p class="text-muted small mt-1">Current Thumbnail</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                                        <div class="form-floating">
                                            <select class="form-control" id="courseList" name="course[]" multiple>
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="courseList" class="text-secondary">Select Courses</label>
                                            --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6" data-aos="fade-left" data-aos-delay="400">
                                        {{-- <div class="form-floating">
                                            <i class="fas fa-percent form-icon"></i>
                                            <select class="form-select" id="DiscountType" name="discount_type" required>
                                                <option value="" selected disabled>Select Discount Type</option>
                                                <option value="fixed" {{ (old('discount_type', $single_data->
                                                    discount_type ?? '') == 'fixed') ? 'selected' : '' }}>Fixed</option>
                                                <option value="percentage" {{ (old('discount_type', $single_data->
                                                    discount_type ?? '') == 'percentage') ? 'selected' : ''
                                                    }}>Percentage</option>
                                            </select>
                                            <label for="DiscountType" class="text-secondary">Discount Type <span
                                                    class="text-danger">*</span></label>
                                        </div> --}}
                                    </div>
                                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                                        <div class="form-floating">
                                            <i class="fas fa-calendar-day form-icon"></i>
                                            <input type="number" class="form-control" value="{{ isset($single_data->Course_duration) ? $single_data->Course_duration : '' }}" id="course_duration" name="course_duration" min="1" required>
                                            <label for="course_duration" class="text-secondary">Course Duration (Days) <span class="text-danger">*</span></label>
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
                                            <label for="CategoryLevel0" class="text-secondary">Course Category <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6" id="category-level-1"
                                        style="{{ isset($single_data->cat_level_0) ? 'display: block;' : 'display: none;' }}"
                                        data-aos="fade-right" data-aos-delay="700">
                                        <div class="form-floating">
                                            <i class="fas fa-list-ol form-icon"></i>
                                            <select class="form-select" id="CategoryLevel1" name="cat_level_1">
                                                <option value="">Select Category Level 1</option>
                                            </select>
                                            <label for="CategoryLevel1" class="text-secondary">Category Level 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="category-level-2"
                                        style="{{ isset($single_data->cat_level_1) ? 'display: block;' : 'display: none;' }}"
                                        data-aos="fade-left" data-aos-delay="800">
                                        <div class="form-floating">
                                            <i class="fas fa-list-ul form-icon"></i>
                                            <select class="form-select" id="CategoryLevel2" name="cat_level_2">
                                                <option value="">Select Category Level 2</option>
                                            </select>
                                            <label for="CategoryLevel2" class="text-secondary">Category Level 2</label>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="900">
                                        <div class="form-floating">
                                            <i class="fas fa-calendar-alt form-icon"></i>
                                            <input type="date" class="form-control" id="From" name="from"
                                                value="{{ old('from', isset($single_data->from) ? \Carbon\Carbon::parse($single_data->from)->format('Y-m-d') : '') }}"
                                                required>
                                            <label for="From" class="text-secondary">From <span
                                                    class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" data-aos="fade-left" data-aos-delay="1000">
                                        <div class="form-floating">
                                            <i class="fas fa-calendar-check form-icon"></i>
                                            <input type="date" class="form-control" id="to" name="to"
                                                value="{{ old('from', isset($single_data->to) ? \Carbon\Carbon::parse($single_data->to)->format('Y-m-d') : '') }}">
                                            <label for="To" class="text-secondary">To <span
                                                    class="text-danger">(optional)</span></label>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12" data-aos="fade-up" data-aos-delay="1100">
                                        <div class="form-floating">
                                            <i class="fas fa-align-left form-icon"></i>
                                            <textarea class="form-control" id="AboutCourse" name="about_course"
                                                placeholder="Enter course details here"
                                                style="height: 100px;">{{ old('about_course', $single_data->about_course ?? '') }}</textarea>
                                            <label for="AboutCourse" class="text-secondary">About Course</label>
                                        </div>
                                    </div> --}}
                                    @if(!isset($single_data))
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="1100">
                                            <div class="form-floating">
                                                <i class="fas fa-file-pdf form-icon"></i>
                                                <input class="form-control" type="file" id="CourseFiles"
                                                    name="course_pdfs[]" accept=".pdf" multiple>
                                                <label for="CourseFiles" class="text-secondary">Upload Course PDFs</label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="1100">

                                        </div>
                                    @endif

                                    <div class="col-12" data-aos="fade-up" data-aos-delay="1200">
                                        <div class="mb-3">
                                            <h5 class="mb-3">Pricing</h5>
                                            <input type="hidden" name="is_paid" value="0">
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="isPaid"
                                                    name="is_paid" value="1" {{ old('is_paid', $single_data->is_paid ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="isPaid">Paid Item</label>
                                            </div>
                                            <div id="priceSection"
                                                style="{{ old('is_paid', $single_data->is_paid ?? false) ? 'display: block;' : 'display: none;' }}">
                                                <div class="form-floating mb-3">
                                                    <i class="fas fa-dollar-sign form-icon"></i>
                                                    <input type="number" class="form-control" id="Price" name="price"
                                                        value="{{ old('price', $single_data->price ?? '') }}"
                                                        placeholder="Price" min="0" step="0.01">
                                                    <label for="Price" class="text-secondary">Regular Price</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <i class="fas fa-tags form-icon"></i>
                                                    <input type="number" class="form-control" id="DiscountPrice"
                                                        name="discount_price"
                                                        value="{{ old('discount_price', $single_data->discount_price ?? '') }}"
                                                        placeholder="Discount Price" min="0" step="0.01">
                                                    <label for="DiscountPrice" class="text-secondary">Discounted
                                                        Price</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4" data-aos="fade-up"
                                    data-aos-delay="1300">
                                    <button type="button" class="btn btn-danger px-4" onclick="resetForm()"
                                        style="display: {{ isset($single_data) ? 'none' : 'inline' }}">
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
        </div>

        <!-- Right Section (Live and Upcoming Classes, 25% width) -->
        <div class="col-md-3">
            <!-- Current Live Classes -->
            <div class="card">
                <h5 class="card-header text-black">Current Live Classes</h5>
                @foreach($currentClasses as $class)
                    <div class="card-body">
                        <h5 class="card-title ">{{ $class->course_name }}
                            <span class="icon-container">
                                <a href="{{ route('liveClasses.edit', $class->id) }}" class="">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('live-class-pdfs.index', $class->id) }}" class="">
                                    <i class="fa fa-file-pdf"></i>
                                </a>
                                <i class="fa fa-trash"></i>
                            </span>



                        </h5>
                        <p class="card-text">From: {{ \Carbon\Carbon::parse($class->from)->format('d M Y, h:i A') }}</p>
                        <p class="card-text">To: {{ \Carbon\Carbon::parse($class->to)->format('d M Y, h:i A') }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Upcoming Classes -->
            <div class="card">
                <h5 class="card-header text-black">Upcoming Classes</h5>
                @foreach($upcomingClasses as $class)
                    <div class="card-body">
                        <h5 class="card-title ">{{ $class->course_name }}
                            <span class="icon-container">
                                <a href="{{ route('liveClasses.edit', $class->id) }}" class="">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('live-class-pdfs.index', $class->id) }}" class="">
                                    <i class="fa fa-file-pdf"></i>
                                </a>
                                <i class="fa fa-trash"></i>
                            </span>
                        </h5>
                        <p class="card-text">Starts on: {{ \Carbon\Carbon::parse($class->from)->format('d M Y, h:i A') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal for folder selection -->
<div class="modal fade" id="folderSelectModal" tabindex="-1" aria-labelledby="folderSelectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="folderSelectModalLabel">Select Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="folderHierarchyContainer">
                    <!-- Folder hierarchy will be populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Schedule Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="scheduleModalLabel">
                    <i class="fas fa-calendar-alt me-2"></i> Schedule Live Class
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="class_id" id="class_id">

                <div class="modal-body">
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold">
                            <i class="fas fa-heading me-2"></i>Title
                        </label>
                        <input type="text" class="form-control form-control-lg" id="title" name="title" required 
                               placeholder="Enter class title">
                        <div class="invalid-feedback">Please provide a title for the class.</div>
                    </div>

                    <!-- Date and Time -->
                    <div class="mb-4">
                        <label for="date" class="form-label fw-bold">
                            <i class="fas fa-clock me-2"></i>Date & Time
                        </label>
                        <input type="datetime-local" class="form-control form-control-lg" id="date" name="date" required>
                        <div class="invalid-feedback">Please select a valid date and time.</div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-4">
                        <label for="duration" class="form-label fw-bold">
                            <i class="fas fa-hourglass-half me-2"></i>Duration
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg" id="duration" name="duration" 
                                   required min="15" max="240" placeholder="Enter duration">
                            <span class="input-group-text">minutes</span>
                        </div>
                        <div class="form-text">Minimum 15 minutes, maximum 240 minutes</div>
                    </div>

                    <!-- Repeating -->
                    <div class="mb-4">
                        <label for="repeating" class="form-label fw-bold">
                            <i class="fas fa-redo me-2"></i>Repeating
                        </label>
                        <select class="form-select form-select-lg" id="repeating" name="repeating">
                            <option value="no">No Repeat</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>

                    <!-- Weekly Repeat Options (initially hidden) -->
                    <div class="mb-4 repeat-options" id="weeklyOptions" style="display: none;">
                        <div class="card border-light bg-light">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3 text-muted">Repeat on following days:</h6>
                                <div class="d-flex gap-2 flex-wrap">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="monday" name="repeat_days[]" value="monday">
                                        <label class="form-check-label" for="monday">Monday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="tuesday" name="repeat_days[]" value="tuesday">
                                        <label class="form-check-label" for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="wednesday" name="repeat_days[]" value="wednesday">
                                        <label class="form-check-label" for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="thursday" name="repeat_days[]" value="thursday">
                                        <label class="form-check-label" for="thursday">Thursday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="friday" name="repeat_days[]" value="friday">
                                        <label class="form-check-label" for="friday">Friday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="saturday" name="repeat_days[]" value="saturday">
                                        <label class="form-check-label" for="saturday">Saturday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="sunday" name="repeat_days[]" value="sunday">
                                        <label class="form-check-label" for="sunday">Sunday</label>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <label for="repeat_until" class="form-label">Repeat until</label>
                                    <input type="date" class="form-control" id="repeat_until" name="repeat_until">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enable Recording -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-video me-2"></i>Enable Recording
                        </label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" id="recording_yes" name="enable_recording" value="1">
                            <label class="btn btn-outline-success" for="recording_yes">
                                <i class="fas fa-check-circle me-2"></i>Yes
                            </label>
                            
                            <input type="radio" class="btn-check" id="recording_no" name="enable_recording" value="0" checked>
                            <label class="btn btn-outline-danger" for="recording_no">
                                <i class="fas fa-times-circle me-2"></i>No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-calendar-check me-2"></i>Schedule Class
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle repeating options visibility
    const repeatingSelect = document.getElementById('repeating');
    const weeklyOptions = document.getElementById('weeklyOptions');
    
    repeatingSelect.addEventListener('change', function() {
        weeklyOptions.style.display = this.value === 'weekly' ? 'block' : 'none';
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Set minimum date for datetime-local
    const dateInput = document.getElementById('date');
    const today = new Date();
    const minDateTime = today.toISOString().slice(0, 16);
    dateInput.min = minDateTime;

    // Set minimum date for repeat_until
    const repeatUntilInput = document.getElementById('repeat_until');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const minDate = tomorrow.toISOString().slice(0, 10);
    repeatUntilInput.min = minDate;
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<Script>
    const createLiveBtn = document.getElementById('toggleBtn1');
    createLiveBtn.addEventListener('click', function () {
        var dataTable = document.getElementById('table-container1');
        var toggleDiv1 = document.getElementById('toggleDiv1');
        if (toggleDiv1.style.display === "none" || toggleDiv1.style.display === "") {
            toggleDiv1.style.display = "block";
            createLiveBtn.innerHTML = "View classes <i class='fa-solid fa-video'></i>"
            dataTable.style.display = "none";

        } else {
            toggleDiv1.style.display = "none";   // Hide the div
            dataTable.style.display = "block";
            createLiveBtn.innerHTML = "Create Live class <i class='fa-solid fa-circle-plus'></i>"
        }

    });
</script>

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Load subfolders via AJAX when the expand button is clicked
        function attachExpandListeners() {
            // Remove any existing event listener attached to 'click' on the document
            document.removeEventListener('click', handleExpandButtonClick);

            // Add a new event listener for 'click' on the document
            document.addEventListener('click', handleExpandButtonClick);

            console.log('Event listeners attached to expand buttons.');
        }

        // Function that handles clicks on expand buttons
        function handleExpandButtonClick(event) {
            const button = event.target.closest('.expand-btn');
            if (button) {
                expandFolder.call(button);
            }
        }

        function expandFolder() {
            let folderId = this.getAttribute('data-folder-id');
            let subfolderContainer = document.getElementById(`subfolder-container-${folderId}`);
            let toggleIcon = this.querySelector('i');

            console.log('Expand button clicked for folder ID:', folderId, toggleIcon);

            // Toggle icon between + and - when expanding/collapsing
            toggleIcon.classList.toggle('bi-plus-circle');
            toggleIcon.classList.toggle('bi-dash-circle');

            if (subfolderContainer.style.display === 'block') {
                subfolderContainer.style.display = 'none'; // Collapse the subfolder container
            } else {
                // If subfolders have not been loaded yet, load them via AJAX
                if (!subfolderContainer.hasAttribute('data-loaded')) {
                    fetch(`/folders/load-subfolders/${folderId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const { subfolders, files } = data;

                            if ((files && files.length > 0) || (subfolders && subfolders.length > 0)) {
                                let parentFilesHTML = `<div class="files">`;
                                files.forEach(file => {
                                    parentFilesHTML += `
                                <div class="file" id="file-${file.id}">
                                    <i class="file-icon fas fa-file-alt"></i>
                                    <span class="file-name">${file.name}</span>
                                </div>
                            `;
                                });
                                parentFilesHTML += `</div>`;
                                subfolderContainer.innerHTML += parentFilesHTML;

                                subfolders.forEach(subfolder => {
                                    let subfolderHTML = `
                                <div class="folder" id="folder-${subfolder.id}">
                                    <div class="folder-content">
                                        <i class="folder-icon fas fa-folder"></i>
                                        <span class="folder-name">${subfolder.name}</span>
                                        <button class="expand-btn" data-folder-id="${subfolder.id}">
                                            <i class="bi bi-plus-circle toggle"></i>
                                        </button>
                                    </div>
                                    <div class="subfolder-container" id="subfolder-container-${subfolder.id}" style="display: none;"></div>
                                </div>
                            `;
                                    subfolderContainer.innerHTML += subfolderHTML;
                                });
                            } else {
                                subfolderContainer.innerHTML += `<div class="folder-content ms-4 no-subfolders">
                            <button class="expand-btn">
                                <i class="bi bi-circle-fill"></i>
                            </button>
                            <span class="folder-name">No subfolders</span>
                        </div>`;
                            }

                            attachExpandListeners();
                            subfolderContainer.setAttribute('data-loaded', 'true');
                            subfolderContainer.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Error loading subfolders:', error);
                            toggleIcon.classList.toggle('bi-plus-circle');
                            toggleIcon.classList.toggle('bi-dash-circle');
                            alert('An error occurred while loading subfolders. Please try again.');
                        });
                } else {
                    subfolderContainer.style.display = subfolderContainer.style.display === 'none' ? 'block' : 'none';
                }
            }
        }

        // Initialize event listeners on page load
        attachExpandListeners();


        document.addEventListener('click', function (event) {
            const button = event.target.closest('.expand-btn');
            const folder = event.target.closest('.folder-content'); // Detect clicks on folder (excluding expand-btn)

            // Handle folder clicks
            if (folder && !button) {
                // Get the folder ID and name
                const folderId = folder.parentElement.getAttribute('id').replace('folder-', '');
                const folderName = folder.querySelector('.folder-name').innerText;

                // Assume you have a way to get the course name
                const courseSelect = document.querySelector('#coursePath'); // Replace with your actual select element selector
                const courseName = courseSelect.options[courseSelect.selectedIndex].text;

                // Show an alert with the folder path (you can customize this with the actual path)
                Swal.fire({
                    title: 'Path Selected',
                    text: `Path selected: ${folderName}`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                $('#folderSelectModal').modal('hide');

                // Create or retrieve the hidden input for storing folder IDs
                const pathContainer = document.getElementById('choose-path');
                let pathInput = document.querySelector('input[name="path[]"]');

                if (!pathInput) {
                    // If the input doesn't exist, create it
                    pathInput = document.createElement('input');
                    pathInput.setAttribute('type', 'hidden');
                    pathInput.setAttribute('name', 'path[]'); // Use array syntax for multiple values
                    pathContainer.appendChild(pathInput); // Append to the appropriate container
                }

                // Get current value of the hidden input and split into an array
                let currentValue = pathInput.value ? pathInput.value.split(',') : [];

                // Add the new folder ID if it's not already in the array
                // Add the new folder ID if it's not already in the array
                const folderIdInt = parseInt(folderId, 10); // Convert folderId to an integer with base 10
                if (!currentValue.includes(folderIdInt)) {
                    currentValue.push(folderIdInt);
                    pathInput.value = currentValue.join(','); // Update the hidden input's value
                }

                // Update the UI to show selected folders
                const selectedFolderDiv = document.getElementById('selected-folder-info') || createSelectedFolderDiv();

                // Construct the new folder info string in the desired format
                const newFolderInfo = `${courseName} -> ${folderName}`;

                // Append the new folder info to the existing selected folders
                const existingInfo = selectedFolderDiv.innerHTML ? selectedFolderDiv.innerHTML : 'Selected Path: ';
                selectedFolderDiv.innerHTML = `
                    <p class="selected-folder">${existingInfo}${newFolderInfo}${existingInfo ? ', ' : ''}</p>
                `;
            }
        });

        // Function to create the div for displaying selected folder info (if it doesn't exist)
        function createSelectedFolderDiv() {
            const pathContainer = document.getElementById('choose-path');
            const div = document.createElement('div');
            div.setAttribute('id', 'selected-folder-info');
            pathContainer.appendChild(div); // Append this div where you want (or change 'document.body' to a specific container)
            return div;
        }
        createSelectedFolderDiv();

    });



</script>
<script>

    $(document).ready(function () {
        // Fetch courses on click
        $('#coursePath').on('click', function () {
            if ($(this).children('option').length === 0) { // Ensure only 1 default option triggers fetch
                fetchCourses();
            }
        });

        function fetchCourses() {
            $.ajax({
                url: '/live-class/allCourses',
                type: 'GET',
                success: function (response) {
                    let courseOption = "<option value=''>Select a Course</option>";
                    response.courses.forEach(course => {
                        courseOption += `<option value="${course.id}">${course.course_name}</option>`;
                    });
                    $('#coursePath').html(courseOption);
                },
                error: function (xhr) {
                    console.log('Error fetching courses ->', xhr.responseText);
                }
            });
        }

        // Fetch root folders when a course is selected
        $('#coursePath').on('change', function () {
            const selectedCourseId = $(this).val();
            if (selectedCourseId) {
                fetchRootFolders(selectedCourseId);
            }
        });

        function fetchRootFolders(courseId) {
            $.ajax({
                url: `/video-course/${courseId}/folders`, // Ensure this route exists
                type: 'GET',
                success: function (response) {
                    // Assuming response.rootFolders contains the root folders
                    populateFolderHierarchy(response.rootFolders);
                    $('#folderSelectModal').modal('show'); // Open the modal
                },
                error: function (xhr) {
                    console.log('Error fetching root folders ->', xhr.responseText);
                }
            });
        }

        function populateFolderHierarchy(rootFolders) {
            let folderHTML = '';
            rootFolders.forEach(folder => {
                folderHTML += `

                <div class="folder" id='folder-${folder.id}'>
                    <div class="folder-content">
                        <i class="folder-icon fas fa-folder"></i>
                        <span class="folder-name">${folder.name}</span>
                        <button class="expand-btn" data-folder-id= "${folder.id}">
                            <i class="bi bi-plus-circle toggle"></i>
                        </button>
                    </div>
                    <div class="subfolder-container" id="subfolder-container-${folder.id}" style="display: none;">
                        <!-- Subfolders will be loaded here via AJAX -->
                    </div>
                </div>`
            });
            $('#folderHierarchyContainer').html(folderHTML); // Make sure you have this container in your modal
        }
    });


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



    document.getElementById('isPaid').addEventListener('change', function () {
        document.getElementById('priceSection').style.display = this.checked ? 'block' : 'none';
    });

    // Category management
    class CategoryManager {
        constructor() {
            this.level0 = document.getElementById('CategoryLevel0');
            // this.level1 = document.getElementById('CategoryLevel1');
            // this.level2 = document.getElementById('CategoryLevel2');
            // this.level1Div = document.getElementById('category-level-1');
            // this.level2Div = document.getElementById('category-level-2');

            this.initEventListeners();
        }

        initEventListeners() {
            this.level0.addEventListener('change', () => this.showCategoryLevel1());
            // this.level1.addEventListener('change', () => this.showCategoryLevel2());
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
            // this.level1Div.style.display = 'block';
            // this.level2Div.style.display = 'block';

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
    // -------------------------------------------------

    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('courseList');
        const choices = new Choices(element, {
            placeholderValue: 'Select Courses',
            removeItemButton: true, // Add remove button for each selection
            maxItemCount: 5,        // Maximum number of selections
        });
    });

</script>

<script>



    $(document).ready(function () {
        var table = $('#liveclasses-table_wrapper').DataTable();

        function updateSidebarCards() {
            var data = table.rows().data();
            var now = new Date();
            var liveClasses = [];
            var upcomingClasses = [];
            console.log(data)
            data.each(function (row) {
                var startDate = new Date(row.from);
                var endDate = new Date(row.to);

                if (now >= startDate && now <= endDate) {
                    liveClasses.push(row);
                } else if (startDate > now) {
                    upcomingClasses.push(row);
                }
            });

            // Update Live Classes card
            var liveClassesHtml = liveClasses.map(function (cls) {
                return '<li>' + cls.title + ' - Ends: ' + cls.to + '</li>';
            }).join('');
            $('#liveClassesList').html(liveClassesHtml || '<li>No live classes at the moment</li>');

            // Update Upcoming Classes card
            var upcomingClassesHtml = upcomingClasses.map(function (cls) {
                return '<li>' + cls.title + ' - Starts: ' + cls.from + '</li>';
            }).join('');
            $('#upcomingClassesList').html(upcomingClassesHtml || '<li>No upcoming classes</li>');
        }

        // Update sidebar cards when DataTable is drawn
        table.on('draw', updateSidebarCards);

        // Initial update
        updateSidebarCards();
    });
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

    .dataTables_wrapper .dataTables_length select {
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

    .form-control,
    .form-select {
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
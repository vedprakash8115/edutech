<!-- resources/views/books/create.blade.php -->
@extends('layout.app')

@section('content')
{{-- <style>
    .alert-success
    {

    }
</style> --}}
<div class="container py-4">
    @if(!isset($book))
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
    {{-- <div id="responseMessage" class="alert alert-success "  style="border:none; box-shadow:0px 2px 5px black; ">Hello </div> --}}
    <div class="row justify-content-center">
        <div class="">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 text-white">{{ isset($book) ? 'Edit Book' : 'Add New Book' }}</h3>
                </div>
                <div class="card-body">
                    <form id="bookForm" action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($book))
                            @method('PUT')
                        @endif
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Book Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? old('title') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author ?? old('author') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn ?? old('isbn') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="publication_year" class="form-label">Publication Year</label>
                                <input type="number" class="form-control" id="publication_year" name="publication_year" value="{{ $book->publication_year ?? old('publication_year') }}" required>
                            </div>
                           
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $book->description ?? old('description') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="videocourse_id" class="form-label">Related Video Course</label>
                                <select class="form-select" id="videocourse_id" name="videocourse_id" required>
                                    @foreach($videoCourses as $course)
                                        <option value="{{ $course->id }}" {{ (isset($book) && $book->videocourse_id == $course->id) ? 'selected' : '' }}>
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12" data-aos="fade-up" data-aos-delay="1200">
                                <div class="mb-3">
                                    <h5 class="mb-3">Pricing</h5>
                                    <input type="hidden" name="is_paid" value="0">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="isPaid" name="is_paid" value="1" {{ old('is_paid', $book->is_paid ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isPaid">Paid Item</label>
                                    </div>
                                    <div id="priceSection" style="{{ old('is_paid', $book->is_paid ?? false) ? 'display: block;' : 'display: none;' }}">
                                        <div class="form-floating mb-3">
                                            <i class="fas fa-dollar-sign form-icon"></i>
                                            <input type="number" class="form-control" id="Price" name="price" value="{{ old('price', $book->price ?? '') }}" placeholder="Price" min="0" step="0.01">
                                            <label for="Price" class="text-secondary">Regular Price</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <i class="fas fa-tags form-icon"></i>
                                            <input type="number" class="form-control" id="DiscountPrice" name="discount_price" value="{{ old('discount_price', $book->discount_price ?? '') }}" placeholder="Discount Price" min="0" step="0.01">
                                            <label for="DiscountPrice" class="text-secondary">Discounted Price</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cover_image" class="form-label">Cover Image</label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image">
                            </div>
                            <div class="col-md-6">
                                <label for="book_file" class="form-label">Book File</label>
                                <input type="file" class="form-control" id="book_file" name="book_file">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update Book' : 'Add Book' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

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
    .card-title {
    font-size: 1.25rem;
    color: #333;
}

.form-check-label {
    font-size: 1rem;
    color: #555;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

#fileTypeSection .form-label {
    color: #333;
    font-size: 1.1rem;
}

#fileUploadSection .form-control {
    border: 2px dashed #ccc;
    padding: 1rem;
}
        </style>
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    $(document).ready(function() {
        // Toggle price section based on 'isPaid' checkbox state
        $('#isPaid').change(function() {
            $('#priceSection').toggle(this.checked);
        });

        // Handle form submission via AJAX
        $('#bookForm').submit(function(e) {
            e.preventDefault();  // Prevent the default form submission

            var formData = new FormData(this);  // Create a FormData object with the form data
            
            $.ajax({
                url: $(this).attr('action'),  // Form action URL
                type: 'POST',  // Form method type
                data: formData,  // Form data to be submitted
                processData: false,  // Prevent automatic data processing
                contentType: false,  // Prevent automatic content type selection
                success: function(response) {
                    // Show SweetAlert success toast
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // Optionally reset the form or redirect
                    // $('#bookForm')[0].reset();
                    // window.location.href = '/books';
                },
                error: function(xhr) {
    var errors = xhr.responseJSON.errors;
    var firstErrorMessage = ''; // To store the first error message

    // Get the first error message for the title
    for (var error in errors) {
        firstErrorMessage = errors[error][0]; // Assign the first error found
        break; // Exit the loop after the first error
    }

    // Show SweetAlert error toast with the first error message in the title
    Swal.fire({
        toast: true,
        icon: 'error',
        title: firstErrorMessage, // Display the first error message as the title
        position: 'top-end',
        showConfirmButton: false,
        timer: 10000
    });
}

            });
        });
    });
    
</script>

@endpush
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
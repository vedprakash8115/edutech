@extends('layout.app')

@section('content')
<div class="container-fluid elibrary-container">
    <div class="elibrary-header mb-5" >
        <h1 class="elibrary-title">E-Library</h1>
        <p class="elibrary-subtitle">Manage Your Digital Resources</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('elibrary.deleteMultiple') }}" method="POST" id="multipleDeleteForm">
        @csrf
        @method('DELETE')
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button type="submit" class="btn btn-danger" id="deleteSelected" disabled>
                    <i class="fas fa-trash-alt"></i> Delete Selected
                </button>
                <div class="btn-group ms-3" role="group" aria-label="View toggle">
                    <button type="button" class="btn btn-outline-primary active" id="tileView">
                        <i class="fas fa-th-large"></i> Tile
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="tableView">
                        <i class="fas fa-list"></i> Table
                    </button>
                </div>
                @foreach($elibraryItems as $item)
                <button type="button" class="btn btn-dark mx-3" onclick="addImage({{ $item->id }})">
                    <i class="fas fa-upload"></i> Add Files
                </button>
            @endforeach
            
                
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">Select All</label>
            </div>
        </div>

        <div id="tileViewContainer" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($elibraryItems as $item)
                @foreach($item->files as $file)
                    <div class="col" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->parent->index * 100 }}">
                        <div class="file-card">
                            <div class="file-card-header">
                                <h5 class="file-title">{{ $file->file_path }}</h5> <!-- Display file path as the title -->
                                <div class="form-check">
                                    <input class="form-check-input file-select" type="checkbox" name="files[]" value="{{ $file->id }}">
                                </div>
                            </div>
                            <div class="file-card-body">
                                <div class="file-icon">
                                    {!! getFileTypeIcon($file->file_path) !!} <!-- Display file type icon for the current file -->
                                </div>
                                <p class="file-description">{{ Str::limit($item->description, 80) }}</p> <!-- Same description for all files under the same item -->
                            </div>
                            <div class="file-card-footer">
                                <a href="{{ asset($file->file_path) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-external-link-alt"></i> Open
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
        

        <div id="tableViewContainer" class="table-responsive" style="display: none;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>File Path</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elibraryItems as $item)
                        @foreach($item->files as $file)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input file-select" type="checkbox" name="files[]" value="{{ $file->id }}">
                                    </div>
                                </td>
                                <td>{{ $file->file_path }}</td> <!-- Show file path as the title -->
                                <td>{!! getFileTypeIcon($file->file_path) !!}</td> <!-- File type icon for the current file -->
                                <td>{{ Str::limit($item->description, 80) }}</td> <!-- Same description for all rows of the same item -->
                                <td>
                                    <a href="{{ asset($file->file_path) }}" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Open
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
    </form>
</div>

<form id="imageUploadForm" style="display: none;" method="POST" action="{{ route('elibrary.uploadFiles') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image[]" id="hiddenImageInput" multiple accept="video/*">
    <input type="hidden" name="elibrary_id" id="hiddenCourseId">
</form>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

    :root {
        --primary-color: #3498db;
        --secondary-color: #080340;
        --background-color: #f4f7f6;
        --card-background: #ffffff;
        --text-color: #2c3e50;
        --border-radius: 2px;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .elibrary-container {
        padding: 3rem 0;
        /* background-color: #f8f9fa; */
    }

    .elibrary-header {
        text-align: center;
        background: rgb(4, 107, 180);
        padding: 4rem 2rem;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem;
    }

    .elibrary-title {
        color: #fff;
        font-weight: 700;
        font-size: 3.5rem;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }

    .elibrary-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        font-weight: 300;
    }

    .file-card {
        background-color: var(--card-background);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .file-card-header {
        padding: 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .file-title {
        margin: 0;
        font-weight: 600;
        color: var(--text-color);
    }

    .file-card-body {
        padding: 1.5rem;
        text-align: center;
    }

    .file-icon {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .file-description {
        color: #666;
        font-size: 0.9rem;
    }

    .file-card-footer {
        padding: 1rem 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
        text-align: right;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: darken(var(--primary-color), 10%);
        border-color: darken(var(--primary-color), 10%);
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-danger {
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table {
        background-color: var(--card-background);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .table th {
        background-color: rgba(0, 0, 0, 0.03);
        font-weight: 600;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .elibrary-title {
            font-size: 2.5rem;
        }
        .elibrary-subtitle {
            font-size: 1.1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init();

        const selectAll = document.getElementById('selectAll');
        const fileCheckboxes = document.querySelectorAll('.file-select');
        const deleteSelectedBtn = document.getElementById('deleteSelected');
        const tileViewBtn = document.getElementById('tileView');
        const tableViewBtn = document.getElementById('tableView');
        const tileViewContainer = document.getElementById('tileViewContainer');
        const tableViewContainer = document.getElementById('tableViewContainer');

        selectAll.addEventListener('change', function() {
            fileCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateDeleteButton();
        });

        fileCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        function updateDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.file-select:checked');
            deleteSelectedBtn.disabled = checkedBoxes.length === 0;
        }

        tileViewBtn.addEventListener('click', function() {
            tileViewContainer.style.display = 'flex';
            tableViewContainer.style.display = 'none';
            tileViewBtn.classList.add('active');
            tableViewBtn.classList.remove('active');
        });

        tableViewBtn.addEventListener('click', function() {
            tileViewContainer.style.display = 'none';
            tableViewContainer.style.display = 'block';
            tableViewBtn.classList.add('active');
            tileViewBtn.classList.remove('active');
        });
    });

    function addImage(elibraryId) {
        // Set the hidden elibrary_id field with the passed elibraryId
        document.getElementById('hiddenCourseId').value = elibraryId;

        // Trigger the file input click
        document.getElementById('hiddenImageInput').click();
    }

    // Submit the form when files are selected
    document.getElementById('hiddenImageInput').onchange = function() {
        // Submit the form directly
        document.getElementById('imageUploadForm').submit();
    };


//     function addImage(elibraryId) {
//     const hiddenInput = document.getElementById('hiddenImageInput');
//     const form = document.getElementById('imageUploadForm');

//     // Function to get URL parameter by name
//     function getUrlParameter(name) {
//         const regex = new RegExp('[?&]' + name + '=([^&#]*)');
//         const results = regex.exec(window.location.search);
//         return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
//     }

//     const courseId = getUrlParameter('course_id'); // Extract course_id from URL

//     document.getElementById('hiddenCourseId').value = courseId;

//     hiddenInput.click();

//     // When a file is selected, submit the form
//     hiddenInput.onchange = function() {
//         if (hiddenInput.files.length > 0) {
//             // Perform AJAX to upload image
//             const formData = new FormData(form);
//             formData.append('course_id', courseId);
//             formData.append('elibrary_id', elibraryId); // Append eLibrary ID

//             $.ajax({
//                 url: '{{ route("elibrary.uploadFiles") }}',
//                 type: 'POST',
//                 data: formData,
//                 processData: false,
//                 contentType: false,
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 success: function(response) {
//                     alert('Files uploaded successfully!');
//                     $('#elibrary-table').DataTable().ajax.reload();
//                 },
//                 error: function(response) {
//                     if(response.responseJSON && response.responseJSON.errors) {
//                         let errors = response.responseJSON.errors;
//                         let errorMessage = '';
//                         for (let field in errors) {
//                             errorMessage += errors[field].join(', ') + '\n';
//                         }
//                         alert('Upload failed:\n' + errorMessage);
//                     } else {
//                         alert('Upload failed. Please try again.');
//                     }
//                 }
//             });
//         }
//     };
// }


</script>
@endpush

@php
function getFileTypeIcon($filePath) {
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    switch (strtolower($extension)) {
        case 'pdf':
            return '<i class="fas fa-file-pdf"></i>';
        case 'doc':
        case 'docx':
            return '<i class="fas fa-file-word"></i>';
        case 'xls':
        case 'xlsx':
            return '<i class="fas fa-file-excel"></i>';
        case 'ppt':
        case 'pptx':
            return '<i class="fas fa-file-powerpoint"></i>';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            return '<i class="fas fa-file-image"></i>';
        case 'mp3':
        case 'wav':
        case 'ogg':
            return '<i class="fas fa-file-audio"></i>';
        case 'mp4':
        case 'avi':
        case 'mov':
            return '<i class="fas fa-file-video"></i>';
        default:
            return '<i class="fas fa-file"></i>';
    }
}
@endphp
@extends('layout.app')

@section('content')
<div class="container-fluid elibrary-container">
    <div class="elibrary-header mb-5">
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
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="d-flex flex-wrap align-items-center mb-3 mb-md-0">
                <button type="submit" class="btn btn-danger mb-2 mb-md-0 me-2" id="deleteSelected" disabled>
                    <i class="fas fa-trash-alt"></i> Delete Selected
                </button>
                <div class="btn-group mb-2 mb-md-0 me-2" role="group" aria-label="View toggle">
                    <button type="button" class="btn btn-outline-primary active" id="tileView">
                        <i class="fas fa-th-large"></i> Tile
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="tableView">
                        <i class="fas fa-list"></i> Table
                    </button>
                </div>
                @foreach($elibraryItems as $item)
                    <button type="button" class="btn btn-dark mb-2 mb-md-0 me-2" onclick="addImage({{ $item->id }})">
                        <i class="fas fa-upload"></i> Add Files
                    </button>
                @endforeach
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">Select All</label>
            </div>
        </div>

        <div id="tileViewContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
            @foreach($elibraryItems as $item)
                @foreach($item->files as $file)
                    <div class="col" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->parent->index * 100 }}">
                        <div class="file-card h-100">
                            <div class="file-card-header">
                                <h5 class="file-title">{{ Str::limit($file->file_path, 20) }}</h5>
                                <div class="form-check">
                                    <input class="form-check-input file-select" type="checkbox" name="files[]" value="{{ $file->id }}">
                                </div>
                            </div>
                            <div class="file-card-body">
                                <div class="file-icon">
                                    {!! getFileTypeIcon($file->file_path) !!}
                                </div>
                                <p class="file-description">{{ Str::limit($item->description, 80) }}</p>
                            </div>
                            <div class="file-card-footer">
                                <a href="{{ asset($file->file_path) }}" target="_blank" class="btn btn-primary btn-sm w-100">
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
                                <td>{{ Str::limit($file->file_path, 30) }}</td>
                                <td>{!! getFileTypeIcon($file->file_path) !!}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
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
        --border-radius: 8px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .elibrary-container {
        padding: 3rem 1rem;
    }

    .elibrary-header {
        text-align: center;
        background: linear-gradient(135deg, #046bb4, #080340);
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
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
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
        font-size: 1rem;
        word-break: break-word;
    }

    .file-card-body {
        padding: 1.5rem;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .file-icon {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .file-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .file-card-footer {
        padding: 1rem 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
        text-align: center;
    }

    .btn {
        transition: var(--transition);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
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
        .file-card-header, .file-card-body, .file-card-footer {
            padding: 1rem;
        }
        .file-icon {
            font-size: 2.5rem;
        }
    }

    @media (min-width: 2000px) {
        .container-fluid {
            max-width: 1920px;
            margin: 0 auto;
        }
        .elibrary-title {
            font-size: 4.5rem;
        }
        .elibrary-subtitle {
            font-size: 1.8rem;
        }
        .file-card {
            min-height: 300px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: true,
            duration: 800,
            offset: 100,
        });

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
        document.getElementById('hiddenCourseId').value = elibraryId;
        document.getElementById('hiddenImageInput').click();
    }

    document.getElementById('hiddenImageInput').onchange = function() {
        document.getElementById('imageUploadForm').submit();
    };
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
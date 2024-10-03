@extends('layout.app')

@section('content')
<div class="container-fluid file-manager">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-12">
            <h1 class="mb-4">
                {{ $videoCourse->course_name ?? $folder->name }} course
            </h1>


            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('folders.index', $videoCourse->id ?? $folder->video_course_id) }}">
                                    <i class="bi bi-house-door"></i> Home
                                </a>
                            </li>
                            @if(isset($breadcrumbs))
                                @foreach($breadcrumbs as $crumb)
                                    @if ($loop->last)
                                        <li class="breadcrumb-item active" aria-current="page">{{ $crumb['name'] }}</li>
                                        <!-- Corrected to use array access -->
                                    @else
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('folders.show', $crumb['id']) }}">{{ $crumb['name'] }}</a>
                                            <!-- Corrected to use array access -->
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="search-results">
                        <div class="search-bar">
                            <input type="text" id="folderSearch" placeholder="Search folders..." class="form-control">
                            <ul id="resultsList" class="list-group"></ul>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Results will appear here -->
            <!-- Display Folders -->
            <div class="folder-grid">
                @if(isset($videoCourse) && $currentRouteIsRootLevel)
                    @foreach($videoCourse->folders as $subfolder)
                        <a href="{{ route('folders.show', $subfolder->id) }}" class="folder-item">
                            <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>
                            <div class="actions">
                                <button class="" data-bs-toggle="modal" data-bs-target="#renameFolderModal"
                                    data-folder-id="{{ $subfolder->id }}" data-folder-name="{{ $subfolder->name }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="" data-bs-toggle="modal" data-bs-target="#deleteFolderModal"
                                    data-folder-id="{{ $subfolder->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <i class="bi bi-folder-fill folder-icon"></i>
                            <span>{{ $subfolder->name }}</span>
                        </a>
                    @endforeach
                @elseif(isset($folder))
                    @foreach($folder->subfolders as $subfolder)

                        <a href="{{ route('folders.show', $subfolder->id) }}" class="folder-item">
                            <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>
                            <div class="actions">
                                <button class="" data-bs-toggle="modal" data-bs-target="#renameFolderModal"
                                    data-folder-id="{{ $subfolder->id }}" data-folder-name="{{ $subfolder->name }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="" data-bs-toggle="modal" data-bs-target="#deleteFolderModal"
                                    data-folder-id="{{ $subfolder->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <i class="bi bi-folder-fill folder-icon"></i>
                            <span>{{ $subfolder->name }}</span>
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- Display Files -->
            @if(isset($folder) && !$currentRouteIsRootLevel)
                    <h3 class="mt-5 mb-3"><i class="bi bi-files me-2"></i>Files</h3>
                    <div class="file-grid">
                        @foreach($folder->files as $file)
                                    @php
                                        $fileUrl = asset($file->path); // Use asset() to generate correct public file URL
                                    @endphp
                                    @if($file->type == 'image')
                                        <!-- Use Lightbox for images -->
                                        <a href="{{ $fileUrl }}" data-lightbox="image-gallery" data-title="{{ $file->name }}" class="file-item"
                                            target="_blank">
                                            <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>

                                            <img src="{{ $fileUrl }}" alt="{{ $file->name }}" class="img-thumbnail"
                                                style="width: 70px; height: 70px; border-radius: 10px">
                                            <span>{{ $file->name }}</span>
                                            <div class="actions">
                                                <button class="rename-btn" data-bs-toggle="modal" data-bs-target="#renameFileModal"
                                                    data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @elseif($file->type == 'pdf')
                                        <!-- PDF files handled by PDF.js -->
                                        <a href="javascript:void(0);" onclick="openPDF('{{ $fileUrl }}');" class="file-item">
                                            <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>

                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <span>{{ $file->name }}</span>
                                            <div class="actions">
                                                <button class="rename-btn" data-bs-toggle="modal" data-bs-target="#renameFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @else
                                        <!-- Other files -->
                                        <a href="{{ $fileUrl }}" target="_blank" class="file-item">
                                            <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>

                                            <i class="bi bi-file-earmark"></i>
                                            <span>{{ $file->name }}</span>
                                            <div class="actions">
                                                <button class="rename-btn" data-bs-toggle="modal" data-bs-target="#renameFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @endif
                        @endforeach
                    </div>

            @else
                    <h3 class="mt-5 mb-3"><i class="bi bi-files me-2"></i>Files</h3>
                    <div class="file-grid">
                        @foreach($filesAtRoot as $file)

                                    @php
                                        $fileUrl = asset($file->path);
                                    @endphp
                                    @if($file->type == 'image')
                                        <!-- Use Lightbox for images -->
                                        <a href="{{ $fileUrl }}" data-lightbox="image-gallery" data-title="{{ $file->name }}" class="file-item">
                                        <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>

                                            <img src="{{ $fileUrl }}" alt="{{ $file->name }}" class="img-thumbnail"
                                                style="width: 100px; height: 100px; border-radius: 10px">
                                            <span>{{ $file->name }}</span>
                                            <div class="actions">
                                                <button class="rename-btn" data-bs-toggle="modal" data-bs-target="#renameFileModal"
                                                    data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @elseif($file->type == 'pdf')
                                        <!-- PDF files handled by PDF.js -->
                                        <a href="javascript:void(0);" onclick="openPDF('{{ $fileUrl }}');" class="file-item">
                                        <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>

                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <span>{{ $file->name }}</span>
                                            <div class="actions">
                                                <button class="rename-btn" data-bs-toggle="modal" data-bs-target="#renameFileModal"
                                                    data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @else
                                        <!-- Other files -->
                                        <a href="{{ $fileUrl }}" target="_blank" class="file-item">
                                        <button class="menu"><i class="bi bi-three-dots-vertical "></i></button>

                                            <i class="bi bi-file-earmark"></i>
                                            <span>{{ $file->name }}</span>
                                            <div class="actions">
                                                <button class="rename-btn" data-bs-toggle="modal" data-bs-target="#renameFileModal"
                                                    data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteFileModal"
                                                data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </a>
                                    @endif
                        @endforeach
                    </div>
            @endif

        </div>
    </div>

    <!-- Floating Action Buttons -->
    <div class="fab-container">
        <button class="fab-item" data-bs-toggle="modal" data-bs-target="#createFolderModal">
            <i class="bi bi-folder-plus"></i>
        </button>
        <button class="fab-item" data-bs-toggle="modal" data-bs-target="#uploadPdfModal">
            <i class="bi bi-file-earmark-pdf"></i>
        </button>
        <button class="fab-item" data-bs-toggle="modal" data-bs-target="#uploadVideoModal">
            <i class="bi bi-camera-video"></i>
        </button>
        <button class="fab-item" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
            <i class="bi bi-image"></i>
        </button>
        <button class="fab-main">
            <i class="bi bi-plus"></i>
        </button>
    </div>
</div>

<!-- Modals -->
@include('modals.folderModals');




</script>
<script>
    document.getElementById('folderSearch').addEventListener('input', function () {
        let query = this.value;
        let videoCourseId = {{ $videoCourse->id }}; // Assuming you have access to $videoCourse

        if (query.length > 1) {
            fetch(`/search-folders/${videoCourseId}?query=` + query)
                .then(response => response.json())
                .then(data => {
                    let resultsList = document.getElementById('resultsList');
                    resultsList.innerHTML = ''; // Clear previous results

                    data.forEach(folder => {
                        let listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');

                        // Create clickable link for the folder
                        let link = document.createElement('a');
                        link.href = `/folder/${folder.id}`; // Update with your folder route
                        link.textContent = folder.name;

                        listItem.appendChild(link);
                        resultsList.appendChild(listItem);
                    });
                });
        } else {
            document.getElementById('resultsList').innerHTML = ''; // Clear results if search term is empty
        }
    });
</script>

@push('scripts')
    <script src="{{ asset('assets/js/folder.js') }}"></script>
@endpush
@endsection
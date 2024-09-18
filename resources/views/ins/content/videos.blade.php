@extends('layout.app')

@section('content')
<div class="container-fluid video-course-container">
    <div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="card course-header mb-4" style="background: url('{{asset($videoCourse->banner)}}'); background-size:cover; background-position:center;">
                <div class="card-body text-center layering">
                    <h1 class="course-title display-4 text-white mb-2">{{ $videoCourse->course_name }}</h1>
                    <p class="course-subtitle lead text-white">Expand your knowledge with our comprehensive video lessons</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('videocourse.deleteMultiple') }}" method="POST" id="multipleDeleteForm">
        @csrf
        @method('DELETE')
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button type="submit" class="btn btn-danger" id="deleteSelected" disabled>
                <i class="bx bx-trash"></i> Delete Selected
            </button>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">Select All</label>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($videoCourse->videos as $video)
            <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card h-100 video-card">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Video {{ $loop->iteration }}</h5>
                            <div class="form-check">
                                <input class="form-check-input video-select" type="checkbox" name="videos[]" value="{{ $video->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="ratio ratio-16x9 mb-3 video-thumbnail">
                            <iframe src="{{ asset($video->video_path) }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen muted></iframe>
                        </div>
                        <h5 class="card-title text-primary">{{ $video->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($video->description, 80) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal{{ $video->id }}" type="button">
                                <i class="bx bx-play-circle"></i> Play Video
                            </button>
                            <span class="text-muted"><i class="bx bx-time"></i> {{ gmdate("H:i:s", $video->duration) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal for full-screen video -->
            <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="videoModalLabel{{ $video->id }}">{{ $video->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ asset($video->video_path) }}?autoplay=1&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>
</div>
@endsection

@push('styles')
<style>
    .video-course-container {
        background-color: #f8f9fa;
        padding: 2rem 0;
    }
    .course-header {
        /* background: linear-gradient(135deg, #3c3d54, #8f94fb); */
        /* background: #8f94fb; */
        
        border: none;
        border-radius: 0px;
    }
    .course-title {
        color: #fff;
        font-weight: 700;
    }
    .course-subtitle {
        color: rgba(255, 255, 255, 0.8);
    }
    .video-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .layering
    {
        background: #201c2aa5;
    }
    .video-thumbnail {
        border-radius: 10px;
        overflow: hidden;
    }
    .btn-primary {
        background-color: #4e54c8;
        border-color: #4e54c8;
    }
    .btn-primary:hover {
        background-color: #3a3f9e;
        border-color: #3a3f9e;
    }
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const videoCheckboxes = document.querySelectorAll('.video-select');
        const deleteSelectedBtn = document.getElementById('deleteSelected');

        selectAll.addEventListener('change', function() {
            videoCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateDeleteButton();
        });

        videoCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        function updateDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.video-select:checked');
            deleteSelectedBtn.disabled = checkedBoxes.length === 0;
        }
    });
</script>
@endpush
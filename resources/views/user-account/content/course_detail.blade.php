@extends('user-account.layout.app')
@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css"/>
<style>
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        max-width: 1200px;
    }
    h1, h2, h3 {
        font-weight: 300;
    }
    .course-banner {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
    }
    .course-title {
        font-size: 2.5rem;
        margin-top: 20px;
    }
    .course-description {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-top: 20px;
    }
    .course-meta {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .course-price {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .original-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    .discount-price {
        color: #28a745;
    }
    .course-rating {
        font-size: 1.2rem;
        color: #ffc107;
    }
    .enroll-btn {
        width: 100%;
        padding: 10px;
        font-size: 1.2rem;
    }
    .video-card {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
        height: 100%;
    }
    .video-card:hover {
        transform: translateY(-5px);
    }
    .video-thumbnail {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .video-info {
        padding: 15px;
    }
    .video-title {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 10px;
    }
    .video-duration {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .btn-watch, .btn-pdf {
        width: 100%;
        margin-top: 10px;
    }
    .modal {
        display: flex;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }
    
    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        position: relative;
        width: 80%;
        max-width: 800px;
    }
    
    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .modal-title {
        margin-bottom: 20px;
        font-size: 24px;
    }

    .video-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .video-controls select {
        padding: 5px;
    }

    .video-controls button {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .video-controls button:hover {
        background-color: #0056b3;
    }
</style>
@endpush
<div class=" my-0" style="border-radius: 0%">
    <div class="card my-0">
        <div class="card-body">
<div x-data="courseDetailApp()" x-init="init()" class=" container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <img src="{{ asset($course->banner) }}" alt="{{ $course->course_name }}" class="course-banner">
            <h1 class="course-title" x-ref="courseTitle">{{ $course->course_name }}</h1>
            <div class="course-rating">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star"></i>
                @endfor
                <span class="ms-2">5.0 (100 reviews)</span>
            </div>
            <p class="course-description" x-ref="courseDescription">{{ $course->about_course }}</p>
            
            <h2 class="mt-5">Course Content</h2>
            <div x-data="courseDetailApp()" class="row" x-ref="videoContainer">
                @if($course->videos->count())
                    @foreach($course->videos as $video)
                        <div class="col-md-6 mb-4">
                            <div class="video-card">
                                <img src="{{ asset('path/to/video/thumbnail.jpg') }}" alt="{{ $video->video_path }}" class="video-thumbnail">
                                <div class="video-info">
                                    <h3 class="video-title">{{ $video->video_path }}</h3>
                                    <p class="video-duration">
                                        <i class="fas fa-clock me-2"></i>{{ $video->duration }} minutes
                                    </p>
                                    <button class="btn btn-primary btn-watch" @click="openModal('{{ asset($video->video_path) }}')">
                                        <i class="fas fa-play me-2"></i>Watch Video
                                    </button>
                                    <button class="btn btn-secondary btn-pdf" @click="downloadPDF('{{ $video->id }}')">
                                        <i class="fas fa-file-pdf me-2"></i>View PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-dark">No Video Available</p>
                @endif
            
                <!-- Video Modal -->
                <div x-show="isModalOpen" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close" @click="closeModal()">&times;</span>
                        <h2 class="modal-title">{{ 'Video' }}</h2>
                        <div class="video-controls">
                            <select x-model="currentResolution" @change="changeResolution">
                                <option value="1080p">1080p</option>
                                <option value="720p">720p</option>
                                <option value="480p">480p</option>
                            </select>
                            {{-- <button @click="togglePlayback">{{ isPlaying ? 'Pause' : 'Play' }}</button> --}}
                        </div>
                        <iframe 
                            x-ref="videoPlayer"
                            :src="currentVideo"
                            frameborder="0"
                            allowfullscreen
                            style="width: 100%; height: 500px;">
                        </iframe>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="col-lg-4">
            <div class="course-meta">
                <div class="course-price mb-3">
                    @if($course->is_paid)
                        @if($course->discount_price)
                            <span class="original-price">${{ number_format($course->price, 2) }}</span>
                            <span class="discount-price" x-ref="discountPrice">${{ number_format($course->discount_price, 2) }}</span>
                        @else
                            ${{ number_format($course->price, 2) }}
                        @endif
                    @else
                        <span class="discount-price">Free</span>
                    @endif
                </div>
                <button class="btn btn-success enroll-btn" @click="enrollCourse">
                    <i class="fas fa-graduation-cap me-2"></i>Enroll Now
                </button>
                <hr>
                <div class="course-features">
                    <p><i class="fas fa-clock me-2"></i>Duration: {{ $course->course_duration }} hours</p>
                    <p><i class="fas fa-video me-2"></i>{{ count($course->videos) }} video lessons</p>
                    <p><i class="fas fa-certificate me-2"></i>Certificate of completion</p>
                    <p><i class="fas fa-mobile-alt me-2"></i>Access on mobile and TV</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('user-account.content.footer')
@include('user-account.content.fixed_button')
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    function courseDetailApp() {
        return {
            init() {
                this.initTooltips(); // Initialize tooltips
            },
            initTooltips() {
                tippy('[data-tippy-content]', {
                    animation: 'scale',
                    theme: 'light',
                });
            },
            watchVideo(videoId) {
                // Implement video watching logic
                console.log(`Watching video ${videoId}`);
            },
            downloadPDF(videoId) {
                // Implement PDF download logic
                console.log(`Downloading PDF for video ${videoId}`);
            },
            enrollCourse() {
                // Implement course enrollment logic
                console.log('Enrolling in the course');
            },
            isModalOpen: false,
            currentVideo: '',
            currentVideoTitle: '',
            currentResolution: '1080p', // Default resolution
            isPlaying: false, // Playback state
            
            openModal(videoPath) {
                this.currentVideo = videoPath;
                this.currentVideoTitle = videoPath.split('/').pop(); // Set title from video path
                this.isModalOpen = true;
                this.playVideo(); // Play video when modal opens
            },
            closeModal() {
                this.isModalOpen = false;
                this.currentVideo = '';
                this.currentVideoTitle = '';
                this.pauseVideo(); // Pause video when modal closes
            },
            changeResolution() {
                // Logic to change video resolution
                // For simplicity, just logging the current resolution
                console.log(`Changed video resolution to ${this.currentResolution}`);
                // Here, you can set the video source according to the selected resolution
                // e.g., this.currentVideo = getVideoUrlByResolution(this.currentResolution);
            },
            togglePlayback() {
                if (this.isPlaying) {
                    this.pauseVideo();
                } else {
                    this.playVideo();
                }
            },
            playVideo() {
                // Implement logic to play the video
                this.isPlaying = true;
                console.log('Playing video');
            },
            pauseVideo() {
                // Implement logic to pause the video
                this.isPlaying = false;
                console.log('Paused video');
            },
            downloadPDF(videoId) {
                console.log(`Downloading PDF for video ${videoId}`);
            }
        }
    }
</script>

@endpush
@endsection
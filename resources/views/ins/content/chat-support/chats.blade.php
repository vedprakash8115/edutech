@extends('layout.app')

@section('content')
<div class="courses-container">
        <div class="courses-header">
            <h1 class="mb-0 text-white"><i class="fas fa-graduation-cap me-2"></i>Chat Support</h1>
        </div>
        <div class="course-grid">
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-4">
                @forelse($videoCourses as $course)
                    <a href="{{route('chats.groups',$course->id)}}">
                        <div class="col">
                            <div class="course-item">
                                <img src="{{ $course->banner ?? '/api/placeholder/400/200' }}" alt="{{ $course->title }}" class="course-image">
                                <div class="course-content">
                                    <h5 class="course-title">{{ $course->course_name }}</h5>
                                    <p class="course-description mb-3">{{ Str::limit($course->about_course, 80) }}</p>
                                    <div class="course-meta d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="fas fa-clock me-1"></i>{{ $course->duration }} mins
                                        </span>
                                        <span class="badge badge-custom">{{ $course->category }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-film fa-3x text-muted mb-3"></i>
                        <p class="lead">No video courses available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .courses-container {
            max-width: 1200px;
            margin: 2rem auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .courses-header {
            background: linear-gradient(45deg, #3a7bd5, #00d2ff);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .course-grid {
            padding: 2rem;
        }
        .course-item {
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .course-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .course-image {
            height: 150px;
            object-fit: cover;
            width: 100%;
        }
        .course-content {
            padding: 1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .course-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        .course-description {
            font-size: 0.9rem;
            color: #666;
            flex-grow: 1;
        }
        .course-meta {
            font-size: 0.8rem;
            color: #888;
            margin-top: auto;
            padding-top: 0.5rem;
            border-top: 1px solid #e0e0e0;
        }
        .badge-custom {
            background-color: #e0f7fa;
            color: #00838f;
            font-weight: 500;
            font-size: 0.75rem;
            padding: 0.4em 0.8em;
        }
    </style>

@endsection
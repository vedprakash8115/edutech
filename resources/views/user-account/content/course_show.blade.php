@extends('user-account.layout.app')
@section('content')
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>

    .search-container {
        position: relative;
        margin-bottom: 20px;
    }
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-top: none;
        border-radius: 0 0 4px 4px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }
    .search-result-item {
        padding: 10px;
        cursor: pointer;
    }
    .search-result-item:hover {
        background-color: #f8f9fa;
    }
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        max-width: 1200px;
    }
    h1, h3 {
        font-weight: 300;
    }
    .course-card {
        perspective: 1000px;
        height: 400px;
        margin-bottom: 30px;
    }
    .course-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    .course-card:hover .course-card-inner {
        transform: rotateY(180deg);
    }
    .course-card-front, .course-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 10px;
        overflow: hidden;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .course-card-front {
        background-color: #fff;
    }
    .course-card-back {
        background-color: #fff;
        transform: rotateY(180deg);
    }
    .course-banner {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }
    .course-title {
        font-size: 1.2rem;
        margin: 10px 0;
    }
    .course-rating {
        color: #ffc107;
        margin-bottom: 10px;
    }
    .course-price {
        margin-bottom: 10px;
    }
    .original-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    .discount-price {
        font-weight: bold;
        color: #28a745;
    }
    .free-price {
        color: #28a745;
        font-weight: bold;
    }
    .btn-learn-more {
        background-color: #007bff;
        color: #fff;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .btn-learn-more:hover {
        background-color: #0056b3;
    }
    .course-description {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endpush
<div class="card my-0" style="border-radius:0%;">
<div x-data="courseApp()" class="container mt-4">
    <h1 class="mb-4">Video Courses</h1>

    <div class="search-container mb-4">
        <input type="text" x-model="searchQuery" @input="searchCourses" class="form-control" placeholder="Search courses...">
        <div class="search-results" x-show="showSearchResults">
            <template x-for="result in searchResults" :key="result.id">
                <div class="search-result-item" x-text="result.course_name" @click="selectCourse(result)"></div>
            </template>
        </div>
    </div>

    <div class="mb-4">
        <button class="btn btn-primary" @click="filterCourses('all')">
            <i class="fas fa-th-large"></i> All
        </button>
        @foreach($categories as $category)
            <button class="btn btn-outline-primary" @click="filterCourses({{ $category->id }})">
                <i class="fas fa-folder"></i> {{ $category->name }}
            </button>
        @endforeach
    </div>

    <div class="row" id="courseContainer">
        @php
            $defaultRatings = [3, 3.5, 4, 4.5, 5];
        @endphp
        @foreach($categories as $category)
            @foreach($category->videoCourses as $course)
                @php
                    $rating = $defaultRatings[array_rand($defaultRatings)];
                @endphp
                <div class="col-md-6 col-lg-4 mb-4 course-card" data-category="{{ $category->id }}">
                    <div class="course-card-inner">
                        <div class="course-card-front">
                            <img src="{{ asset($course->banner) }}" alt="{{ $course->course_name }}" class="course-banner">
                            <h3 class="course-title">{{ $course->course_name }}</h3>
                            <div class="course-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="course-price">
                                @if($course->is_paid)
                                    @if($course->price)
                                        <span class="original-price">${{ number_format($course->price, 2) }}</span>
                                    @endif
                                    <br>
                                    @if($course->discount_price)
                                        <span class="discount-price">
                                            <i class="fas fa-tags me-2"></i>Now at $<span class="typed-price" x-ref="discountPrice{{ $course->id }}">{{number_format($course->discount_price, 2)}}</span>
                                        </span>
                                    @endif
                                @else
                                    <span class="free-price"><i class="fas fa-gift me-2"></i>Free</span>
                                @endif
                            </div>
                            <a href="{{ route('courses.show', $course->id) }}
" class="btn-learn-more">
                                <i class="fas fa-graduation-cap me-2"></i>Learn More
                            </a>
                        </div>
                        <div class="course-card-back">
                            <h3 class="course-title">{{ $course->course_name }}</h3>
                            <p class="course-description">{{ $course->about_course }}</p>
                            <div class="course-price">
                                @if($course->is_paid)
                                    @if($course->price)
                                        <span class="original-price">${{ number_format($course->price, 2) }}</span>
                                    @endif
                                    <br>
                                    @if($course->discount_price)
                                        <span class="discount-price">
                                            <i class="fas fa-tags me-2"></i>Now at $<span class="typed-price" x-ref="discountPrice{{ $course->id }}Back">{{number_format($course->discount_price, 2)}}</span>
                                        </span>
                                    @endif
                                @else
                                    <span class="free-price"><i class="fas fa-gift me-2"></i>Free</span>
                                @endif
                            </div>
                            <div class="course-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <a href="{{ route('courses.show', $course->id) }}
" class="btn-learn-more">
                                <i class="fas fa-info-circle me-2"></i>More Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
</div>
@include('user-account.content.footer')
@include('user-account.content.fixed_button')
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    function courseApp() {
        return {
            searchQuery: '',
            searchResults: [],
            showSearchResults: false,
            allCourses: @json($categories->pluck('videoCourses')->flatten()),

            init() {
                this.initTyped();
            },

            initTyped() {
                document.querySelectorAll('.typed-price').forEach(el => {
                    new Typed(el, {
                        strings: [el.getAttribute('data-price')],
                        typeSpeed: 30,
                        showCursor: false
                    });
                });
            },
            filterCourses(categoryId) {
                const courses = document.getElementsByClassName('course-card');
                for (let course of courses) {
                    if (categoryId === 'all' || course.dataset.category === categoryId.toString()) {
                        course.style.display = 'block';
                    } else {
                        course.style.display = 'none';
                    }
                }
            },

            searchCourses() {
                if (this.searchQuery.length > 2) {
                    this.searchResults = this.allCourses.filter(course => 
                        course.course_name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                    this.showSearchResults = this.searchResults.length > 0;
                } else {
                    this.showSearchResults = false;
                }
            },

            selectCourse(course) {
                this.searchQuery = course.course_name;
                this.showSearchResults = false;
                this.filterCourses(course.course_category_id);
            }
        }
    }
</script>
@endpush
@endsection
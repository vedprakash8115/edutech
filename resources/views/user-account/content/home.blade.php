@extends('user-account.layout.app')
@section('content')

@push('styles')
<style>
    /* Carousel Styles */
    .carousel-container {
        max-width: 100%;
        margin: 0 auto;
        overflow: hidden;
        height: 100vh;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.05);
    }
    .carousel-item {
        height: 100vh;
        background: no-repeat center center scroll;
        background-size: cover;
        /* display: flex;
        justify-content: center;
        align-content: center;
        align-items: center; */

        
    }
    .image-container {
    position: relative;
    overflow: hidden;
}

.course-banner {
    width: 100%;
    height: auto;
    display: block;
}

@keyframes pulse {
    0% {
        transform: rotate(45deg) scale(1);
    }
    50% {
        transform: rotate(45deg) scale(1.05);
    }
    100% {
        transform: rotate(45deg) scale(1);
    }
}

.new-badge {
    position: absolute;
    top: 2px;
    right: -36px;
    /* background: linear-gradient(45deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3); */
    background: red;
    color: rgb(255, 255, 255);
    padding: 5px 40px;
    /* font-weight: bold; */
    font-size: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    z-index: 1;
    animation: pulse 2s infinite ease-in-out;
    transition: all 0.3s ease;
}

.new-badge:hover {
    transform: rotate(45deg) scale(1.1);
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

.new-badge span {
    display: block;
    transform: rotate(-45deg);
    font-size: 0.8rem;
}

@keyframes shimmer {
    0% {
        background-position: -100% 0;
    }
    100% {
        background-position: 100% 0;
    }
}

.new-badge::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: linear-gradient(
        120deg,
        rgba(255, 255, 255, 0) 30%,
        rgba(255, 255, 255, 0.8),
        rgba(255, 255, 255, 0) 70%
    );
    opacity: 0.6;
    z-index: 1;
    animation: shimmer 3s infinite;
    background-size: 200% 100%;
}
    .carousel-caption {
        /* bottom: auto; */
        top: 0%;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-content: center;
        /* align-items: center; */
        /* transform: translateY(-50%); */
        background-color: rgba(0, 0, 0, 0.3);
        /* padding: 2rem; */
        /* border-radius: 10px; */
    }
    .carousel-caption h5 {
        font-size: 2.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
    }
    .carousel-caption p {
        font-size: 1.1rem;
        /* line-height: 1.6; */
        margin-bottom: 1.5rem;
    }
    .carousel-caption .btn {
        text-transform: uppercase;
        padding: 10px 30px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.8;
    }

    /* Featured Courses Styles */
    #featured {
        background-color: #f8f9fa;
        padding: 4rem 0;
    }
    .section-title {
        font-size: 2.5rem;
        font-weight: 300;
        text-align: center;
        margin-bottom: 3rem;
        color: #333;
    }
    .course-card {
        perspective: 1000px;
        height: 450px;
        margin-bottom: 2rem;
    }
    .course-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .course-card:hover .course-card-inner {
        transform: rotateY(180deg);
    }
    .course-card-front, .course-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border-radius: 10px;
        overflow: hidden;
    }
    .course-card-front {
        background-color: #fff;
        color: #333;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .course-card-back {
        background-color: #f1f3f5;
        color: #333;
        transform: rotateY(180deg);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 1.5rem;
    }
    .course-banner {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .course-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 1rem 0;
    }
    .course-rating {
        color: #ffc107;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }
    .course-price {
        font-size: 1.2rem;
        margin: 1rem 0;
    }
    .original-price {
        text-decoration: line-through;
        color: #6c757d;
        margin-right: 0.5rem;
    }
    .discount-price {
        color: #28a745;
        font-weight: 600;
    }
    .free-price {
        color: #28a745;
        font-weight: 600;
        font-size: 1.5rem;
    }
    .course-description {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    .btn-learn-more {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        margin: 1rem;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    .btn-learn-more:hover {
        background-color: #0056b3;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .carousel-item {
            height: 50vh;
        }
        .carousel-caption h5 {
            font-size: 1.8rem;
        }
        .carousel-caption p {
            font-size: 1rem;
        }
        .section-title {
            font-size: 2rem;
        }
    }
    .card
    {
        border-radius: 2px;
        background: #ffffff3d;
        margin-bottom: 0px !important; 
    }

    @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

.parallax-section {
    position: relative;
    padding: 100px 0;
    overflow: hidden;
}

.parallax-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url({{asset('assets/img/backgrounds/ai.jpg')}});
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    filter: brightness(0.3);
    z-index: -1;
}

.section-title {
    font-size: 3rem;
    font-weight: 300;
    color: #fff;
    margin-bottom: 1.5rem;
}

.lead {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #f0f0f0;
}

.stats-row {
    margin-top: 50px;
}

.stat-item {
    text-align: center;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease-in-out;
}

.stat-item:hover {
    transform: translateY(-10px);
}

.stat-item i {
    font-size: 3rem;
    margin-bottom: 15px;
    color: #edf6ff;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.timeline {
    position: relative;
    max-width: 1200px;
    margin: 100px auto;
}

.timeline::after {
    content: '';
    position: absolute;
    width: 6px;
    background-color: #eef6ff;
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -3px;
}

.timeline-item {
    padding: 10px 40px;
    position: relative;
    background-color: inherit;
    width: 50%;
}

.timeline-item::after {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    right: -17px;
    background-color: #fafcff;
    border: 4px solid #fff;
    top: 15px;
    border-radius: 50%;
    z-index: 1;
}

.left {
    left: 0;
}

.right {
    left: 50%;
}

.left::before {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    right: 30px;
    border: medium solid #ebf5ff;
    border-width: 10px 0 10px 10px;
    border-color: transparent transparent transparent #007bff;
}

.right::before {
    content: " ";
    height: 0;
    position: absolute;
    top: 22px;
    width: 0;
    z-index: 1;
    left: 30px;
    border: medium solid #ecf5ff;
    border-width: 10px 10px 10px 0;
    border-color: transparent #007bff transparent transparent;
}

.right::after {
    left: -16px;
}

.timeline-content {
    padding: 20px 30px;
    background-color: rgba(255, 255, 255, 0.1);
    position: relative;
    border-radius: 6px;
    color: #fff;
}

.timeline-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #e7f2ff;
}

@media screen and (max-width: 600px) {
    .timeline::after {
        left: 31px;
    }

    .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
    }

    .timeline-item::before {
        left: 60px;
        border: medium solid #007bff;
        border-width: 10px 10px 10px 0;
        border-color: transparent #007bff transparent transparent;
    }

    .left::after, .right::after {
        left: 15px;
    }

    .right {
        left: 0%;
    }
}
</style>
@endpush

<!-- Carousel Section -->
<div class="" style="border-radius: 10px">
<div class="carousel-container">
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($slider as $index => $slide)
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($slider as $index => $slide)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="background-image: url('{{ asset($slide->image) }}');">
                    <div class="carousel-caption d-md-block">
                        <h5 style="font-weight:100; font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size:160px;">{{ $slide->title }}</h5>
                        <p style="font-weight:100; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:30px;">{{ $slide->description }}</p>
                        <a style="font-weight:100;" href="{{ $slide->link }}" class="btn btn-primary">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ $slide->button_name ?? 'Learn More' }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Featured Courses Section -->
<section id="featured" class="container-fluid">
    <h2 class="section-title ">
        <i class="fas fa-star text-warning me-2"></i> <p class="text-dark " style="display: inline">Featured Courses</p>
    </h2>
    <div class="row justify-content-center">
        @php
            $defaultRatings = [3, 3.5, 4, 4.5, 5];
        @endphp
   @foreach($courses as $course)
   @php
       $rating = $defaultRatings[array_rand($defaultRatings)];
       $isNew = $course->created_at->diffInDays(now()) <= 15;
   @endphp
   <div class="col-md-6 col-lg-4">
       <div class="course-card">
           <div class="course-card-inner">
               <div class="course-card-front">
                   <div class="image-container">
                       <img src="{{ asset($course->banner) }}" alt="{{ $course->title }}" class="course-banner">
                       @if($isNew)
                       <div class="new-badge">
                           <span>New</span>
                       </div>
                   @endif
                   </div>
                   <h3 class="course-title">{{ $course->title }}</h3>
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
                       @if($course->original_price === null && $course->discount_price === null)
                           <span class="free-price"><i class="fas fa-gift me-2"></i>Free</span>
                       @else
                           @if($course->price)
                               <span class="original-price">${{ number_format($course->price, 2) }}</span>
                           @endif
                           <br>
                           @if($course->discount_price)
                               <span class="discount-price">
                                   <i class="fas fa-tags me-2"></i>Now at $<span class="typed-price" data-price="{{ number_format($course->discount_price, 2) }}"></span>
                               </span>
                           @endif
                       @endif
                   </div>
                   <a href="{{ route('courses.show', $course->id) }}" class="btn-learn-more">
                       <i class="fas fa-graduation-cap me-2"></i>Learn More
                   </a>
               </div>
               <div class="course-card-back">
                   <h3 class="course-title">{{ $course->course_name }}</h3>
                   <p class="course-description">{{ $course->about_course }}</p>
                   <div class="course-price">
                       @if($course->original_price === null && $course->discount_price === null)
                           <span class="free-price"><i class="fas fa-gift me-2"></i>Free</span>
                       @else
                           @if($course->price)
                               <span class="original-price">${{ number_format($course->price, 2) }}</span>
                           @endif
                           <br>
                           @if($course->discount_price)
                               <span class="discount-price">
                                   <i class="fas fa-tags me-2"></i>Now at $<span class="typed-price" data-price="{{ number_format($course->discount_price, 2) }}"></span>
                               </span>
                           @endif
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
                   <a href="{{ route('courses.show', $course->id) }}" class="btn-learn-more">
                       <i class="fas fa-info-circle me-2"></i>More Details
                   </a>
               </div>
           </div>
       </div>
   </div>
@endforeach
    </div>

    
</section>
</div>
<section id="about" class="card parallax-section">
    <div class="parallax-bg"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="section-title mb-4 animate__animated animate__fadeInDown">About Our Institute</h2>
                <p class="lead mb-5 animate__animated animate__fadeInUp">Empowering minds, shaping futures. We are committed to providing world-class education and fostering innovation.</p>
            </div>
        </div>
        
        <div class="row stats-row justify-content-center mb-5">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-item animate__animated animate__zoomIn">
                    <i class="fas fa-user-graduate"></i>
                    <h3 class="stat-number text-dark" data-target="5000">0</h3>
                    <p>Students Enrolled</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-item animate__animated animate__zoomIn" data-delay="200">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3 class="stat-number text-dark" data-target="250">0</h3>
                    <p>Expert Faculty</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-item animate__animated animate__zoomIn" data-delay="400">
                    <i class="fas fa-flask"></i>
                    <h3 class="stat-number text-dark" data-target="50">0</h3>
                    <p>Research Labs</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-item animate__animated animate__zoomIn" data-delay="600">
                    <i class="fas fa-trophy"></i>
                    <h3 class="stat-number text-dark" data-target="100">0</h3>
                    <p>Awards Won</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="timeline">
                    <div class="timeline-item left animate__animated animate__fadeInLeft">
                        <div class="timeline-content">
                            <h3>1980</h3>
                            <p>Founded with a vision to revolutionize education</p>
                        </div>
                    </div>
                    <div class="timeline-item right animate__animated animate__fadeInRight">
                        <div class="timeline-content">
                            <h3>1995</h3>
                            <p>Expanded to include cutting-edge research facilities</p>
                        </div>
                    </div>
                    <div class="timeline-item left animate__animated animate__fadeInLeft">
                        <div class="timeline-content">
                            <h3>2010</h3>
                            <p>Launched innovative online learning programs</p>
                        </div>
                    </div>
                    <div class="timeline-item right animate__animated animate__fadeInRight">
                        <div class="timeline-content">
                            <h3>2023</h3>
                            <p>Celebrating decades of academic excellence and innovation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user-account.content.footer')
@include('user-account.content.fixed_button')


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typedElements = document.querySelectorAll('.typed-price');
        typedElements.forEach(element => {
            new Typed(element, {
                strings: [element.getAttribute('data-price')],
                typeSpeed: 150,
                backSpeed: 20,
                showCursor: false,
                loop: true
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
    // Parallax effect
    window.addEventListener('scroll', function() {
        var scrolled = window.pageYOffset;
        var parallax = document.querySelector(".parallax-bg");
        parallax.style.transform = 'translateY(' + (scrolled * 0.3) + 'px)';
    });

    // Animate statistics
    const stats = document.querySelectorAll('.stat-number');
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const increment = target / 200;
        
        function updateCount() {
            const count = parseInt(stat.innerText);
            if(count < target) {
                stat.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 10);
            } else {
                stat.innerText = target;
            }
        }
        
        updateCount();
    });

    // Animate timeline items on scroll
    const timelineItems = document.querySelectorAll('.timeline-item');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', entry.target.classList.contains('left') ? 'animate__fadeInLeft' : 'animate__fadeInRight');
            }
        });
    }, { threshold: 0.5 });

    timelineItems.forEach(item => {
        observer.observe(item);
    });
});
</script>
@endpush

@endsection
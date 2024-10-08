<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Educational Landing Page</title>
    
    <!-- CSS Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        
        .hero-section {
            height: 100vh;
            background: url({{asset('assets/img/elements/5.jpg')}}) center/cover no-repeat;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-parallax {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }
        
        .about-image-grid img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
        }
        
        .course-card {
            transition: transform 0.3s ease;
        }
        
        .course-card:hover {
            transform: scale(1.05);
        }
        
        .testimonial-section {
            overflow-x: hidden;
        }
        
        .testimonial-container {
            display: flex;
            transition: transform 0.5s ease;
        }
        
        .testimonial-card {
            flex: 0 0 300px;
            margin-right: 20px;
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            width: 2px;
            background-color: #007bff;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
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
            background-color: white;
            border: 4px solid #007bff;
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
        
        .right::after {
            left: -16px;
        }
        
        .content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
        }
        
        .video-section {
            height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
        }
        
        .parallax-gallery {
            height: 100vh;
            overflow: hidden;
            position: relative;
        }
        
        .parallax-layer {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
        
        .parallax-layer img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .faq-item {
            margin-bottom: 1rem;
        }
        
        .faq-question {
            cursor: pointer;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        
        .faq-answer {
            padding: 1rem;
            display: none;
        }
        
        .floating-cta {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .partner-logo {
            max-width: 150px;
            transition: transform 0.3s ease;
        }
        
        .partner-logo:hover {
            transform: scale(1.1);
        }
        :root {
  /* Colors */
  --white-color: #0e002f;
  --dark-color: #252525;
  --primary-color: #3b141c;
  --secondary-color: #f3961c;
  --light-pink-color: #faf4f5;
  --medium-gray-color: #ccc;
  /* Font size */
  --font-size-s: 0.9rem;
  --font-size-n: 1rem;
  --font-size-m: 1.12rem;
  --font-size-l: 1.5rem;
  --font-size-xl: 2rem;
  --font-size-xxl: 2.3rem;
  /* Font weight */
  --font-weight-normal: 400;
  --font-weight-medium: 500;
  --font-weight-semibold: 600;
  --font-weight-bold: 700;
  /* Border radius */
  --border-radius-s: 8px;
  --border-radius-m: 30px;
  --border-radius-circle: 50%;
  /* Site max width */
  --site-max-width: 1300px;
}
header {
  z-index: 5;
  width: 100%;
  /* position: fixed; */
  /* max-height: 50px; */
  background: transparent;
}
header .navbar {
  display: flex;
  padding: 20px;
  align-items: center;
  margin: 0 auto;
  justify-content: space-between;
  max-width: var(--site-max-width);
}
.navbar .nav-logo .logo-text {
  color: var(--white-color);
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-semibold);
}
.navbar .nav-menu {
  gap: 10px;
  display: flex;
}
.navbar .nav-menu .nav-link {
  padding: 10px 18px;
  color: var(--white-color);
  font-size: var(--font-size-m);
  border-radius: var(--border-radius-m);
  transition: 0.3s ease;
}
.navbar .nav-menu .nav-link:hover {
  color: var(--primary-color);
  /* background: var(--secondary-color); */
}
.navbar :where(#menu-open-button, #menu-close-button) {
  display: none;
}
/* Sticky Title and Slogan */
.sticky-title, .sticky-slogan {
  position: sticky;
  top: 20px; /* Adjust this value based on your design */
  z-index: 10;
}

/* Horizontal Scroll for Images */
.horizontal-scroll {
  white-space: nowrap;
  overflow-x: auto;
  scroll-behavior: smooth;
  display: flex;
}

.horizontal-scroll .card {
  flex: 0 0 auto;
  width: 300px; /* Set a fixed width for each card */
}

.horizontal-scroll::-webkit-scrollbar {
  display: none; /* Hide scrollbar for cleaner look */
}

/* Description Section */
.description-section {
  opacity: 0;
  transition: opacity 0.5s ease;
}

/* Centering the description */
.is-in-view .description-section {
  opacity: 1;
  transition-delay: 0.5s;
}


    </style>
</head>
<body data-scroll-container>
    {{-- <header>
        <nav class="navbar">
          <a href="#" class="nav-logo">
            <h2 class="logo-text">☕ Coffee</h2>
          </a>
          <ul class="nav-menu">
            <button id="menu-close-button" class="fas fa-times"></button>
            <li class="nav-item">
              <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="#about" class="nav-link">About</a>
            </li>
            <li class="nav-item">
              <a href="#menu" class="nav-link">Menu</a>
            </li>
            <li class="nav-item">
              <a href="#testimonials" class="nav-link">Testimonials</a>
            </li>
            <li class="nav-item">
              <a href="#gallery" class="nav-link">Gallery</a>
            </li>
            <li class="nav-item">
              <a href="#contact" class="nav-link">Contact</a>
            </li>
          </ul>
          <button id="menu-open-button" class="fas fa-bars"></button>
        </nav>
      </header> --}}
    <!-- Hero Section -->
    <section id="hero" class="hero-section d-flex align-items-center" data-scroll-section > 
        <div class="hero-parallax" data-scroll data-scroll-speed="-7"></div>
        <div class="container hero-content text-white text-center">
            <h1 class="display-1 mb-4" data-scroll data-scroll-speed="3" data-scroll-delay="0.2" data-scroll-sticky>Unlock Your Future with Quality Education</h1>
            <p class="lead mb-4" data-scroll data-scroll-speed="2" data-scroll-delay="0.4">
                <span id="typed-text" ></span>
            </p>
            <div data-scroll data-scroll-speed="1" data-scroll-delay="0.6">
                <a href="#" class="btn btn-primary btn-lg me-3">Enroll Now</a>
                <a href="#" class="btn btn-outline-light btn-lg">Discover Courses</a>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    {{-- <section id="about" class="py-5" data-scroll-section>
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2" style="font-weight: 100;">About our institution</h2>
            <div class="row">
                <div class="col-md-6" data-scroll data-scroll-speed="1">
                    <p>We are dedicated to providing high-quality education to students worldwide, empowering them to reach their full potential and make a positive impact on the world.</p>
                </div>
                <div class="col-md-6 about-image-grid" data-scroll data-scroll-speed="3">
                    <div class="row">
                        <div class="col-6"><img src="https://picsum.photos/300/200"="/api/placeholder/300/200" alt="Campus" class="img-fluid"></div>
                        <div class="col-6"><img src="https://picsum.photos/300/200"="/api/placeholder/300/200" alt="Students" class="img-fluid"></div>
                        <div class="col-6"><img src="https://picsum.photos/300/200"="/api/placeholder/300/200" alt="Library" class="img-fluid"></div>
                        <div class="col-6"><img src="https://picsum.photos/300/200"="/api/placeholder/300/200" alt="Classroom" class="img-fluid"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
<section id="about" data-scroll-section class="py-5 bg-light">
  <div class="container">
    <!-- Title Section -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <!-- Sticky Title -->
        <h2 class="display-4 fw-light text-primary mb-3 sticky-title" data-scroll data-scroll-speed="1">
          About Our Institution
        </h2>
        <!-- Sticky Slogan -->
        <p class="lead text-muted sticky-slogan" data-scroll data-scroll-speed="2">
          Empowering minds, shaping futures, and fostering innovation since 1950.
        </p>
      </div>
    </div>
    
    <!-- Horizontal Scroll Image Section -->
    <div class="row horizontal-scroll mb-5" data-scroll data-scroll-direction="horizontal">
      <div class="col-md-12 d-flex">
        <div class="card h-100 shadow-sm me-4">
          <img src="/api/placeholder/300/200" alt="Campus" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">State-of-the-art Campus</h5>
          </div>
        </div>
        <div class="card h-100 shadow-sm me-4">
          <img src="/api/placeholder/300/200" alt="Laboratory" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Advanced Laboratories</h5>
          </div>
        </div>
        <div class="card h-100 shadow-sm me-4">
          <img src="/api/placeholder/300/200" alt="Library" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Extensive Library</h5>
          </div>
        </div>
        <div class="card h-100 shadow-sm me-4">
          <img src="/api/placeholder/300/200" alt="Students" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Diverse Student Body</h5>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Description Section -->
    <div class="row justify-content-center description-section" data-scroll data-scroll-speed="2">
      <div class="col-lg-8">
        <p class="text-muted">
          Our institution is dedicated to fostering academic excellence, critical thinking, and personal growth...
        </p>
        <p class="text-muted">
          We pride ourselves on our diverse and inclusive community, bringing together minds from all walks of life...
        </p>
      </div>
    </div>
  </div>
</section>


    <!-- Courses Section -->
    <section id="courses" class="py-5 bg-light" data-scroll-section>
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2">Our Courses</h2>
            <div class="row">
                <div class="col-md-4 mb-4" data-scroll data-scroll-speed="1">
                    <div class="card course-card">
                        <img src="https://picsum.photos/300/200"="/api/placeholder/400/250" class="card-img-top" alt="Web Development">
                        <div class="card-body">
                            <h5 class="card-title">Web Development</h5>
                            <p class="card-text">Learn modern web development techniques and build responsive websites.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-scroll data-scroll-speed="2">
                    <div class="card course-card">
                        <img src="https://picsum.photos/300/200"="/api/placeholder/400/250" class="card-img-top" alt="Data Science">
                        <div class="card-body">
                            <h5 class="card-title">Data Science</h5>
                            <p class="card-text">Master data analysis, machine learning, and statistical modeling.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-scroll data-scroll-speed="3">
                    <div class="card course-card">
                        <img src="https://picsum.photos/300/200"="/api/placeholder/400/250" class="card-img-top" alt="Digital Marketing">
                        <div class="card-body">
                            <h5 class="card-title">Digital Marketing</h5>
                            <p class="card-text">Develop skills in SEO, social media marketing, and content strategy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 testimonial-section" data-scroll-section data-scroll-direction="horizontal">
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2">What Our Students Say</h2>
            <div class="testimonial-container" data-scroll data-scroll-speed="-2">
                <div class="testimonial-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"The courses here have transformed my career. I'm now working at my dream job!"</p>
                            <footer class="blockquote-footer">John Doe</footer>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"The instructors are top-notch and the curriculum is cutting-edge."</p>
                            <footer class="blockquote-footer">Jane Smith</footer>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"I've learned more in a few months here than I did in years at university."</p>
                            <footer class="blockquote-footer">Mike Johnson</footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light" data-scroll-section>
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2">Our Features</h2>
            <div class="row text-center">
                <div class="col-md-4" data-scroll data-scroll-speed="1">
                    <i class="fas fa-chalkboard-teacher feature-icon"></i>
                    <h4>Expert Faculty</h4>
                    <p>Learn from industry professionals and experienced educators.</p>
                </div>
                <div class="col-md-4" data-scroll data-scroll-speed="2">
                    <i class="fas fa-laptop-code feature-icon"></i>
                    <h4>Hands-on Projects</h4>
                    <p>Apply your knowledge through real-world projects and case studies.</p>
                </div>
                <div class="col-md-4" data-scroll data-scroll-speed="3">
                    <i class="fas fa-certificate feature-icon"></i>
                    <h4>Recognized Certifications</h4>
                    <p>Earn industry-recognized certifications upon course completion.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Journey Section -->
    <section id="journey" class="py-5" data-scroll-section>
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2">Our Journey</h2>
            <div class="timeline">
                <div class="timeline-item left" data-scroll data-scroll-speed="1">
                    <div class="content">
                        <h3>2010</h3>
                        <p>Founded with a mission to provide quality education to all.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-scroll data-scroll-speed="2">
                    <div class="content">
                        <h3>2015</h3>
                        <p>Launched our first online courses, reaching students globally.</p>
                    </div>
                </div>
                <div class="timeline-item left" data-scroll data-scroll-speed="1">
                    <div class="content">
                        <h3>2020</h3>
                        <p>Expanded our course offerings and partnered with leading tech companies.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-scroll data-scroll-speed="2">
                    <div class="content">
                        <h3>2024</h3>
                        <p>Celebrating over 1 million students enrolled worldwide!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section id="video" class="video-section" data-scroll-section>
        <video class="video-background" autoplay loop muted data-scroll data-scroll-speed="-1">
            <source src="{{asset('assets/video/a.mp4')}}" type="video/mp4" style="position:fixed; top:0% ; right:0%;  ">
        </video>
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-white text-center" data-scroll data-scroll-speed="2">
                <h2 class="mb-4">Experience Our Campus</h2>
                <a href="#" class="btn btn-primary btn-lg">Schedule a Visit</a>
            </div>
        </div>
    </section>

    <!-- Parallax Image Gallery -->
    <!-- Parallax Image Gallery -->
    <section id="gallery" class="parallax-gallery" data-scroll-section>
        <div class="parallax-layer" data-scroll data-scroll-speed="-5">
            <img src="https://picsum.photos/300/200"="/api/placeholder/1920/1080" alt="Background">
        </div>
        <div class="parallax-layer" data-scroll data-scroll-speed="-3">
            <img src="https://picsum.photos/300/200"="/api/placeholder/1600/900" alt="Middle ground">
        </div>
        <div class="parallax-layer" data-scroll data-scroll-speed="-1">
            <img src="https://picsum.photos/300/200"="/api/placeholder/1280/720" alt="Foreground">
        </div>
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-white text-center">
                <h2 class="mb-4">Our Campus Life</h2>
                <p>Experience the vibrant atmosphere of our institution</p>
            </div>
        </div>
    </section>

    <!-- Interactive FAQs Section -->
    <section id="faqs" class="py-5 bg-light" data-scroll-section>
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2">Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item" data-scroll data-scroll-speed="1">
                    <div class="faq-question">
                        <h5>What programs do you offer?</h5>
                    </div>
                    <div class="faq-answer">
                        <p>We offer a wide range of programs including Computer Science, Business Administration, Data Science, and Digital Marketing. Check our course catalog for a complete list.</p>
                    </div>
                </div>
                <div class="faq-item" data-scroll data-scroll-speed="2">
                    <div class="faq-question">
                        <h5>Are your courses accredited?</h5>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, all our courses are accredited by relevant educational bodies and industry partners, ensuring high-quality education and recognition.</p>
                    </div>
                </div>
                <div class="faq-item" data-scroll data-scroll-speed="1">
                    <div class="faq-question">
                        <h5>Do you offer online classes?</h5>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we offer both online and on-campus options for most of our courses, providing flexibility for students worldwide.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="py-5" data-scroll-section>
        <div class="container">
            <h2 class="text-center mb-5" data-scroll data-scroll-speed="2">Our Partners & Accreditations</h2>
            <div class="row align-items-center">
                <div class="col-md-3 mb-4" data-scroll data-scroll-speed="1">
                    <img src="https://picsum.photos/300/200"="/api/placeholder/200/100" alt="Partner 1" class="img-fluid partner-logo">
                </div>
                <div class="col-md-3 mb-4" data-scroll data-scroll-speed="2">
                    <img src="https://picsum.photos/300/200"="/api/placeholder/200/100" alt="Partner 2" class="img-fluid partner-logo">
                </div>
                <div class="col-md-3 mb-4" data-scroll data-scroll-speed="1">
                    <img src="https://picsum.photos/300/200"="/api/placeholder/200/100" alt="Partner 3" class="img-fluid partner-logo">
                </div>
                <div class="col-md-3 mb-4" data-scroll data-scroll-speed="2">
                    <img src="https://picsum.photos/300/200"="/api/placeholder/200/100" alt="Partner 4" class="img-fluid partner-logo">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-white py-5" data-scroll-section>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4" data-scroll data-scroll-speed="1">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Courses</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4" data-scroll data-scroll-speed="2">
                    <h5>Contact Us</h5>
                    <address>
                        123 Education St.<br>
                        Knowledge City, KN 12345<br>
                        Phone: (123) 456-7890<br>
                        Email: info@eduplatform.com
                    </address>
                </div>
                <div class="col-md-4 mb-4" data-scroll data-scroll-speed="1">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center" data-scroll data-scroll-speed="2">
                <p>&copy; 2024 EduPlatform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating CTA -->
    <div class="floating-cta">
        <button class="btn btn-primary btn-lg" id="floatingCTA">Enroll Now</button>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Locomotive Scroll
            const scroll = new LocomotiveScroll({
                el: document.querySelector('[data-scroll-container]'),
                smooth: true,
                multiplier: 1,
                lerp: 0.05
            });
            

            // Initialize Typed.js
            var typed = new Typed('#typed-text', {
                strings: ['Learn from Industry Experts', 'Gain Practical Skills', 'Advance Your Career'],
                typeSpeed: 50,
                backSpeed: 30,
                loop: true
            });

            // Initialize Tippy.js for tooltips
            tippy('[data-tippy-content]', {
                animation: 'scale',
            });

            // FAQ Accordion
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const answer = question.nextElementSibling;
                    answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Floating CTA visibility
            const floatingCTA = document.getElementById('floatingCTA');
            scroll.on('scroll', (args) => {
                if (args.scroll.y > 500) {
                    floatingCTA.style.display = 'block';
                } else {
                    floatingCTA.style.display = 'none';
                }
            });

            // Horizontal scroll for testimonials
            const testimonialContainer = document.querySelector('.testimonial-container');
            let scrollAmount = 0;
            setInterval(() => {
                scrollAmount += 1;
                if (scrollAmount >= testimonialContainer.scrollWidth / 2) {
                    scrollAmount = 0;
                }
                testimonialContainer.style.transform = `translateX(-${scrollAmount}px)`;
            }, 30);

            // Update scroll for any dynamic content changes
            scroll.update();
        });
    </script>
</body>
</html>
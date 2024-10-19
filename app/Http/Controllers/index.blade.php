
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    <title>{{ $seos->meta_title ?? 'Eductech Home' }}</title>

    
    <meta name="description" content="{{ $seos->meta_description ?? 'Default Page Description' }}">
    <meta name="copyright" content="{{ $seos->copyright ?? '' }}">
    <meta name="keywords" content="{{ $seos->meta_keywords ?? 'default, keywords' }}">
    <meta name="author" content="{{ $seos->author ?? 'Eductech' }}">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $seos->og_title ?? 'Default OG Title' }}">


    <meta property="og:type" content="{{ $seos->og_type ?? 'website' }}">
    <meta property="og:locale" content="{{ $seos->og_locale ?? 'en_US' }}">
    <meta property="og:site_name" content="{{ $seos->og_site_name ?? '' }}">
    <meta property="og:video" content="{{ $seos->og_video ?? '' }}">
    <meta property="og:description" content="{{ $seos->og_description ?? 'Default OG Description' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $seos->og_image ?? asset('default-image.jpg') }}">
   @isset($seos->schema_markup)
   <script type="application/ld+json">
    {!! $seos->schema_markup !!}
</script>
   @endisset
    

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/bootstrap.min.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/_variable.css')}}">
    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/_navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/_footer.css')}}">
    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/_components.css')}}">

    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/style.css') }}" />

  </head>

  <body>
    <!-- header -->

    <header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i>Edutech
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <div class="d-flex flex-column flex-lg-row align-items-center w-100">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                All Courses
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Web Development</a></li>
                                <li><a class="dropdown-item" href="#">Data Science</a></li>
                                <li><a class="dropdown-item" href="#">Mobile App Development</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#popularCourses"><i class="fas fa-book me-1"></i>Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#explore"><i class="fas fa-calendar-alt me-1"></i>Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#study-resources"><i class="fas fa-users me-1"></i>Study Resources</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                        <div class="search-btn me-3">
                            <input type="search" placeholder="Search courses" aria-label="Search" />
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <button class="btn-icon me-3" title="Notifications">
                            <i class="fas fa-bell"></i>
                        </button>
                        <button class="btn-icon me-3" title="Messages">
                            <i class="fas fa-envelope"></i>
                        </button>
                        <a href="{{route('login')}}" class="login-btn">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

      <!-- Sidebar Content - Only Visible on Smaller Screens -->
      <div class="sidebar" id="sidebar">
        <ul class="navbar-nav mb-2 mb-lg-0 mt-5">
          <!-- Dropdown for All Courses -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button">
              All courses <i class="fas fa-arrow-right"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li class="dropdown-item"><a href="#">Course 1</a></li>
              <li class="dropdown-item"><a href="#">Course 2</a></li>
              <li class="dropdown-item"><a href="#">Course 3</a></li>
            </ul>
          </li>
          <!-- Right-aligned Navbar Links -->
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Another Link</a></li>
        </ul>
        <!-- Login/Register Button -->
        <button class="btn login-btn" type="submit">Login/Register</button>
      </div>


      <!-- Sidebar Content - Only Visible on Smaller Screens -->
      <div class="sidebar" id="sidebar">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <!-- Dropdown for All Courses -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button">
              All courses <i class="fas fa-arrow-right"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li class="dropdown-item"><a href="#">Course 1</a></li>
              <li class="dropdown-item"><a href="#">Course 2</a></li>
              <li class="dropdown-item"><a href="#">Course 3</a></li>
            </ul>
          </li>
          <!-- Right-aligned Navbar Links -->
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Another Link</a></li>
        </ul>
        <!-- Login/Register Button -->
        <button class="btn login-btn" type="submit">Login/Register</button>
      </div>


    </header>

    <!-- header -->

    <!-- main section -->

    <!-- carousel -->

    <section id="carouselBanners">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="background-image: url('{{ asset($slider->image) }}');">
                        <div class="carousel-caption d-md-block">
                            <h5>{{ $slider->title }}</h5>
                            <p>{{ $slider->description }}</p>
                            @if ($slider->button_name && $slider->link)
                                <a href="{{ $slider->link }}" class="btn btn-primary">{{ $slider->button_name }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- carousel  -->

    <!-- hero section -->

    <section id="hero" class="hero d-flex align-items-center text-white py-5">
      <div class="container">
        <div class="row align-items-center">
          <!-- Text Section -->
          <div class="col-md-6 text-center text-md-start">
            <h1 class="display-3 fw-bold">
              Unlock Your Future with Our
              <span id="changing-word">Courses</span>
            </h1>

            <p class="lead">Join now and get a discount of 20%</p>
            <a href="#courses" class="btn btn-primary btn-lg me-2"
              >Get started</a
            >
            <a href="#discounts" class="btn btn-outline-light btn-lg"
              >Browse courses</a
            >
          </div>
          <!-- Image Section -->
          <div class="col-md-6 text-center mt-4 mt-md-0">
            <img src="{{ asset('landing_ui/assets/imgs/hero.svg')}}" alt="hero" class="img-fluid" />
          </div>
        </div>
      </div>
    </section>

    <!-- hero section  -->

    <!-- promo  -->
    <section class="stats-section py-4 bg-light">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-3">
            <i
              class="fas fa-user-graduate stat-icon"
              style="color: #bb5b5b"
            ></i>
            <h3 class="stat-number">50,000+</h3>
            <p class="stat-label">Students</p>
          </div>
          <div class="col-md-3">
            <i
              class="fas fa-chalkboard-teacher stat-icon"
              style="color: #4854ae"
            ></i>
            <h3 class="stat-number">1,500+</h3>
            <p class="stat-label">Teachers</p>
          </div>
          <div class="col-md-3">
            <i
              class="fas fa-user-tie stat-icon"
              style="color: rgb(136, 223, 37)"
            ></i>
            <h3 class="stat-number">500+</h3>
            <p class="stat-label">Experts</p>
          </div>
          <div class="col-md-3">
            <i class="fas fa-book-open stat-icon" style="color: #982d64"></i>
            <h3 class="stat-number">200+</h3>
            <p class="stat-label">Courses</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Add Font Awesome CDN link in the <head> section -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />

    <!-- promo -->

    <!-- courses  -->
    <section id="popularCourses" class="py-5">
      <div class="container">
        <h2 class="text-center mb-2">Popular Courses</h2>
        <p class="text-center mb-4">Check out some 🔥top courses</p>

        <!-- Nav Tabs for Course Categories -->
        <ul
          class="nav nav-pills mb-5 justify-content-center"
          id="courseTabs"
          role="tablist"
        >

        @foreach ($categories as $index => $category)
        <li class="nav-item" role="presentation">
            <a
                class="nav-link {{ $index === 0 ? 'active' : '' }}"
                id="category-{{ $index }}-tab"
                data-bs-toggle="tab"
                href="#category-{{ $index }}"
                role="tab"
                aria-controls="category-{{ $index }}"
                aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
            >
                {{ $category->name }}
            </a>
        </li>
        @endforeach

        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="courseTabsContent">
        @foreach ($categories as $index => $category)
            <div
                class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                id="category-{{ $index }}"
                role="tabpanel"
                aria-labelledby="category-{{ $index }}-tab"
            >
                <div class="row">
                    @foreach ($category-> videocourses as $video)
                        <div
                            class="col-md-3 mb-4 py-4"
                            data-aos="fade-up"
                            data-aos-duration="500"
                            data-aos-delay="100"
                        >
                        <div class="card fixed-height-card" data-href="{{ route('course.details', $video->id) }}" onclick="redirectToCourseDetails(this)">
                                <img
                                    src="{{ asset($video->banner) }}"
                                    class="card-img-top"
                                    alt="{{ $video->course_name }}"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->course_name }}</h5>
                                    <p class="card-text">{{ $video->about_course }}</p>
                                    <!-- Ratings -->
                                    <div class="mb-2">
                                        <span class="fw-bolder">4.5</span>
                                        <span class="text-warning"><i class="fas fa-star"></i></span>
                                        <span class="text-warning"><i class="fas fa-star"></i></span>
                                        <span class="text-warning"><i class="fas fa-star"></i></span>
                                        <span class="text-warning"><i class="fas fa-star"></i></span>
                                        <span class="text-muted"><i class="fas fa-star"></i></span>
                                    </div>
                                    <!-- Price -->
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <p class="card-text fw-bold text-success"> {{ isset($video->price) && $video->price > 0 ? '₹'.$video->price : 'Free' }}</p>
                                        <a href="#" class="btn btn-primary enroll-button">Enroll Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
        <a href="#more" class="btn btn-primary show-more"
          >Show more <i class="fas fa-arrow-right"></i
        ></a>
      </div>
    </section>

    <!-- courses  -->

    <!-- teachers  -->
    <section id="industry-experts" class="py-5">
      <div class="container">
        <h2 class="text-center">Classes Taught by Industry Experts</h2>
        <p class="text-center mb-5">
          Here, teachers are experts, and industry rock stars who are excited to
          share their knowledge, experiece and trust with you
        </p>
        <div class="row justify-content-center">
          <!-- Card 1: Teacher 1 -->
          <div
            class="col-md-3 mb-4"
            data-aos="fade-up"
            data-aos-duration="500"
            data-aos-delay="100"
          >
            <div class="card h-100 text-center teacher-card">
              <img
                src="{{ asset('landing_ui/assets/imgs/teacher1.webp')}}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Teacher 1"
                style="width: 150px; height: 150px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title">John Doe</h5>
                <p class="card-text">Senior Data Scientist</p>
                <div class="d-flex justify-content-center mb-3">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-half text-warning"></i>
                  <span class="ms-2">(4.5/5)</span>
                </div>
                <p>Courses: 12</p>
              </div>
            </div>
          </div>

          <!-- Card 2: Teacher 2 -->
          <div
            class="col-md-3 mb-4"
            data-aos="fade-up"
            data-aos-duration="500"
            data-aos-delay="150"
          >
            <div class="card h-100 text-center teacher-card">
              <img
                src="{{ asset('landing_ui/assets/imgs/teacher2.avif')}}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Teacher 2"
                style="width: 150px; height: 150px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title">Jane Smith</h5>
                <p class="card-text">UX/UI Designer</p>
                <div class="d-flex justify-content-center mb-3">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star text-warning"></i>
                  <span class="ms-2">(4.0/5)</span>
                </div>
                <p>Courses: 8</p>
              </div>
            </div>
          </div>

          <!-- Card 3: Teacher 3 -->
          <div
            class="col-md-3 mb-4"
            data-aos="fade-up"
            data-aos-duration="500"
            data-aos-delay="200"
          >
            <div class="card h-100 text-center teacher-card">
              <img
                src="{{ asset('landing_ui/assets/imgs/teacher3.jpg')}}"
                class="card-img-top rounded-circle mx-auto mt-4"
                alt="Teacher 3"
                style="width: 150px; height: 150px; object-fit: cover"
              />
              <div class="card-body">
                <h5 class="card-title">Michael Johnson</h5>
                <p class="card-text">Full Stack Developer</p>
                <div class="d-flex justify-content-center mb-3">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-half text-warning"></i>
                  <i class="bi bi-star text-warning"></i>
                  <span class="ms-2">(3.5/5)</span>
                </div>
                <p>Courses: 10</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- teachers  -->

    <!-- testimonials  -->

    <section class="testimonial-section">
        <div class="container">
            <h2 class="text-center mb-5">What Our Clients Say</h2>
            <div class="testimonial-grid">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="testimonial-header">
                        <img src="{{ $testimonial->image ?? 'https://via.placeholder.com/80' }}" alt="{{ $testimonial->user->name }}" class="testimonial-image">
                    </div>
                    <div class="testimonial-body">
                        <h5 class="testimonial-name">{{ $testimonial->user->name }}</h5>
                        <p class="testimonial-role">{{ $testimonial->role->name }}</p>
                        <p class="testimonial-text">"{{ $testimonial->description }}"</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>




    <!-- testimonials  -->

    <!-- study resources -->
    <section id="study-resources" class="py-5 bg-light">
      <div class="container text-center">
        <h2 class="fw-bold mb-4">Study Resources</h2>
        <p class="text-center mb-5">Check out amazing resources</p>

        <div class="row g-4 flex-d justify-content-center">
          <!-- Video Card -->
          <div class="col-md-3">
            <div class="card resource-card">
              <div
                class="card-background"
                style="background: url('landing_ui/assets/imgs/videos.png') center/cover"
              >
                <div class="card-hover-content">
                  <h5 class="card-title">Videos</h5>
                  <p class="card-text text-wrap">
                    Access a library of educational videos.
                  </p>
                  <a href="#video-link" class="arrow-link">
                    <i class="fas fa-arrow-right"></i>
                    <span class="arrow-text">Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- PDFs Card -->
          <div class="col-md-3">
            <div class="card resource-card">
              <div
                class="card-background"
                style="background: url('landing_ui/assets/imgs/pdfs.webp') center/cover"
              >
                <div class="card-hover-content">
                  <h5 class="card-title">PDFs</h5>
                  <p class="card-text">Download detailed pdfs.</p>
                  <a href="#video-link" class="arrow-link">
                    <i class="fas fa-arrow-right"></i>
                    <span class="arrow-text">Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Live Classes Card -->
          <div class="col-md-3">
            <div class="card resource-card">
              <div
                class="card-background"
                style="
                  background: url('landing_ui/assets/imgs/live\ classes.jpg') center/cover;
                "
              >
                <div class="card-hover-content">
                  <h5 class="card-title">Live classes</h5>
                  <p class="card-text">
                    Join live classes with expert instructors.
                  </p>
                  <a href="#video-link" class="arrow-link">
                    <i class="fas fa-arrow-right"></i>
                    <span class="arrow-text">Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- study resources  -->

    <section class="find-course-section py-5">
      <div class="container d-flex align-items-center justify-content-between">
        <div class="row">
        <!-- Left Image -->
        <div class="image-container col-md-5 justify-content-center">
          <img src="{{ asset('landing_ui/assets/imgs/04.svg')}}" alt="Learning" class="img-fluid" />
        </div>
        <!-- Right Content -->
        <div class="text-container rounded p-4 col-md-7">
          <h3 class="font-weight-bold mb-3">Let’s find the right course for you!</h3>
          <p class="text-white">
            …and achieve your learning goals. With our expert tutors, your goals are closer than ever!
          </p>
          <button class="btn mt-3">Start Learning</button>
        </div>
      </div>
    </section>


    <!-- explore section  -->
    <section id="explore" class="py-5 bg-light">
      <h2 class="fw-bold mb-4 text-center">Explore all courses</h2>

      <div class="container my-5">
        <div class="row">
          <!-- Card 1 -->
           @foreach($categories as $category)
           <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-primary text-white">
                  <i class="fas fa-laptop-code fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">{{$category -> name}}</h5>
                  <p class="card-text text-muted mb-0">{{$category -> video_courses_count}} course(s)</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>



           @endforeach
        </div>
      </div>
    </section>
    <!-- explore section  -->

    <!-- main section -->

    <!-- footer -->
    <footer class="bg-dark text-white pt-5">
      <div class="container">
        <div class="row">
          <!-- About Section -->
          <div class="col-md-3 mb-4">
            <h5>About Us</h5>
            <p>
              We offer the best online courses to help you excel in your career.
              Learn from experts at your own pace.
            </p>
            <p>&copy; 2024 EdTech. All rights reserved.</p>
          </div>

          <!-- Quick Links Section -->
          <div class="col-md-3 mb-4">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="#home" class="text-white">Home</a></li>
              <li><a href="#about" class="text-white">About Us</a></li>
              <li><a href="#courses" class="text-white">Courses</a></li>
              <li><a href="#contact" class="text-white">Contact Us</a></li>
            </ul>
          </div>

          <!-- Popular Courses Section -->
          <div class="col-md-3 mb-4">
            <h5>Popular Courses</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Web Development</a></li>
              <li><a href="#" class="text-white">Data Science</a></li>
              <li><a href="#" class="text-white">UI/UX Design</a></li>
              <li><a href="#" class="text-white">Digital Marketing</a></li>
            </ul>
          </div>

          <!-- Newsletter Section -->
          <div class="col-md-3 mb-4">
            <h5>Subscribe to our Newsletter</h5>
            <form action="#" method="post">
              <div class="input-group mb-3">
                <input
                  type="email"
                  class="form-control"
                  placeholder="Your email"
                  aria-label="Your email"
                  required
                />
                <button class="btn btn-primary" type="submit">Subscribe</button>
              </div>
            </form>
          </div>
        </div>

        <div class="row">
          <!-- Social Media Links -->
          <div class="col-md-6">
            <h5>Follow Us</h5>
            <a href="#" class="text-white me-3"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a href="#" class="text-white me-3"
              ><i class="fab fa-twitter"></i
            ></a>
            <a href="#" class="text-white me-3"
              ><i class="fab fa-linkedin-in"></i
            ></a>
            <a href="#" class="text-white me-3"
              ><i class="fab fa-instagram"></i
            ></a>
          </div>

          <!-- Contact Information -->
          <div class="col-md-6 text-md-end">
            <h5>Contact Us</h5>
            <p>Email: support@edtech.com</p>
            <p>Phone: +123 456 7890</p>
          </div>
        </div>
      </div>
      <div class="container text-center">
        <div class="row">
          <div class="col-12">
            <ul class="list-inline">
              <li class="list-inline-item"></li>
              <a href="#" class="text-white"
                >© 2024 CMP Techsseract LLP, Inc. All Rights Reserved</a
              >
              <li class="list-inline-item">
                <a href="#" class="text-white">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="{{ url('/sitemap.xml') }}" class="text-white">Sitemap</a>
              </li>
             
              <li class="list-inline-item">|</li>
              <li class="list-inline-item">
                <a href="#" class="text-white">Cookie Notice</a>
              </li>
              <li class="list-inline-item">|</li>

              <li class="list-inline-item">
                <a href="#" class="text-white">Terms of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- Back to Top Button -->
    <button id="backToTopBtn" class="btn btn-primary">
      <i class="bi bi-arrow-up"></i>
    </button>

    <!-- footer -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script src="{{ asset('landing_ui/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="{{ asset('landing_ui/assets/js/script.js')}}"></script>
    <script>
      $(document).ready(function() {
    $('.testimonial-slider').slick({
        autoplay: true,
        autoplaySpeed: 1000,
        speed: 600,
        draggable: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              }
            },
            {
                breakpoint: 575,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
            }
        ]
    });
});
    </script>
    <script>
    function redirectToCourseDetails(element) {
        window.location.href = element.getAttribute('data-href');
    }
</script>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edtech</title>

    <link rel="stylesheet" href="{{ asset('landing_ui/assets/css/bootstrap.min.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
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
        <div class="container-fluid">
          <!-- Logo -->
          <a class="navbar-brand" href="#">Logo</a>

          <!-- Search Bar -->
          <div class="d-none d-lg-flex flex-row align-items-center search-btn">
            <form class="d-flex me-auto ms-lg-3 my-2 my-lg-0">
              <input class="me-2" type="search" placeholder="Search courses" aria-label="Search" />
              <button class="btn" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
              </button>
            </form>
          </div>

          <!-- Custom Sidebar Toggle Button - Visible Only on Smaller Screens -->
          <button class="custom-toggler d-lg-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
          </button>

          <!-- Collapsible content - Visible on Larger Screens -->
          <div class="collapse navbar-collapse d-lg-flex" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('/') }}">Home</a></li>
              {{-- <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Another Link</a></li> --}}
            </ul>
            <!-- Login/Register Button -->
            <a  href="{{ route('login')}}" class="btn login-btn ms-lg-2 btn-success" type="submit">Login</a>
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
          <!-- First Slide -->
          <div class="carousel-item active">
            <img
              src="https://www.molecularproducts.com/wp-content/uploads/2017/01/placeholder-product-banner.jpg)}}"
              class="d-block w-100"
              alt="Discount Banner"
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Get 20% Off on All Courses!</h5>
              <p>Sign up now and unlock exclusive discounts.</p>
              <a href="#courses" class="btn btn-primary">Browse Courses</a>
            </div>
          </div>
          <!-- Second Slide -->
          <div class="carousel-item">
            <img
              src="https://www.molecularproducts.com/wp-content/uploads/2017/01/placeholder-product-banner.jpg)}}"
              class="d-block w-100"
              class="d-block w-100"
              alt="Latest Offer Banner"
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Special Offer: Buy 1, Get 1 Free!</h5>
              <p>Limited time offer on select courses. Don't miss out!</p>
              <a href="#offers" class="btn btn-warning">Explore Offers</a>
            </div>
          </div>
          <!-- Third Slide -->
          <div class="carousel-item">
            <img
              src="https://www.molecularproducts.com/wp-content/uploads/2017/01/placeholder-product-banner.jpg)}}"
              class="d-block w-100"
              class="d-block w-100"
              alt="Exclusive Deal Banner"
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Become a Member and Save 30%!</h5>
              <p>Exclusive discounts for premium members. Join today!</p>
              <a href="#membership" class="btn btn-success">Become a Member</a>
            </div>
          </div>
        </div>
        <!-- Carousel Controls -->
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#promoCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#promoCarousel"
          data-bs-slide="next"
        >
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
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              id="all-courses-tab"
              data-bs-toggle="pill"
              data-bs-target="#all-courses"
              type="button"
              role="tab"
              aria-controls="all-courses"
              aria-selected="true"
            >
              Machine learning
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="web-development-tab"
              data-bs-toggle="pill"
              data-bs-target="#web-development"
              type="button"
              role="tab"
              aria-controls="web-development"
              aria-selected="false"
            >
              Web Development
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="data-science-tab"
              data-bs-toggle="pill"
              data-bs-target="#data-science"
              type="button"
              role="tab"
              aria-controls="data-science"
              aria-selected="false"
            >
              Data Science
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="design-tab"
              data-bs-toggle="pill"
              data-bs-target="#design"
              type="button"
              role="tab"
              aria-controls="design"
              aria-selected="false"
            >
              Design
            </button>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="courseTabsContent">
          <!-- All Courses -->
          <div
            class="tab-pane fade show active"
            id="all-courses"
            role="tabpanel"
            aria-labelledby="all-courses-tab"
          >
            <div class="row">
              <!-- Course Card 1 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="100"
              >
                <div class="card fixed-height-card" onclick="window.location.href='./course-detail.html'">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/webdev.jpg')}}"
                    class="card-img-top"
                    alt="Course 1"
                  />
                  <div class="card-body">
                    <h5 class="card-title">
                      Complete Web Development Bootcamp
                    </h5>
                    <p class="card-text">
                      Learn HTML, CSS, JavaScript, and more.
                    </p>

                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success text-success">
                        ₹990.99
                      </p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>

              <!-- Course Card 2 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="150"
              >
                <div class="card fixed-height-card" onclick="window.location.href='/course-detail.html'">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/datascience.jpg')}}"
                    class="card-img-top"
                    alt="Course 2"
                  />
                  <div class="card-body">
                    <h5 class="card-title">
                      Data Science and Machine Learning
                    </h5>
                    <p class="card-text">
                      Master Python, data analysis, and ML algorithms.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹1250.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- Course Card 3 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="200"
              >
                <div class="card fixed-height-card" onclick="window.location.href='/course-detail.html'">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/graphicdesign.jpg')}}"
                    class="card-img-top"
                    alt="Course 3"
                  />
                  <div class="card-body">
                    <h5 class="card-title">Graphic Design for Beginners</h5>
                    <p class="card-text">
                      Learn the basics of graphic design and Adobe tools.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹799.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>

              <!-- course 4 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="200"
              >
                <div class="card fixed-height-card" onclick="window.location.href='/course-detail.html'">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/graphicdesign2.webp')}}"
                    class="card-img-top"
                    alt="Course 3"
                  />
                  <div class="card-body">
                    <h5 class="card-title">Graphic Design for Beginners</h5>
                    <p class="card-text">
                      Learn the basics of graphic design and Adobe tools.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹799.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Web Development Courses -->
          <div
            class="tab-pane fade"
            id="web-development"
            role="tabpanel"
            aria-labelledby="web-development-tab"
          >
            <div class="row">
              <!-- Course Card 1 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="100"
              >
                <div class="card fixed-height-card">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/placeholder.png')}}"
                    class="card-img-top"
                    alt="Course 4"
                  />
                  <div class="card-body">
                    <h5 class="card-title">Advanced JavaScript</h5>
                    <p class="card-text">
                      Master the advanced concepts of JavaScript.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹1350.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- Course Card 2 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="150"
              >
                <div class="card fixed-height-card">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/placeholder.png')}}"
                    class="card-img-top"
                    alt="Course 5"
                  />
                  <div class="card-body">
                    <h5 class="card-title">ReactJS Fundamentals</h5>
                    <p class="card-text">Build dynamic UIs with ReactJS.</p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹599.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Science Courses -->
          <div
            class="tab-pane fade"
            id="data-science"
            role="tabpanel"
            aria-labelledby="data-science-tab"
          >
            <div class="row">
              <!-- Course Card 1 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="100"
              >
                <div class="card fixed-height-card">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/placeholder.png')}}"
                    class="card-img-top"
                    alt="Course 6"
                  />
                  <div class="card-body">
                    <h5 class="card-title">Python for Data Science</h5>
                    <p class="card-text">
                      Learn Python and its libraries for data science.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹1599.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- Course Card 2 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="100"
              >
                <div class="card fixed-height-card">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/placeholder.png')}}"
                    class="card-img-top"
                    alt="Course 7"
                  />
                  <div class="card-body">
                    <h5 class="card-title">Machine Learning A-Z</h5>
                    <p class="card-text">
                      Master machine learning with practical projects.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹1450.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Design Courses -->
          <div
            class="tab-pane fade"
            id="design"
            role="tabpanel"
            aria-labelledby="design-tab"
          >
            <div class="row">
              <!-- Course Card 1 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="100"
              >
                <div class="card fixed-height-card">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/placeholder.png')}}"
                    class="card-img-top"
                    alt="Course 8"
                  />
                  <div class="card-body">
                    <h5 class="card-title">UI/UX Design Masterclass</h5>
                    <p class="card-text">
                      Design user-friendly interfaces with modern tools.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star-half-alt"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹99.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <!-- Course Card 2 -->
              <div
                class="col-md-3 mb-4 py-4"
                data-aos="fade-up"
                data-aos-duration="500"
                data-aos-delay="100"
              >
                <div class="card fixed-height-card">
                  <img
                    src="{{ asset('landing_ui/assets/imgs/placeholder.png')}}"
                    class="card-img-top"
                    alt="Course 9"
                  />
                  <div class="card-body">
                    <h5 class="card-title">Photoshop Essentials</h5>
                    <p class="card-text">
                      Learn the fundamentals of Photoshop for design.
                    </p>
                    <!-- Ratings -->
                    <div class="mb-2">
                      <span class="fw-bolder">4.5</span>

                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-warning"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                      <span class="text-muted"
                        ><i class="fas fa-star"></i
                      ></span>
                    </div>

                    <!-- Price -->
                    <div
                      class="d-flex flex-row justify-content-between align-items-center"
                    >
                      <p class="card-text fw-bold text-success">₹99.99</p>
                      <a href="#" class="btn btn-primary enroll-button"
                        >Enroll Now</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

    <section id="testimonials">
      <div class="container py-7 mb-5">
        <div class="row align-items-center g-xxl-6">
          <div class="col-lg-5">
            <div class="lc-block mb-3">
              <div editable="rich">
                <h2 class="fw-bold display-6">Our Testimonials</h2>
              </div>
            </div>
            <div class="lc-block mb-3">
              <div editable="rich">
                <p class="fw-light rfs-10">
                  Customers are Awesome. Check what our clients are saying about
                  us.
                </p>
              </div>
            </div>
            <div class="lc-block">
              <div editable="rich">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  et metus id ligula malesuada placerat sit amet quis enim.
                  Aliquam erat volutpat. In pellentesque scelerisque auctor.
                </p>
              </div>
            </div>
            <div class="lc-block">
              <a class="btn btn-primary" href="#" role="button">Learn More</a>
            </div>
          </div>
          <div class="col-lg-7 mb-5 mb-md-0">
            <div class="row gx-md-5 gy-5">
              <div class="col-md-6 col-xl-5 align-self-end">
                <div class="lc-block card bg-light border-0 shadow rounded-3">
                  <div class="card-body p-4 p-xxl-5">
                    <div class="lc-block position-relative">
                      <figure>
                        <blockquote class="blockquote">
                          <p editable="inline" class="mb-5">
                            <i class=""
                              >"Nunc et metus id ligula malesuada placerat sit
                              amet quis enim. Aliquam erat volutpat."</i
                            >
                          </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                          <span editable="inline" class="fw-bold"
                            >Albert M. Wyse</span
                          >
                          <cite editable="inline" title="Source Title" class=""
                            >CEO at Acme Inc</cite
                          >
                        </figcaption>
                      </figure>
                    </div>
                    <div class="lc-block position-absolute bottom-0 end-0">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="5em"
                        height="5em"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                        lc-helper="svg-icon"
                        style="opacity: 0.1"
                      >
                        <path
                          d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 align-self-end">
                <div class="lc-block card border-0 shadow rounded-3 bg-light">
                  <div class="card-body p-4 p-xxl-5">
                    <div class="lc-block position-relative">
                      <figure>
                        <blockquote class="blockquote">
                          <p editable="inline" class="mb-5">
                            <i class=""
                              >“Vivamus sagittis lacus vel augue laoreet rutrum
                              faucibus dolor auctor. Vestibulum id ligula porta
                              felis euismod semper.”
                            </i>
                          </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                          <span editable="inline" class="fw-bold"
                            >Scott N. Higbee</span
                          >
                          <cite editable="inline" title="Source Title" class=""
                            >Marketing Manager</cite
                          >
                        </figcaption>
                      </figure>
                    </div>
                    <div class="lc-block position-absolute bottom-0 end-0">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="5em"
                        height="5em"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                        lc-helper="svg-icon"
                        style="opacity: 0.1"
                      >
                        <path
                          d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-5 offset-xl-1">
                <div class="lc-block card bg-light border-0 shadow rounded-3">
                  <div class="card-body p-4 p-xxl-5">
                    <div class="lc-block position-relative">
                      <figure>
                        <blockquote class="blockquote">
                          <p editable="inline" class="mb-5">
                            <i class=""
                              >"Ut porta lacus eget nisi fermentum lobortis."</i
                            >
                          </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                          <span editable="inline" class="fw-bold"
                            >Frank M. Young</span
                          >
                          <cite editable="inline" title="Source Title"
                            >Reporter at Times</cite
                          >
                        </figcaption>
                      </figure>
                    </div>
                    <div class="lc-block position-absolute bottom-0 end-0">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="5em"
                        height="5em"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                        lc-helper="svg-icon"
                        style="opacity: 0.1"
                      >
                        <path
                          d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 align-self-start">
                <div class="lc-block card bg-light border-0 shadow rounded-3">
                  <div class="card-body p-4 p-xxl-5">
                    <div class="lc-block position-relative">
                      <figure>
                        <blockquote class="blockquote">
                          <p editable="inline" class="mb-5">
                            <i
                              >"Lorem ipsum dolor sit amet, consectetur
                              adipiscing elit. Nunc et metus id ligula malesuada
                              placerat sit amet quis enim."</i
                            >
                          </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                          <span editable="inline" class="fw-bold"
                            >Penelope R. Allen</span
                          >
                          <cite editable="inline" title="Source Title" class=""
                            >&nbsp;SEM account</cite
                          >
                        </figcaption>
                      </figure>
                    </div>
                    <div class="lc-block position-absolute bottom-0 end-0">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="5em"
                        height="5em"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                        lc-helper="svg-icon"
                        style="opacity: 0.1"
                      >
                        <path
                          d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                  <p class="card-text">
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
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-primary text-white">
                  <i class="fas fa-laptop-code fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Web Development</h5>
                  <p class="card-text text-muted mb-0">10 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 2 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-success text-white mr-3">
                  <i class="fas fa-chart-line fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Digital Marketing</h5>
                  <p class="card-text text-muted mb-0">8 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 3 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-warning text-white mr-3">
                  <i class="fas fa-database fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Data Science</h5>
                  <p class="card-text text-muted mb-0">12 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 4 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-danger text-white mr-3">
                  <i class="fas fa-bullhorn fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Public Speaking</h5>
                  <p class="card-text text-muted mb-0">5 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 5 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-info text-white mr-3">
                  <i class="fas fa-paint-brush fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Graphic Design</h5>
                  <p class="card-text text-muted mb-0">7 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 6 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-secondary text-white mr-3">
                  <i class="fas fa-network-wired fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Networking</h5>
                  <p class="card-text text-muted mb-0">6 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 7 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-dark text-white mr-3">
                  <i class="fas fa-mobile-alt fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Mobile Development</h5>
                  <p class="card-text text-muted mb-0">9 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 8 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-light text-dark mr-3">
                  <i class="fas fa-language fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Language Learning</h5>
                  <p class="card-text text-muted mb-0">15 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 9 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-primary text-white mr-3">
                  <i class="fas fa-camera fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Photography</h5>
                  <p class="card-text text-muted mb-0">4 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>

            </div>
          </div>
          <!-- Card 10 -->
          <div class="col-md-3 mb-4">
            <div class="explore-card shadow-sm rounded-lg ">
              <div class="card-body d-flex justify-content-start align-items-center">
                <div class="icon-circle bg-success text-white mr-3">
                  <i class="fas fa-book-reader fa-2x"></i>
                </div>
                <div class="ms-3">
                  <h5 class="card-title mb-1">Content Writing</h5>
                  <p class="card-text text-muted mb-0">11 Courses</p>
                </div>
              </div>
              <i class="fas fa-arrow-right explore-btn"></i>
            </div>
          </div>
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

    <script src="{{ asset('landing_ui/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="{{ asset('landing_ui/assets/js/script.js')}}"></script>
  </body>
</html>

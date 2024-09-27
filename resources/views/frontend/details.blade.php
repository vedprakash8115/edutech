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
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Another Link</a></li>
          </ul>
          <!-- Login/Register Button -->
          <a  href="{{ route('login')}}" class="btn login-btn ms-lg-2 btn-success" type="submit">Login</a>
        </div>
      </div>
    </nav>

    <!-- hero section  -->
    <div class="course-intro container my-5 p-4 shadow-sm rounded">
      <div class="row align-items-center">
        <!-- Course Description -->
        <div class="col-md-8">
          <h1 class="font-weight-bolder text-white">Digital Marketing</h1>
          <h3 class="font-weight-bold text-secondary mb-3 text-white">The Complete Digital Marketing Course</h3>
          <p class="lead text-white">
            Satisfied conveying a dependent contented he gentleman agreeable do be. Warrant private blushes removed an
            in equally totally if. Delivered dejection necessary objection do Mr prevailed. Mr feeling does chiefly
            cordial in do.
          </p>
        </div>
        


        <div class="col-md-4 text-md-right mt-4 mt-md-0">
          <button class="btn btn-outline-light btn-lg">Get started</button>

          </div>
      </div>
    </div>
  </header>

  <!-- course info  -->
  <section class="course-info">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-md-2">

          <span class="text-warning font-weight-bolder">⭐ 4.5/5.0</span>
        </div>
        <div class="col-md-2">

          <span class="text-muted">🧑🏻‍🎓 <strong>12k enrolled</strong></span>

        </div>
        <div class="col-md-2">

          <span class="text-muted">📶 <strong>All levels</strong></span>

        </div>
        <div class="col-md-2">
          <span class="text-muted">📅 <strong>Updated: 09/21</strong></span>

        </div>
        <div class="col-md-2">
          <span class="text-muted">🌐 <strong>English</strong></span>

        </div>
      </div>
    </div>
  </section>

  <!-- course-info  -->
  <main>
    <!-- detail section  -->

    <div class="course-details container my-5">
      <div class="row">
        <!-- Left Section (70%) -->
        <div class="col-md-8">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="courseTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                data-bs-target="#overview" role="tab">Overview</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum"
                href="#curriculum" role="tab">Curriculum</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor"
                href="#instructor" role="tab">Instructor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" href="#reviews"
                role="tab">Reviews</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#faqs" href="#faqs"
                role="tab">FAQs</a>
            </li>
          </ul>

          <!-- Tab Content -->
          <div class="tab-content p-3 bg-white">
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
              <h5 class="mb-3">Course Description</h5>
              <p class="mb-3">
                Welcome to the
                <strong>
                  Digital Marketing Ultimate Course Bundle - 12 Courses in 1
                  (Over 36 hours of content)</strong>
              </p>
              <p class="mb-3">
                In this practical hands-on training, you’re going to learn to
                become a digital marketing expert with this
                <strong>
                  ultimate course bundle that includes 12 digital marketing
                  courses in 1!</strong>
              </p>
              <p class="mb-3">
                If you wish to find out the skills that should be covered in a
                basic digital marketing course syllabus in India or anywhere
                around the world, then reading this blog will help. Before we
                delve into the advanced
                <strong><a href="#" class="text-reset text-decoration-underline">digital marketing course</a></strong>
                syllabus, let’s look at the scope of digital marketing and
                what the future holds.
              </p>
              <p class="mb-0">
                We focus a great deal on the understanding of behavioral
                psychology and influence triggers which are crucial for
                becoming a well rounded Digital Marketer. We understand that
                theory is important to build a solid foundation, we understand
                that theory alone isn’t going to get the job done so that’s
                why this course is packed with practical hands-on examples
                that you can follow step by step.
              </p>

              <!-- List content -->
              <h5 class="mt-4">What you’ll learn</h5>
              <ul class="list-group list-group-borderless mb-3">
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Digital
                  marketing course introduction
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Customer Life cycle
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>What is
                  Search engine optimization(SEO)
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Facebook ADS
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Facebook Messenger Chatbot
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Search
                  engine optimization tools
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Why SEO
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>URL
                  Structure
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Featured Snippet
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>SEO
                  tips and tricks
                </li>
                <li class="list-group-item h6 fw-light d-flex mb-0">
                  <i class="fas fa-check-circle text-success me-2"></i>Google
                  tag manager
                </li>
              </ul>

              <p class="mb-0">
                As it so contrasted oh estimating instrument. Size like body
                someone had. Are conduct viewing boy minutes warrant the
                expense? Tolerably behavior may admit daughters offending her
                ask own. Praise effect wishes change way and any wanted.
                Lively use looked latter regard had. Do he it part more last
                in.
              </p>
              <!-- Course detail END -->
            </div>
            <div class="tab-pane fade" id="curriculum" role="tabpanel">
              <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-1">
                    <button class="accordion-button fw-bold rounded d-sm-flex d-inline-block collapsed" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true"
                      aria-controls="collapse-1">
                      Introduction of Digital Marketing
                      <span class="small ms-0 ms-sm-2">(3 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1"
                    data-bs-parent="#accordionExample2">
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Introduction</span>
                        </div>
                        <p class="mb-0">2m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">
                            What is Digital Marketing What is Digital
                            Marketing</span>
                        </div>
                        <p class="mb-0 text-truncate">15m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Type
                            of Digital Marketing</span>
                        </div>
                        <p class="mb-0">18m 10s</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-2">
                    <button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false"
                      aria-controls="collapse-2">
                      Customer Life cycle
                      <span class="small ms-0 ms-sm-2">(4 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">What
                            is Digital Marketing</span>
                        </div>
                        <p class="mb-0">11m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">15
                            Tips for Writing Magnetic Headlines</span>
                        </div>
                        <p class="mb-0 text-truncate">25m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">How
                            to Write Like Your Customers Talk</span>
                        </div>
                        <p class="mb-0">11m 30s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <div>
                            <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fas fa-play me-0"></i>
                            </a>
                          </div>
                          <div class="row g-sm-0 align-items-center">
                            <div class="col-sm-6">
                              <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-md-400px">How to
                                Flip Features Into Benefits</span>
                            </div>
                            <div class="col-sm-6">
                              <span class="badge text-bg-orange ms-2 ms-md-0"><i
                                  class="fas fa-lock fa-fw me-1"></i>Premium</span>
                            </div>
                          </div>
                        </div>
                        <p class="mb-0 d-inline-block text-truncate w-70px w-sm-60px">
                          35m 30s
                        </p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-5">
                    <button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false"
                      aria-controls="collapse-5">
                      What is Search Engine Optimization(SEO)
                      <span class="small ms-0 ms-sm-2">(10 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-5" class="accordion-collapse collapse" aria-labelledby="heading-5"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Introduction</span>
                        </div>
                        <p class="mb-0">1m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Overview
                            of SEO</span>
                        </div>
                        <p class="mb-0 text-truncate">11m 03s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">How
                            to SEO Optimise Your Homepage</span>
                        </div>
                        <p class="mb-0">15m 00s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">How
                            to SEO Optimise Your Homepage</span>
                        </div>
                        <p class="mb-0">15m 00s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">How
                            to Write Title Tags Search Engines Love</span>
                        </div>
                        <p class="mb-0">25m 30s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">SEO
                            Keyword Planning</span>
                        </div>
                        <p class="mb-0">18m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">eCommerce
                            SEO</span>
                        </div>
                        <p class="mb-0">28m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Internal
                            and External Links</span>
                        </div>
                        <p class="mb-0">45m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Mobile
                            SEO</span>
                        </div>
                        <p class="mb-0">8m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Off-page
                            SEO</span>
                        </div>
                        <p class="mb-0">18m 10s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Measuring
                            SEO Effectiveness</span>
                        </div>
                        <p class="mb-0">35m 10s</p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-6">
                    <button class="accordion-button fw-bold collapsed rounded d-block d-sm-flex d-inline-block"
                      type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false"
                      aria-controls="collapse-6">
                      Facebook ADS
                      <span class="small ms-0 ms-sm-2">(3 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-6" class="accordion-collapse collapse" aria-labelledby="heading-6"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Introduction</span>
                        </div>
                        <p class="mb-0">1m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Creating
                            Facebook Pages</span>
                        </div>
                        <p class="mb-0 text-truncate">25m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Facebook
                            Page Custom URL</span>
                        </div>
                        <p class="mb-0">11m 30s</p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-7">
                    <button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-7" aria-expanded="false"
                      aria-controls="collapse-7">
                      YouTube Marketing
                      <span class="small ms-0 ms-sm-2">(5 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-7" class="accordion-collapse collapse" aria-labelledby="heading-7"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Video
                            Flow</span>
                        </div>
                        <p class="mb-0">25m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Webmaster
                            Tool</span>
                        </div>
                        <p class="mb-0 text-truncate">15m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Featured
                            Contents on Channel</span>
                        </div>
                        <p class="mb-0">32m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <div>
                            <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fas fa-play me-0"></i>
                            </a>
                          </div>
                          <div class="row g-sm-0 align-items-center">
                            <div class="col-sm-6">
                              <span
                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-md-400px">Managing
                                Comments</span>
                            </div>
                            <div class="col-sm-6">
                              <span class="badge text-bg-orange ms-2 ms-md-0"><i
                                  class="fas fa-lock fa-fw me-1"></i>Premium</span>
                            </div>
                          </div>
                        </div>
                        <p class="mb-0 d-inline-block text-truncate w-70px w-sm-60px">
                          20m 20s
                        </p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <div>
                            <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fas fa-play me-0"></i>
                            </a>
                          </div>
                          <div class="row g-sm-0 align-items-center">
                            <div class="col-sm-6">
                              <span
                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-md-400px">Channel
                                Analytics</span>
                            </div>
                            <div class="col-sm-6">
                              <span class="badge text-bg-orange ms-2 ms-md-0"><i
                                  class="fas fa-lock fa-fw me-1"></i>Premium</span>
                            </div>
                          </div>
                        </div>
                        <p class="mb-0 d-inline-block text-truncate w-70px w-sm-60px">
                          18m 20s
                        </p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-8">
                    <button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-8" aria-expanded="false"
                      aria-controls="collapse-8">
                      Why SEO
                      <span class="small ms-0 ms-sm-2">(8 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-8" class="accordion-collapse collapse" aria-labelledby="heading-8"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Understanding
                            SEO</span>
                        </div>
                        <p class="mb-0">20m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">On-Page
                            SEO</span>
                        </div>
                        <p class="mb-0 text-truncate">15m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Local
                            SEO</span>
                        </div>
                        <p class="mb-0">16m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Measuring
                            SEO Effectiveness</span>
                        </div>
                        <p class="mb-0">12m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <div>
                            <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fas fa-play me-0"></i>
                            </a>
                          </div>
                          <div class="row g-sm-0 align-items-center">
                            <div class="col-sm-6">
                              <span
                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-md-400px">Keywords
                                in Blog and Articles</span>
                            </div>
                            <div class="col-sm-6">
                              <span class="badge text-bg-orange ms-2 ms-md-0"><i
                                  class="fas fa-lock fa-fw me-1"></i>Premium</span>
                            </div>
                          </div>
                        </div>
                        <p class="mb-0 d-inline-block text-truncate w-70px w-sm-60px">
                          15m 20s
                        </p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <div>
                            <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fas fa-play me-0"></i>
                            </a>
                          </div>
                          <div class="row g-sm-0 align-items-center">
                            <div class="col-sm-6">
                              <span class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-md-400px">SEO
                                Keyword Planning</span>
                            </div>
                            <div class="col-sm-6">
                              <span class="badge text-bg-orange ms-2 ms-md-0"><i
                                  class="fas fa-lock fa-fw me-1"></i>Premium</span>
                            </div>
                          </div>
                        </div>
                        <p class="mb-0 d-inline-block text-truncate w-70px w-sm-60px">
                          36m 12s
                        </p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-3">
                  <h6 class="accordion-header font-base" id="heading-9">
                    <button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-9" aria-expanded="false"
                      aria-controls="collapse-9">
                      Google tag manager
                      <span class="small ms-0 ms-sm-2">(4 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-9" class="accordion-collapse collapse" aria-labelledby="heading-9"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">G+
                            Pages Ranks Higher</span>
                        </div>
                        <p class="mb-0">13m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Adding
                            Contact Links</span>
                        </div>
                        <p class="mb-0 text-truncate">7m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Google
                            Hangouts</span>
                        </div>
                        <p class="mb-0">12m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">
                            Google Local Business</span>
                        </div>
                        <p class="mb-0 text-truncate">7m 20s</p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>

                <!-- Item -->
                <div class="accordion-item mb-0">
                  <h6 class="accordion-header font-base" id="heading-10">
                    <button class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapse-10" aria-expanded="false"
                      aria-controls="collapse-10">
                      Integration with Website
                      <span class="small ms-0 ms-sm-2">(3 Lectures)</span>
                    </button>
                  </h6>
                  <div id="collapse-10" class="accordion-collapse collapse" aria-labelledby="heading-10"
                    data-bs-parent="#accordionExample2">
                    <!-- Accordion body START -->
                    <div class="accordion-body mt-3">
                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Creating
                            LinkedIn Account</span>
                        </div>
                        <p class="mb-0 text-truncate">13m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">Advance
                            Searching</span>
                        </div>
                        <p class="mb-0">31m 20s</p>
                      </div>

                      <hr />
                      <!-- Divider -->

                      <!-- Course lecture -->
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="position-relative d-flex align-items-center">
                          <a href="#" class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
                            <i class="fas fa-play me-0"></i>
                          </a>
                          <span
                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px">LinkedIn
                            Mobile App</span>
                        </div>
                        <p class="mb-0 text-truncate">25m 20s</p>
                      </div>
                    </div>
                    <!-- Accordion body END -->
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="instructor" role="tabpanel">
              <div class="card mb-0 mb-md-4">
                <div class="row g-0 align-items-center">
                  <div class="col-md-5">
                    <!-- Image -->
                    <img src="assets/imgs/teacher2.avif" class="img-fluid rounded-3" alt="instructor-image" />
                  </div>
                  <div class="col-md-7">
                    <!-- Card body -->
                    <div class="card-body">
                      <!-- Title -->
                      <h3 class="card-title mb-0">Louis Ferguson</h3>
                      <p class="mb-2">Instructor of Marketing</p>
                      <!-- Social button -->
                      <ul class="list-inline mb-3">
                        <li class="list-inline-item me-3">
                          <a href="#" class="fs-5 text-twitter"><i class="fab fa-twitter-square"></i></a>
                        </li>
                        <li class="list-inline-item me-3">
                          <a href="#" class="fs-5 text-instagram"><i class="fab fa-instagram-square"></i></a>
                        </li>
                        <li class="list-inline-item me-3">
                          <a href="#" class="fs-5 text-facebook"><i class="fab fa-facebook-square"></i></a>
                        </li>
                        <li class="list-inline-item me-3">
                          <a href="#" class="fs-5 text-linkedin"><i class="fab fa-linkedin"></i></a>
                        </li>
                        <li class="list-inline-item">
                          <a href="#" class="fs-5 text-youtube"><i class="fab fa-youtube-square"></i></a>
                        </li>
                      </ul>

                      <!-- Info -->
                      <ul class="list-inline">
                        <li class="list-inline-item">
                          <div class="d-flex align-items-center me-3 mb-2">
                            <span class="icon-md"><i
                                class="fas fa-user-graduate"></i></span>
                            <span class="h6 fw-light mb-0 ms-2">9.1k</span>
                          </div>
                        </li>
                        <li class="list-inline-item">
                          <div class="d-flex align-items-center me-3 mb-2">
                            <span class="icon-md"><i
                                class="fas fa-star"></i></span>
                            <span class="h6 fw-light mb-0 ms-2">4.5</span>
                          </div>
                        </li>
                        <li class="list-inline-item">
                          <div class="d-flex align-items-center me-3 mb-2">
                            <span class="icon-md "><i
                                class="fas fa-play"></i></span>
                            <span class="h6 fw-light mb-0 ms-2">29 Courses</span>
                          </div>
                        </li>
                        <li class="list-inline-item">
                          <div class="d-flex align-items-center me-3 mb-2">
                            <span class="icon-md"><i
                                class="fas fa-comment-dots"></i></span>
                            <span class="h6 fw-light mb-0 ms-2">205</span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card END -->

              <!-- Instructor info -->
              <h5 class="mb-3">About Instructor</h5>
              <p class="mb-3">
                Fulfilled direction use continual set him propriety continued.
                Saw met applauded favorite deficient engrossed concealed and
                her. Concluded boy perpetual old supposing. Farther related
                bed and passage comfort civilly. Dashboard see frankness
                objection abilities. As hastened oh produced prospect formerly
                up am. Placing forming nay looking old married few has.
                Margaret disposed of add screened rendered six say his
                striking confined.
              </p>
              <p class="mb-3">
                As it so contrasted oh estimating instrument. Size like body
                someone had. Are conduct viewing boy minutes warrant the
                expense? Tolerably behavior may admit daughters offending her
                ask own. Praise effect wishes change way and any wanted.
              </p>
              <!-- Email address -->
              <div class="col-12">
                <ul class="list-group list-group-borderless mb-0">
                  <li class="list-group-item pb-0">
                    Mail ID:<a href="#" class="ms-2">hello@email.com</a>
                  </li>
                  <li class="list-group-item pb-0">
                    Web:<a href="#" class="ms-2">https://eduport.com</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel">
              <div class="row mb-4">
                <h5 class="mb-4">Our Student Reviews</h5>

                <!-- Rating info -->
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="text-center">
                    <!-- Info -->
                    <h2 class="mb-0">4.5</h2>
                    <!-- Star -->
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item me-0">
                        <i class="fas fa-star text-warning"></i>
                      </li>
                      <li class="list-inline-item me-0">
                        <i class="fas fa-star text-warning"></i>
                      </li>
                      <li class="list-inline-item me-0">
                        <i class="fas fa-star text-warning"></i>
                      </li>
                      <li class="list-inline-item me-0">
                        <i class="fas fa-star text-warning"></i>
                      </li>
                      <li class="list-inline-item me-0">
                        <i class="fas fa-star-half-alt text-warning"></i>
                      </li>
                    </ul>
                    <p class="mb-0">(Based on todays review)</p>
                  </div>
                </div>

                <!-- Progress-bar and star -->
                <div class="col-md-8">
                  <div class="row align-items-center">
                    <!-- Progress bar and Rating -->
                    <div class="col-6 col-sm-8">
                      <!-- Progress item -->
                      <div class="progress progress-sm bg-warning bg-opacity-15">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>

                    <div class="col-6 col-sm-4">
                      <!-- Star item -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>

                    <!-- Progress bar and Rating -->
                    <div class="col-6 col-sm-8">
                      <!-- Progress item -->
                      <div class="progress progress-sm bg-opacity-15">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>

                    <div class="col-6 col-sm-4">
                      <!-- Star item -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>

                    <!-- Progress bar and Rating -->
                    <div class="col-6 col-sm-8">
                      <!-- Progress item -->
                      <div class="progress progress-sm bg-opacity-15">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>

                    <div class="col-6 col-sm-4">
                      <!-- Star item -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>

                    <!-- Progress bar and Rating -->
                    <div class="col-6 col-sm-8">
                      <!-- Progress item -->
                      <div class="progress progress-sm bg-opacity-15">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>

                    <div class="col-6 col-sm-4">
                      <!-- Star item -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>

                    <!-- Progress bar and Rating -->
                    <div class="col-6 col-sm-8">
                      <!-- Progress item -->
                      <div class="progress progress-sm bg-opacity-15">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>

                    <div class="col-6 col-sm-4">
                      <!-- Star item -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0 small">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0 small">
                          <i class="far fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Review END -->

              <!-- Student review START -->
              <div class="row">
                <!-- Review item START -->
                <div class="d-md-flex my-4">
                  <!-- Avatar -->
                  <div class="avatar avatar-xl me-4 flex-shrink-0">
                    <img class="avatar-img rounded-circle" src="assets/imgs/avatar.jpg" alt="avatar" />
                  </div>
                  <!-- Text -->
                  <div>
                    <div class="d-sm-flex mt-1 mt-md-0 align-items-center">
                      <h5 class="me-3 mb-0">Jacqueline Miller</h5>
                      <!-- Review star -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="far fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>
                    <!-- Info -->
                    <p class="small mb-2">2 days ago</p>
                    <p class="mb-2">
                      Perceived end knowledge certainly day sweetness why
                      cordially. Ask a quick six seven offer see among.
                      Handsome met debating sir dwelling age material. As
                      style lived he worse dried. Offered related so visitors
                      we private removed. Moderate do subjects to distance.
                    </p>
                    <!-- Like and dislike button -->
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                      <!-- Like button -->
                      <input type="radio" class="btn-check" name="btnradio" id="btnradio1" />
                      <label class="btn btn-outline-light btn-sm mb-0" for="btnradio1"><i
                          class="far fa-thumbs-up me-1"></i>25</label>
                      <!-- Dislike button -->
                      <input type="radio" class="btn-check" name="btnradio" id="btnradio2" />
                      <label class="btn btn-outline-light btn-sm mb-0" for="btnradio2">
                        <i class="far fa-thumbs-down me-1"></i>2</label>
                    </div>
                  </div>
                </div>

                <!-- Comment children level 1 -->
                <div class="d-md-flex mb-4 ps-4 ps-md-5">
                  <!-- Avatar -->
                  <div class="avatar avatar-lg me-4 flex-shrink-0">
                    <img class="avatar-img rounded-circle" src="assets/imgs/avatar.jpg" alt="avatar" />
                  </div>
                  <!-- Text -->
                  <div>
                    <div class="d-sm-flex mt-1 mt-md-0 align-items-center">
                      <h5 class="me-3 mb-0">Louis Ferguson</h5>
                    </div>
                    <!-- Info -->
                    <p class="small mb-2">1 days ago</p>
                    <p class="mb-2">
                      Water timed folly right aware if oh truth. Imprudence
                      attachment him for sympathize. Large above be to means.
                      Dashwood does provide stronger is. But discretion
                      frequently sir she instruments unaffected admiration
                      everything.
                    </p>
                  </div>
                </div>

                <!-- Divider -->
                <hr />
                <!-- Review item END -->

                <!-- Review item START -->
                <div class="d-md-flex my-4">
                  <!-- Avatar -->
                  <div class="avatar avatar-xl me-4 flex-shrink-0">
                    <img class="avatar-img rounded-circle" src="assets/imgs/avatar.jpg" alt="avatar" />
                  </div>
                  <!-- Text -->
                  <div>
                    <div class="d-sm-flex mt-1 mt-md-0 align-items-center">
                      <h5 class="me-3 mb-0">Dennis Barrett</h5>
                      <!-- Review star -->
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="fas fa-star text-warning"></i>
                        </li>
                        <li class="list-inline-item me-0">
                          <i class="far fa-star text-warning"></i>
                        </li>
                      </ul>
                    </div>
                    <!-- Info -->
                    <p class="small mb-2">2 days ago</p>
                    <p class="mb-2">
                      Handsome met debating sir dwelling age material. As
                      style lived he worse dried. Offered related so visitors
                      we private removed. Moderate do subjects to distance.
                    </p>
                    <!-- Like and dislike button -->
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                      <!-- Like button -->
                      <input type="radio" class="btn-check" name="btnradio" id="btnradio3" />
                      <label class="btn btn-outline-light btn-sm mb-0" for="btnradio3"><i
                          class="far fa-thumbs-up me-1"></i>25</label>
                      <!-- Dislike button -->
                      <input type="radio" class="btn-check" name="btnradio" id="btnradio4" />
                      <label class="btn btn-outline-light btn-sm mb-0" for="btnradio4">
                        <i class="far fa-thumbs-down me-1"></i>2</label>
                    </div>
                  </div>
                </div>
                <!-- Review item END -->
                <!-- Divider -->
                <hr />
              </div>
              <!-- Student review END -->

              <!-- Leave Review START -->
              <div class="mt-2">
                <h5 class="mb-4">Leave a Review</h5>
                <form class="row g-3">
                  <!-- Name -->
                  <div class="col-md-6 bg-light-input">
                    <input type="text" class="form-control" id="inputtext" placeholder="Name" aria-label="First name" />
                  </div>
                  <!-- Email -->
                  <div class="col-md-6 bg-light-input">
                    <input type="email" class="form-control" placeholder="Email" id="inputEmail4" />
                  </div>
                  <!-- Rating -->
                  <div class="col-12 bg-light-input">
                    <select id="inputState2" class="form-select js-choice">
                      <option selected="">★★★★★ (5/5)</option>
                      <option>★★★★☆ (4/5)</option>
                      <option>★★★☆☆ (3/5)</option>
                      <option>★★☆☆☆ (2/5)</option>
                      <option>★☆☆☆☆ (1/5)</option>
                    </select>
                  </div>
                  <!-- Message -->
                  <div class="col-12 bg-light-input">
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Your review"
                      rows="3"></textarea>
                  </div>
                  <!-- Button -->
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mb-0">
                      Post Review
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="faqs" role="tabpanel">
              <h5 class="mb-3">Frequently Asked Questions</h5>
              <!-- Accordion START -->
              <div class="accordion accordion-flush" id="accordionExample">
                <!-- Item -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span class="text-secondary fw-bold me-3">01</span>
                      <span class="h6 mb-0">How Digital Marketing Work?</span>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body pt-0">
                      Comfort reached gay perhaps chamber his six detract
                      besides add. Moonlight newspaper up its enjoyment
                      agreeable depending. Timed voice share led him to widen
                      noisy young. At weddings believed laughing although the
                      material does the exercise of. Up attempt offered ye
                      civilly so sitting to. She new course gets living within
                      Elinor joy. She rapturous suffering concealed.
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <span class="text-secondary fw-bold me-3">02</span>
                      <span class="h6 mb-0">What is SEO?</span>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body pt-0">
                      Pleasure and so read the was hope entire first decided
                      the so must have as on was want up of I will rival in
                      came this touched got a physics to travelling so all
                      especially refinement monstrous desk they was arrange
                      the overall helplessly out of particularly ill are
                      purer.
                      <p class="mt-2">
                        Person she control of to beginnings view looked eyes
                        Than continues its and because and given and shown
                        creating curiously to more in are man were smaller by
                        we instead the these sighed Avoid in the sufficient me
                        real man longer of his how her for countries to brains
                        warned notch important Finds be to the of on the
                        increased explain noise of power deep asking
                        contribution this live of suppliers goals bit
                        separated poured sort several the was organization the
                        if relations go work after mechanic But we've area
                        wasn't everything needs of and doctor where would.
                      </p>
                      Go he prisoners And mountains in just switching city
                      steps Might rung line what Mr Bulk; Was or between
                      towards the have phase were its world my samples are the
                      was royal he luxury the about trying And on he to my
                      enough is was the remember a although lead in were
                      through serving their assistant fame day have for its
                      after would cheek dull have what in go feedback
                      assignment Her of a any help if the a of semantics is
                      rational overhauls following in from our hazardous and
                      used more he themselves the parents up just regulatory.
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <span class="text-secondary fw-bold me-3">03</span>
                      <span class="h6 mb-0">Who should join this course?</span>
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body pt-0">
                      Post no so what deal evil rent by real in. But her ready
                      least set lived spite solid. September how men saw
                      tolerably two behavior arranging. She offices for
                      highest and replied one venture pasture. Applauded no
                      discovery in newspaper allowance am northward.
                      Frequently partiality possession resolution at or
                      appearance unaffected me. Engaged its was the evident
                      pleased husband. Ye goodness felicity do disposal
                      dwelling no. First am plate jokes to began to cause a
                      scale.
                      <strong>Subjects he prospect elegance followed no
                        overcame</strong>
                      possible it on.
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      <span class="text-secondary fw-bold me-3">04</span>
                      <span class="h6 mb-0">What are the T&C for this program?</span>
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body pt-0">
                      Night signs creeping yielding green Seasons together man
                      green fruitful make fish behold earth unto you'll lights
                      living moving sea open for fish day multiply tree good
                      female god had fruitful of creature fill shall don't day
                      fourth lesser he the isn't let multiply may Creeping
                      earth under was You're without which image stars in Own
                      creeping night of wherein Heaven years their he over
                      doesn't whose won't kind seasons light Won't that fish
                      him whose won't also it dominion heaven fruitful Whales
                      created And likeness doesn't that Years without divided
                      saying morning creeping hath you'll seas cattle in
                      multiply under together in us said above dry tree herb
                      saw living darkness without have won't for i behold meat
                      brought winged Moving living second beast Over fish
                      place beast image very him evening Thing they're fruit
                      together forth day Seed lights Land creature together
                      Multiply waters form brought.
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      <span class="text-secondary fw-bold me-3">05</span>
                      <span class="h6 mb-0">What certificates will I be received for this
                        program?</span>
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body pt-0">
                      Smile spoke total few great had never their too Amongst
                      moments do in arrived at my replied Fat weddings
                      servants but man believed prospect Companions understood
                      is as especially pianoforte connection introduced Nay
                      newspaper can sportsman are admitting gentleman
                      belonging his Is oppose no he summer lovers twenty in
                      Not his difficulty boisterous surrounded bed Seems folly
                      if in given scale Sex contented dependent conveying
                      advantage.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>

        <!-- Right Section (30%) -->
        <div class="col-md-4">
          <!-- Video Card -->
          <div class="card mb-4">
            <img src="../{{$video->banner}}" class="card-img-top" alt="Course 1" />
            <div class="card-body">
              <h5 class="card-title">Complete Web Development Bootcamp</h5>
              <p class="card-text">Learn HTML, CSS, JavaScript, and more.</p>

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
                <p class="card-text fw-bold text-success text-success">
                  ₹990.99
                </p>
                <a href="#" class="btn btn-primary enroll-button">Enroll Now</a>
              </div>
            </div>
          </div>

          <!-- Course Details Card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">This Course Includes:</h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Lectures:</strong> 30</li>
                <li class="list-group-item">
                  <strong>Duration:</strong> 4h 50m
                </li>
                <li class="list-group-item">
                  <strong>Skills Level:</strong> Beginner
                </li>
                <li class="list-group-item">
                  <strong>Language:</strong> English
                </li>
                <li class="list-group-item">
                  <strong>Deadline:</strong> Nov 30, 2021
                </li>
                <li class="list-group-item">
                  <strong>Certificate:</strong> Yes
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- footer  -->
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
  <!-- footer  -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script src="{{ asset('landing_ui/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="{{ asset('landing_ui/assets/js/script.js')}}"></script>

</body>

</html>
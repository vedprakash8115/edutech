@extends('user-account.layout.app')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" integrity="sha512-RWhcC19d8A3vE7kpXq6Ze4GcPfGe3DQWuenhXAbcGiZOaqGojLtWwit1eeM9jLGHFv8hnwpX3blJKGjTsf2HxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/templatemo-style.css')}}">
<style>
    /* Carousel Styles */
    .carousel-container {
        max-width: 100%;
        margin: 0 auto;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.05);
    }
    .carousel-item {
        height: 60vh;
        background: no-repeat center center scroll;
        background-size: cover;
        /* display: flex;
        justify-content: center;
        align-content: center;
        align-items: center; */

    }
    </style>
<!-- HOME -->
<section id="home">
    <div class="" style="border-radius: 10px">
        <div class="carousel-container">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($slider as $index => $slide)
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($slider as $index => $slide)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                            style="background-image: url('{{ asset($slide->image) }}');">
                            <div class="carousel-caption d-md-block">
                                <h5 style="font-weight:100;">{{ $slide->title }}</h5>
                                <p style="font-weight:100;">{{ $slide->description }}</p>
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

</section>


<!-- FEATURE -->
<section id="feature">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <div class="feature-thumb">
                    <span>01</span>
                    <h3>Trending Courses</h3>
                    <p>Known is free education HTML Bootstrap Template. You can download and use this for your website.
                    </p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="feature-thumb">
                    <span>02</span>
                    <h3>Books & Library</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore
                        magna.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="feature-thumb">
                    <span>03</span>
                    <h3>Certified Teachers</h3>
                    <p>templatemo provides a wide variety of free Bootstrap Templates for you. Please tell your friends
                        about us. Thank you.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="about-info">
                    <h2>Start your journey to a better life with online practical courses</h2>

                    <figure>
                        <span><i class="fa fa-users"></i></span>
                        <figcaption>
                            <h3>Professional Trainers</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa voluptatibus.</p>
                        </figcaption>
                    </figure>

                    <figure>
                        <span><i class="fa fa-certificate"></i></span>
                        <figcaption>
                            <h3>International Certifications</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa voluptatibus.</p>
                        </figcaption>
                    </figure>

                    <figure>
                        <span><i class="fa fa-bar-chart-o"></i></span>
                        <figcaption>
                            <h3>Free for 3 months</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ipsa voluptatibus.</p>
                        </figcaption>
                    </figure>
                </div>
            </div>

            <div class="col-md-offset-1 col-md-4 col-sm-12">
                <div class="entry-form">
                    <form action="#" method="post">
                        <h2>Signup today</h2>
                        <input type="text" name="full name" class="form-control" placeholder="Full name" required="">

                        <input type="email" name="email" class="form-control" placeholder="Your email address"
                            required="">

                        <input type="password" name="password" class="form-control" placeholder="Your password"
                            required="">

                        <button class="submit-btn form-control" id="form-submit">Get started</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- TEAM -->
<section id="team">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Teachers <small>Meet Professional Trainers</small></h2>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="team-thumb">
                    <div class="team-image">
                        <img src="{{asset('landing_ui/assets/images/author-image1.jpg')}}" class="img-responsive" alt="">
                    </div>
                    <div class="team-info">
                        <h3>Mark Wilson</h3>
                        <span>I love Teaching</span>
                    </div>
                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="team-thumb">
                    <div class="team-image">
                        <img src="{{asset('landing_ui/assets/images/author-image2.jpg')}}" class="img-responsive" alt="">
                    </div>
                    <div class="team-info">
                        <h3>Catherine</h3>
                        <span>Education is the key!</span>
                    </div>
                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-google"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="team-thumb">
                    <div class="team-image">
                        <img src="{{asset('landing_ui/assets/images/author-image3.jpg')}}" class="img-responsive" alt="">
                    </div>
                    <div class="team-info">
                        <h3>Jessie Ca</h3>
                        <span>I like Online Courses</span>
                    </div>
                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-envelope-o"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="team-thumb">
                    <div class="team-image">
                        <img src="{{asset('landing_ui/assets/images/author-image4.jpg')}}" class="img-responsive" alt="">
                    </div>
                    <div class="team-info">
                        <h3>Andrew Berti</h3>
                        <span>Learning is fun</span>
                    </div>
                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-google"></a></li>
                        <li><a href="#" class="fa fa-behance"></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Courses -->
<section id="courses">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Popular Courses <small>Upgrade your skills with newest courses</small></h2>
                </div>

                <div class="owl-carousel owl-theme owl-courses">
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="courses-thumb">
                                <div class="courses-top">
                                    <div class="courses-image">
                                        <img src="{{asset('landing_ui/assets/images/courses-image1.jpg')}}" class="img-responsive"
                                            alt="">
                                    </div>
                                    <div class="courses-date">
                                        <span><i class="fa fa-calendar"></i> 12 / 7 / 2018</span>
                                        <span><i class="fa fa-clock-o"></i> 7 Hours</span>
                                    </div>
                                </div>

                                <div class="courses-detail">
                                    <h3><a href="#">Social Media Management</a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>

                                <div class="courses-info">
                                    <div class="courses-author">
                                        <img src="{{asset('landing_ui/assets/images/author-image1.jpg')}}" class="img-responsive"
                                            alt="">
                                        <span>Mark Wilson</span>
                                    </div>
                                    <div class="courses-price">
                                        <a href="#"><span>USD 25</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="courses-thumb">
                                <div class="courses-top">
                                    <div class="courses-image">
                                        <img src="{{asset('landing_ui/assets/images/courses-image2.jpg')}}" class="img-responsive"
                                            alt="">
                                    </div>
                                    <div class="courses-date">
                                        <span><i class="fa fa-calendar"></i> 20 / 7 / 2018</span>
                                        <span><i class="fa fa-clock-o"></i> 4.5 Hours</span>
                                    </div>
                                </div>

                                <div class="courses-detail">
                                    <h3><a href="#">Graphic & Web Design</a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>

                                <div class="courses-info">
                                    <div class="courses-author">
                                        <img src="{{asset('landing_ui/assets/images/author-image2.jpg')}}" class="img-responsive"
                                            alt="">
                                        <span>Jessica</span>
                                    </div>
                                    <div class="courses-price">
                                        <a href="#"><span>USD 80</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="courses-thumb">
                                <div class="courses-top">
                                    <div class="courses-image">
                                        <img src="{{asset('landing_ui/assets/images/courses-image3.jpg')}}" class="img-responsive"
                                            alt="">
                                    </div>
                                    <div class="courses-date">
                                        <span><i class="fa fa-calendar"></i> 15 / 8 / 2018</span>
                                        <span><i class="fa fa-clock-o"></i> 6 Hours</span>
                                    </div>
                                </div>

                                <div class="courses-detail">
                                    <h3><a href="#">Marketing Communication</a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>

                                <div class="courses-info">
                                    <div class="courses-author">
                                        <img src="{{asset('landing_ui/assets/images/author-image3.jpg')}}" class="img-responsive"
                                            alt="">
                                        <span>Catherine</span>
                                    </div>
                                    <div class="courses-price free">
                                        <a href="#"><span>Free</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="courses-thumb">
                                <div class="courses-top">
                                    <div class="courses-image">
                                        <img src="{{asset('landing_ui/assets/images/courses-image4.jpg')}}" class="img-responsive"
                                            alt="">
                                    </div>
                                    <div class="courses-date">
                                        <span><i class="fa fa-calendar"></i> 10 / 8 / 2018</span>
                                        <span><i class="fa fa-clock-o"></i> 8 Hours</span>
                                    </div>
                                </div>

                                <div class="courses-detail">
                                    <h3><a href="#">Summer Kids</a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>

                                <div class="courses-info">
                                    <div class="courses-author">
                                        <img src="{{asset('landing_ui/assets/images/author-image1.jpg')}}" class="img-responsive"
                                            alt="">
                                        <span>Mark Wilson</span>
                                    </div>
                                    <div class="courses-price">
                                        <a href="#"><span>USD 45</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="courses-thumb">
                                <div class="courses-top">
                                    <div class="courses-image">
                                        <img src="{{asset('landing_ui/assets/images/courses-image5.jpg')}}" class="img-responsive"
                                            alt="">
                                    </div>
                                    <div class="courses-date">
                                        <span><i class="fa fa-calendar"></i> 5 / 10 / 2018</span>
                                        <span><i class="fa fa-clock-o"></i> 10 Hours</span>
                                    </div>
                                </div>

                                <div class="courses-detail">
                                    <h3><a href="#">Business &amp; Management</a></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>

                                <div class="courses-info">
                                    <div class="courses-author">
                                        <img src="{{asset('landing_ui/assets/images/author-image2.jpg')}}" class="img-responsive"
                                            alt="">
                                        <span>Jessica</span>
                                    </div>
                                    <div class="courses-price free">
                                        <a href="#"><span>Free</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
</section>


<!-- TESTIMONIAL -->
<section id="testimonial">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Student Reviews <small>from around the world</small></h2>
                </div>

                <div class="owl-carousel owl-theme owl-client">
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="tst-image">
                                <img src="{{asset('landing_ui/assets/images/tst-image1.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="tst-author">
                                <h4>Jackson</h4>
                                <span>Shopify Developer</span>
                            </div>
                            <p>You really do help young creative minds to get quality education and professional job
                                search assistance. I’d recommend it to everyone!</p>
                            <div class="tst-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="tst-image">
                                <img src="{{asset('landing_ui/assets/images/tst-image2.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="tst-author">
                                <h4>Camila</h4>
                                <span>Marketing Manager</span>
                            </div>
                            <p>Trying something new is exciting! Thanks for the amazing law course and the great teacher
                                who was able to make it interesting.</p>
                            <div class="tst-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="tst-image">
                                <img src="{{asset('landing_ui/assets/images/tst-image3.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="tst-author">
                                <h4>Barbie</h4>
                                <span>Art Director</span>
                            </div>
                            <p>Donec erat libero, blandit vitae arcu eu, lacinia placerat justo. Sed sollicitudin quis
                                felis vitae hendrerit.</p>
                            <div class="tst-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="tst-image">
                                <img src="{{asset('landing_ui/assets/images/tst-image4.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="tst-author">
                                <h4>Andrio</h4>
                                <span>Web Developer</span>
                            </div>
                            <p>Nam eget mi eu ante faucibus viverra nec sed magna. Vivamus viverra sapien ex, elementum
                                varius ex sagittis vel.</p>
                            <div class="tst-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
</section>


<!-- CONTACT -->
<section id="contact">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <form id="contact-form" role="form" action="" method="post">
                    <div class="section-title">
                        <h2>Contact us <small>we love conversations. let us talk!</small></h2>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter full name" name="name" required="">

                        <input type="email" class="form-control" placeholder="Enter email address" name="email"
                            required="">

                        <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="message"
                            required=""></textarea>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <input type="submit" class="form-control" name="send message" value="Send Message">
                    </div>

                </form>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="contact-image">
                    <img src="{{asset('landing_ui/assets/images/contact-image.jpg')}}" class="img-responsive"
                        alt="Smiling Two Girls">
                </div>
            </div>

        </div>
    </div>
</section>


<!-- FOOTER -->
<footer id="footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-6">
                <div class="footer-info">
                    <div class="section-title">
                        <h2>Headquarter</h2>
                    </div>
                    <address>
                        <p>1800 dapibus a tortor pretium,<br> Integer nisl dui, ABC 12000</p>
                    </address>

                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>

                    <div class="copyright-text">
                        <p>Copyright &copy; 2019 Company Name</p>

                        <p>Design: TemplateMo</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-info">
                    <div class="section-title">
                        <h2>Contact Info</h2>
                    </div>
                    <address>
                        <p>+65 2244 1100, +66 1800 1100</p>
                        <p><a href="mailto:youremail.co">hello@youremail.co</a></p>
                    </address>

                    <div class="footer_menu">
                        <h2>Quick Links</h2>
                        <ul>
                            <li><a href="#">Career</a></li>
                            <li><a href="#">Investor</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="footer-info newsletter-form">
                    <div class="section-title">
                        <h2>Newsletter Signup</h2>
                    </div>
                    <div>
                        <div class="form-group">
                            <form action="#" method="get">
                                <input type="email" class="form-control" placeholder="Enter your email" name="email"
                                    id="email" required="">
                                <input type="submit" class="form-control" name="submit" id="form-submit"
                                    value="Send me">
                            </form>
                            <span><sup>*</sup> Please note - we do not spam your email.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>


<!-- SCRIPTS -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" integrity="sha512-9CWGXFSJ+/X0LWzSRCZFsOPhSfm6jbnL+Mpqo0o8Ke2SYr8rCTqb4/wGm+9n13HtDE1NQpAEOrMecDZw4FXQGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="{{asset('assets/js/smoothscroll.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>

@endsection
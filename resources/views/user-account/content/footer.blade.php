
@push('styles')<style>
    .footer {
      background-color: #2c3e50;
      /* border-radius: 30px 30px 0 0; */
      padding: 50px 0;
      overflow: hidden;
    }
    .footer h5 {
      margin-bottom: 20px;
      font-weight: 600;
      position: relative;
      padding-bottom: 10px;
    }
    .footer h5::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 2px;
      background-color: #fff;
      transition: width 0.3s ease;
    }
    .footer h5:hover::after {
      width: 100px;
    }
    .footer p, .footer a {
      font-size: 16px;
      transition: all 0.3s ease;
    }
    .footer a {
      text-decoration: none;
      color: #fff;
      display: inline-block;
      margin-bottom: 10px;
    }
    .footer a:hover {
      color: #f8f9fa;
      transform: translateX(5px);
    }
    .footer img.profile {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border: 3px solid #fff;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .footer img.profile:hover {
      transform: scale(1.1);
    }
    .footer .social-icons i {
      font-size: 24px;
      margin: 0 10px;
      transition: all 0.3s ease;
    }
    .footer .social-icons i:hover {
      color: #f8f9fa;
      transform: translateY(-5px);
    }
    .footer .contact-info i {
      margin-right: 10px;
      font-size: 18px;
    }
    .footer .btn-app {
      background-color: #fff;
      color: #ff7f50;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .footer .btn-app:hover {
      background-color: #f8f9fa;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transform: translateY(-3px);
    }
    .footer .btn-app img {
      width: 30px;
      margin-right: 10px;
    }
    @media (max-width: 768px) {
      .footer {
        text-align: center;
      }
      .footer h5::after {
        left: 50%;
        transform: translateX(-50%);
      }
    }
  </style>
  @endpush
  <footer class="footer   text-white">
    <div class="container">
      <div class="row">
        <!-- Contact Info -->
        <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-right">
          <img src="{{asset('assets/img/avatars/1.png')}}" class="rounded-circle mb-3 profile" alt="Profile Image">
          <h5 class="text-light">Contact Us</h5>
          <p class="contact-info"><i class="fa fa-phone"></i> 7091700931</p>
          <p class="contact-info"><i class="fab fa-whatsapp"></i> 7081027170</p>
          <p>EDUTECH PRIVATE LIMITED</p>
        </div>
        
        <!-- Quick Links -->
        <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
          <h5 class="text-light">Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="quick-link">Terms and Conditions</a></li>
            <li><a href="#" class="quick-link">Privacy Policy</a></li>
            <li><a href="#" class="quick-link">Refund and Cancellation Policy</a></li>
          </ul>
        </div>
        
        <!-- Social Media -->
        <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
          <button class="btn-app mb-3">
            <!-- <img src="/api/placeholder/30/30" alt="Play Store"> -->
            <i class="fab fa-google-play"></i><pre>  </pre>

            <span id="typed-text"></span>
          </button>
          <h5 class="text-light">Follow Us</h5>
          <div class="social-icons">
            <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  @push('scripts')
  <script>  var typed = new Typed('#typed-text', {
    strings: ['Get our app', 'Download now', 'Join us today'],
    typeSpeed: 50,
    backSpeed: 30,
    loop: true
  });</script>
  @endpush
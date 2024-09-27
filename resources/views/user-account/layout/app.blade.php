<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
      <meta name="description" content="" />
       @livewireStyles
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/user.css')}}" />


    <!-- dark theme  -->
    <link id="dark-theme-stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" disabled>
    <script>
    (function() {
      const savedTheme = localStorage.getItem('theme') || 'light'; // Default to 'light' if not set
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
      
      // Handle dark theme stylesheets
      const darkThemeStylesheet = document.getElementById('dark-theme-stylesheet');
      if (darkThemeStylesheet) {
        darkThemeStylesheet.disabled = savedTheme === 'light';
      }
    })();
  </script>

    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script> --}}
    <style>
        .toast {
            width: 250px; /* Set the desired width */
            max-width: 100%; /* Ensure it doesn't exceed the container's width */
        }


      </style>
    @stack('styles')
  </head>

  <body>
    @livewireScripts
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
         @include('user-account.layout.sidebar')
        <div class="layout-page">
             @include('user-account.layout.header')
       <!-- Content wrapper -->
             <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                     @yield('content')
                </div>
                 @include('user-account.layout.footer')
                <div class="content-backdrop fade"></div>
            </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>

    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <script src="{{asset('assets/js/live_class.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Load DataTables Bootstrap 5 integration -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.0.0-beta1/css/tempus-dominus.min.css" />

<!-- Tempus Dominus JS (CDN) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.0.0-beta1/js/tempus-dominus.min.js"></script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
    const darkThemeStylesheet = document.getElementById('dark-theme-stylesheet');
    const toggleThemeButton = document.getElementById('toggle-theme');
    const icon = toggleThemeButton.querySelector('i'); // Select the icon inside the button

    // Function to update theme and icon
    function updateTheme() {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        if (currentTheme === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'light');
            darkThemeStylesheet.disabled = true;
            icon.classList.remove('fa-sun'); // Remove sun icon
            icon.classList.add('fa-moon'); // Add moon icon
        } else {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            darkThemeStylesheet.disabled = false;

            icon.classList.remove('fa-moon'); // Remove moon icon
            icon.classList.add('fa-sun'); // Add sun icon
        }
    }

    // Initialize the theme based on saved user preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        darkThemeStylesheet.disabled = savedTheme === 'light';
        // Set the icon based on saved theme
        if (savedTheme === 'dark') {
          icon.classList.add('fa-sun');
          icon.classList.remove('fa-moon');
        } else {

            icon.classList.add('fa-moon');
            icon.classList.remove('fa-sun');
        }
    } else {
        // Default to light theme if no preference is saved
        document.documentElement.setAttribute('data-bs-theme', 'light');
        darkThemeStylesheet.disabled = true;
        icon.classList.add('fa-sun');
        icon.classList.remove('fa-moon');
    }

    // Toggle theme and save user preference
    toggleThemeButton.addEventListener('click', function() {
        updateTheme();
        const theme = document.documentElement.getAttribute('data-bs-theme');
        localStorage.setItem('theme', theme);
    });
});

    </script>


    @include('sweetalert::alert')

    @stack('scripts')
  </body>

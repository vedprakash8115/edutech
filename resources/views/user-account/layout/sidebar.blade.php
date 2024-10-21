<button id="menu-toggle-btn" class="btn btn-primary d-lg-none">
    <i class="bi bi-arrow-right"></i>
</button>
<aside id="user-layout-menu">
    <div class="sidebar-wrapper">
        <div class="sidebar-header text-center py-4">
            <h5 class="sidebar-user-name mb-0">{{auth()->user()->name}}</h5>
            <p class="sidebar-user-email text-muted small">{{auth()->user()->email}}</p>
        </div>
        <ul class="sidebar-nav list-unstyled">
            <li class="sidebar-item">
                <a href="{{route('student.home')}}"
                    class="sidebar-link {{ Route::is('user.account') ? 'active' : '' }}">
                    <i class="bi bi-person-circle me-2"></i>
                    Home
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('courses.index')}}" class="sidebar-link {{ Route::is('user.tests') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Courses
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link {{ Route::is('user.attempted-tests') ? 'active' : '' }}">
                    <i class="bi bi-check2-circle me-2"></i>
                    Attempted Tests
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link {{ Route::is('user.live-classes') ? 'active' : '' }}">
                    <i class="bi bi-camera-video me-2"></i>
                    Live Classes
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link {{ Route::is('user.courses') ? 'active' : '' }}">
                    <i class="bi bi-book me-2"></i>
                    My Courses
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link {{ Route::is('user.order-history') ? 'active' : '' }}">
                    <i class="bi bi-clock-history me-2"></i>
                    Order History
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('courses.books')}}" class="sidebar-link" {{ Route::is('user.ebooks') ? 'active' : '' }}>
                    <i class="bi bi-file-earmark-pdf me-2"></i>
                    My Books
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('student.support.index')}}" class="sidebar-link" {{ Route::is('user.ebooks') ? 'active' : '' }}>
                    <i class="bi bi-file-earmark-pdf me-2"></i>
                    Support
                </a>
            </li>
            <li class="chats">
                <a href="{{route('chats')}}" class="sidebar-link" {{ Route::is('user.ebooks') ? 'active' : '' }}>
                    <i class="bi bi-file-earmark-pdf me-2"></i>
                    Chat Support
                </a>
            </li>
            <li class="chats">
                <a href="{{route('student.profile')}}" class="sidebar-link" {{ Route::is('user.ebooks') ? 'active' : '' }}>
                    <i class="bi bi-file-earmark-pdf me-2"></i>
                    Profile
                </a>
            </li>
        </ul>
    </div>

</aside>

<style>
    /* Main sidebar styles */
    #user-layout-menu {
        width: 250px;
        height: 100vh;
        left: 0;
        top: 0;
        background-color: #2c3e50;
        color: #ecf0f1;
        transition: all 0.3s ease;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar-wrapper {
        padding: 20px;
        background-color: #023467f7;
    }

    /* Header styles */
    .sidebar-header {
        border-bottom: 1px solid #34495e;
    }

    .sidebar-user-name {
        font-size: 1.2em;
        font-weight: bold;
    }

    .sidebar-user-email {
        opacity: 0.7;
    }

    /* Navigation styles */
    .sidebar-nav {
        margin-top: 20px;
    }

    .sidebar-item {
        margin-bottom: 10px;
    }

    .sidebar-link {
        display: block;
        padding: 10px 15px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.2s ease;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
        background-color: white;
        color: black;
    }

    .sidebar-link i {
        margin-right: 10px;
        font-size: 1.1em;
    }

    /* Toggle button styles */
    #menu-toggle-btn {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1000;
        background-color: #3498db;
        border: none;
        color: white;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #menu-toggle-btn:hover {
        background-color: #2980b9;
    }

    /* Responsive design */
    @media (max-width: 991px) {
        #user-layout-menu {
            left: -250px;
        }

        #user-layout-menu.active {
            left: 0;
        }
    }
</style>
<script>
    const togglebtn = document.getElementById('menu-toggle-btn');

    togglebtn.addEventListener('click', function () {
        console.log('clicked');
        const sidebar = document.getElementById('user-layout-menu');

        // Get the current computed display style
        const sidebarDisplay = window.getComputedStyle(sidebar).display;

        if (sidebarDisplay === 'block') {
            sidebar.style.display = 'none';
            togglebtn.style.transform = 'scale(1)';
            togglebtn.style.left = '10px';
        } else {
            sidebar.style.display = 'block';
            togglebtn.style.transform = 'scale(-1)';
            togglebtn.style.left = '210px';
        }
    });

    //   sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    //   togglebtn.style.transform = sidebar.style.display === 'block' ? 'scale(-1)' : 'scale(1)';


</script>
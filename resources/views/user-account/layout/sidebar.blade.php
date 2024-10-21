<!-- resources/views/components/sidebar.blade.php -->
<aside id="user-layout-menu" class="sidebar">
    <ul class="sidebar-nav list-unstyled">
        <li class="sidebar-item mt-4">
            <a href="{{ route('student.home') }}" class="sidebar-link {{ Route::is('user.account') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span class="sidebar-text">Home</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('courses.index') }}" class="sidebar-link {{ Route::is('user.tests') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                <span class="sidebar-text">Courses</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ Route::is('user.attempted-tests') ? 'active' : '' }}">
                <i class="bi bi-check2-circle"></i>
                <span class="sidebar-text">Attempted Tests</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ Route::is('user.live-classes') ? 'active' : '' }}">
                <i class="bi bi-camera-video"></i>
                <span class="sidebar-text">Live Classes</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ Route::is('user.courses') ? 'active' : '' }}">
                <i class="bi bi-collection"></i>
                <span class="sidebar-text">My Courses</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ Route::is('user.order-history') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span class="sidebar-text">Order History</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('courses.books') }}" class="sidebar-link {{ Route::is('user.ebooks') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-pdf"></i>
                <span class="sidebar-text">My Books</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('student.support.index') }}" class="sidebar-link">
                <i class="bi bi-question-circle"></i>
                <span class="sidebar-text">Support</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('chats') }}" class="sidebar-link">
                <i class="bi bi-chat-dots"></i>
                <span class="sidebar-text">Chat Support</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('student.profile') }}" class="sidebar-link">
                <i class="bi bi-person"></i>
                <span class="sidebar-text">Profile</span>
            </a>
        </li>
    </ul>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        background-color: #2c3e50;
        width: 60px;
        /* border: 2px solid red; */
        overflow-x: hidden;
        transition: width 0.3s ease;
        font-family: 'Poppins', sans-serif;
        z-index: 99;
    }

    .sidebar:hover {
        width: 240px;
    }

    .sidebar-nav {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .sidebar-item {
        margin-bottom: 5px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #ecf0f1;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .sidebar-link:hover, .sidebar-link.active {
        background-color: #34495e;
    }

    .sidebar-link i {
        font-size: 1.2rem;
        min-width: 30px;
    }

    .sidebar-text {
        margin-left: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar:hover .sidebar-text {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 0;
        }

        .sidebar.active {
            width: 240px;
        }

        .sidebar.active .sidebar-text {
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('user-layout-menu');
        const toggleBtn = document.createElement('button');
        toggleBtn.id = 'menu-toggle-btn';
        toggleBtn.className = 'btn btn-primary d-lg-none';
        toggleBtn.innerHTML = '<i class="bi bi-list"></i>';
        document.body.appendChild(toggleBtn);

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    });
</script>
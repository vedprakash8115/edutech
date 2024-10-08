{{-- <section>
    <div class="container  d-flex justify-content-center">
        <div class="card bg-light w-100  overflow-hidden" style="">
            <div id="particles-js" class="position-absolute w-100 h-100" style="z-index: 0;"></div>
            
            <div class="card-body d-flex justify-content-center align-items-center  " style="z-index: 1;">
                <button 
                    class="btn m-2 custom-btn" 
                    onclick="window.location.href='{{ route('mock_test') }}'">
                    Manage Tests
                </button>
                
                <!-- Vertical Line -->
                <div style="border-left: 2px solid #000; height: 40px; margin: 0 15px;"></div>
                
                <button 
                    class="btn m-2 custom-btn" 
                    onclick="window.location.href='{{ route('mock_subjects') }}'">
                    Manage Subjects
                </button>
                
                <div style="border-left: 2px solid #000; height: 40px; margin: 0 15px;"></div>
                <button 
                    class="btn m-2 custom-btn" 
                    onclick="window.location.href='{{ route('mock_questions') }}'">
                    Manage Questions
                </button>
                <div style="border-left: 2px solid #000; height: 40px; margin: 0 15px;"></div>
                <button 
                    class="btn m-2 custom-btn" 
                    onclick="window.location.href='{{ route('mock_sample') }}'">
                    Sample View
                </button>
            </div>
        </div>
    </div>
    

<style>
/* body {
    background-color: #f0f0f0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
} */

/* .card {
    background-color: #ffffff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
} */

.card-title {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.custom-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.custom-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255, 255, 255, 0.5),
        transparent
    );
    transition: all 0.5s;
}

.custom-btn:hover::before {
    left: 100%;
}

.custom-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .card-body {
        flex-direction: column;
    }
    .custom-btn {
        width: 100%;
        margin: 0.5rem 0 !important;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    particlesJS('particles-js', {
        particles: {
            number: { value: 80, density: { enable: true, value_area: 800 } },
            color: { value: "#3366cc" },
            shape: { type: "circle" },
            opacity: { value: 0.7, random: false },
            size: { value: 4, random: true },
            line_linked: { enable: false, distance: 150, color: "#3366cc", opacity: 0.4, width: 1 },
            move: { enable: true, speed: 2, direction: "none", random: true, straight: false, out_mode: "bounce" }
        },
        interactivity: {
            detect_on: "canvas",
            events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: true, mode: "push" } },
            modes: { repulse: { distance: 100, duration: 0.4 }, push: { particles_nb: 4 } }
        },
        retina_detect: true
    });
});
</script>
</section> --}}
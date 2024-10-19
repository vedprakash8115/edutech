<section>
    <div class="  d-flex justify-content-center" style="">
  <div class="card bg-light w-100 overflow-hidden" style="border-radius:5px;">
    <h3 class="card-title mb-4" style="font-family: Georgia, 'Times New Roman', Times, serif; color:rgb(114, 114, 114)">NAVIGATION PANEL</h3>
    <div class="card-body d-flex justify-content-center align-items-center py-0" style="z-index: 1;">
        
        <button 
            class="btn m-2  {{ request()->routeIs('mock_test') ? 'btn-primary' : 'custom-btn' }}" 
            onclick="window.location.href='{{ route('mock_test') }}'">
            Manage Tests
        </button>
        
        <!-- Vertical Line -->
        <div style="border-left: 2px solid #000; height: 40px; margin: 0 15px;"></div>
        
        <button 
            class="btn m-2  {{ request()->routeIs('mock_subjects') ? 'btn-primary' : 'custom-btn' }}" 
            onclick="window.location.href='{{ route('mock_subjects') }}'">
            Manage Subjects
        </button>
        
        <div style="border-left: 2px solid #000; height: 40px; margin: 0 15px;"></div>
        <button 
            class="btn m-2  {{ request()->routeIs('mock_questions') ?  'btn-primary' : 'custom-btn' }}" 
            onclick="window.location.href='{{ route('mock_questions') }}'">
            Manage Questions
        </button>
        
        <div style="border-left: 2px solid #000; height: 40px; margin: 0 15px;"></div>
        <button 
            class="btn m-2  {{ request()->routeIs('mock_sample') ?  'btn-primary' : 'custom-btn' }}" 
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
    color: #000 !important;
    font-weight: 100 !important;
}

.custom-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    background: #ff6464;
    color: white;
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
        rgb(255, 252, 246),
        transparent
    );
    transition: all 0.5s;
    color: white;
}

.card {
        /* background: rgba(236, 220, 220, 0.8); */
        backdrop-filter: blur(10px);
        border-radius: 2px !important;
        /* border: 1px solid rgba(15, 33, 232, 0.801); */
        box-shadow: 0 1px 8px 2px #bbbcc4 ;
    }
    .card-title
    {
        padding: 15px 0px 10px 0px  ;
        background: #fc7f7f;
        color: rgba(149, 149, 149, 0.968);
        display: flex;
        text-align: center;
        justify-content: center;
        align-content: center;
        /* border-bottom: 1px solid black; */
        box-shadow: 0px 2px 2px rgba(22, 21, 21, 0.485);
        overflow: hidden;
    }
    h3
    {
        font-family: Georgia, 'Times New Roman', Times, serif;
        color:rgb(34, 31, 31) !important;
    }
   
.custom-btn:hover::before {
    left: 100%;
}

.custom-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    color: white;
}

@media (max-width: 768px) {
    .card-body {
        flex-direction: column;
    }
    .custom-btn {
        width: 100%;
        margin: 0.5rem 0 !important;
    }
    .btn-danger
    {
        background-color: rgb(204, 106, 106) !important;
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
</section>
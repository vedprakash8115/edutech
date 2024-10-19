<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Registration Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <style>
        body {
            position: relative;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                url({{ asset('assets/img/backgrounds/rex.jpg') }}) top no-repeat;
    background-size: cover; /* Ensures the image covers the area */
    background-position: top; 
            

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            color: #333;
            min-width: 100%;
            background-size: cover;
            /* background-postion:top top; */
            background-repeat: no-repeat;
        }
        .form-container {
            /* background: rgba(240, 7, 7, 0.1); */
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            /* backdrop-filter: blur(1px); */
            /* border: 1px solid rgba(255, 255, 255, 0.18); */
            border-radius: 0px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            flex-wrap: wrap;
           
        }
        .card
        {
            display: flex;
            justify-content: center;
            align-content: center;
            background: transparent;
            width:100%;
            /* background: none; */
            border-radius: 0%;
            border:none;box-shadow: none;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .next-btn, .prev-btn, .submit-btn {
            background: #667eea;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .next-btn:hover, .prev-btn:hover, .submit-btn:hover {
            background: #764ba2;
            transform: translateY(-3px);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.6);
            border: 2px solid #667eea;
            border-bottom: 5px solid #667eea;
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25);
            border-color: #764ba2;
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 10px;
            color: #4a4a4a;
        }
        h2 {
            color: #4a4a4a;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 100;
        }
        .input-group .next-btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .flex {
            display: flex;
            flex-direction: column;
        }
        .form-label {
            font-weight: 100;
            color: white;
        }
        /* New styles for overlay and success message */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            backdrop-filter: blur(5px);
        }
        .overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .success-message {
            /* background: white; */
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 100%;
        }
        .success-message h3 {
            color: #dcdcdc;
            font-size: 75px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: 100;

            margin-bottom: 20px;
        }
        .login-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .login-btn:hover {
            background: #45a049;
        }
        form{
            width: 50%;
        }
          .p
        {
            position: fixed;
           top: 60px;
           /* left: 50; */
             /* font-size:150px;  */
             width: 100%;
             height: 100vh;
           
              font-weight:100; 
              font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
               
               text-align: center;
               
        }
        #welcome
    {
        font-size:150px;
    }
        #p
    {
        font-size:150px;
    }
        @media (max-width:780px)
        {
            body {
                background: linear-gradient(135deg, #e0eafc, #cfdef3);


        }
        #welcome
        {
display: none;
/* font-size: 90px ; */
        }
  span
  {
    font-size: 100px !important;
    flex-wrap: wrap;
  }
  .form-container {
            /* background: rgba(240, 7, 7, 0.1); */
          
            backdrop-filter: blur(4px);
            /* border: 1px solid rgba(255, 255, 255, 0.18); */
          
           
        }
        form{
            width: 100%;
        }
    }
        @media (min-width:780px)
        {
       
        form{
            width: 70%;
        }
    }
        @media (min-width:1080px)
        {
       
        form{
            width: 50%;
        }
    }
    #p
    {
        font-size: 370px;
        text-shadow: 
        -2px -2px 0 #030000,  
        2px -1px 0 #060000,
        -1px 2px 0 #020017,
        2px 2px 0 #000000;
    }
    #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #3801ff28;
            z-index: -1;
        }

/* Make the font size smaller for smaller screens */
@media (max-width: 768px) {
    #p {
        font-size: 6vw; /* Increase font size slightly */
    }
}

@media (max-width: 480px) {
    #p {
        font-size: 8vw; /* Increase font size more for smaller devices */
    }
}
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <p id="welcome" style="position:fixed; top:5px; color:rgb(0, 0, 0);  font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; text-align: center;width: 100%;opacity:63%; " data-aos="fade-down">WELCOME TO</p>
    <p class="p" ><span id="p" class="" style=" opacity:15%; text-shadow:2px 2px 2px 2xp #3498db; color:rgb(248, 248, 248);" data-aos="fade">EDUTECH</span></p>
    <div class="card" style="">
     
        <div class="form-container d-flex" style="justify-content: center; align-content:center;" data-aos="fade-up">
           
         
 
            <form id="registrationForm" enctype="multipart/form-data" >
                @csrf
                <div class="form-section active flex" data-aos="fade-right">
                    <div class="mb-4">
                        <label for="name" id="lbl1" class="form-label" style="font-size: 24px;">Hello! Let's start with your name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" >
                            <button type="button" id="btn1" class="btn next-btn">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-section" data-aos="fade-right">
                    <label for="profileImage" class="form-label" style="font-size: 24px;">Can I have a profile image of yours?</label>
                    <div class="mb-4">
                        <input type="file" class="form-control" id="profileImage" name="image" accept="image/*">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="prev-btn"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="button" class="next-btn">Next <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="form-section" data-aos="fade-right">
                    <label for="email" class="form-label" style="font-size: 24px;">Please provide me with your credentials</label>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" >
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
                    </div>
                    <div class="mb-4">
                        <input type="tel" name="mobile" class="form-control" id="mobile" placeholder="Mobile Number" >
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="prev-btn"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="button" class="next-btn">Next <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="form-section" data-aos="fade-right">
                    <label for="address" class="form-label" style="font-size: 24px;">Please provide us with your address details</label>
                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="city" class="form-control" id="city" placeholder="City">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="state" class="form-control" id="state" placeholder="State">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="country" class="form-control" id="country" placeholder="Country">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Pincode">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="prev-btn"><i class="fas fa-arrow-left"></i> Back</button>
                        <button type="submit" class="submit-btn">Submit Details <i class="fas fa-check"></i></button>
                    </div>
                </div>
            </form>
     
        </div>
    </div>

    <div class="overlay" id="overlay">
        <div class="spinner"></div>
    </div>

    <div class="overlay" id="successOverlay">
        <div class="success-message" data-aos="zoom-in">
            <h3 style="">Thank You for Registering!</h3>
            <p class="text-white">Your account has been successfully created.</p>
            <button class="login-btn" onclick="goToLogin()">Go to Login</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>  
      <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
   
   
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle"
                },
                "opacity": {
                    "value": 0.5
                },
                "size": {
                    "value": 2
                },
                "line_linked": {
                    "enable":false ,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6
                }
            }
        });
        const form = document.getElementById('registrationForm');
        const sections = form.querySelectorAll('.form-section');
        const nextBtns = form.querySelectorAll('.next-btn');
        const prevBtns = form.querySelectorAll('.prev-btn');
        const nameInput = document.getElementById('name');
        const btn1 = document.getElementById('btn1');
        const lbl1 = document.getElementById('lbl1');
        let currentSection = 0;
    
        function updateVisibility() {
            if (currentSection === 0) {
                nameInput.classList.remove('d-none');
                btn1.classList.remove('d-none');
                lbl1.classList.remove('d-none');
            } else {
                nameInput.classList.add('d-none');
                btn1.classList.add('d-none');
                lbl1.classList.add('d-none');
            }
        }
    
        updateVisibility(); // Initial call
    
        nextBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                sections[currentSection].classList.remove('active');
                currentSection++;
                sections[currentSection].classList.add('active');
                updateVisibility();
            });
        });
    
        prevBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                sections[currentSection].classList.remove('active');
                currentSection--;
                sections[currentSection].classList.add('active');
                updateVisibility();
            });
        });
    
        // Fetch request function
        document.getElementById('registrationForm').addEventListener('submit', async function (e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way
            // Collect form data
            const form = e.target;
            const formData = new FormData(form);
            // Show loading indicator (optional)
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Submitting...';
            try {
                // Send form data using AJAX (fetch API)
                const response = await fetch('/register', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json', // Optional, for JSON response
                    },
                });
                // Check if the response is OK (status code 200-299)
                if (response.ok) {
                    const jsonResponse = await response.json();
                    console.log('Success:', jsonResponse);
                    setTimeout(() => {
                        overlay.classList.remove('active');
                        successOverlay.classList.add('active');
                    }, 1000);
                } else {
                    console.log('Error:', response.statusText);
                    alert('An error occurred while submitting the form.');
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                alert('An error occurred. Please try again.');
            } finally {
                // Re-enable submit button
                submitButton.disabled = false;
                submitButton.innerHTML = 'Submit';
            }
        });
    
        function goToLogin() {
            // Redirect to login page (replace with actual login page URL)
            window.location.href = '/login';
        }
    </script>
    
    
</body>
</html>
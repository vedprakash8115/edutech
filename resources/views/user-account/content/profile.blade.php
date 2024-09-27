@extends ('user-account.layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="account-section card">
                <div class="profile-header">
                    <!-- Profile Image -->
                    <div class="profile-image-container">
                        <img src="{{ asset(auth()->user()->image ?? 'default-image-path.png') }}" 
                             alt="Profile Image" class="profile-image" id="profileImage">
                        <label for="imageUpload" class="image-upload-btn">
                            <i class="fas fa-camera"></i>
                        </label>
                        
                        <!-- Image Upload Form -->
                        <form action="{{ route('student.profile.updateImage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" id="imageUpload" name="profile_image" style="display: none;" accept="image/*" onchange="this.form.submit()">
                        </form>
                    </div>
                    <h2 class="user-name">{{ auth()->user()->name }}</h2>
                    <p class="user-email">{{ auth()->user()->email }}</p>
                </div>

                <!-- Profile Details Form -->
                <h3 class="account-section-title">Personal Information</h3>
                <form action="{{ route('student.profile.updateDetails') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="mobileNumber" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="mobileNumber" name="mobile" value="{{ auth()->user()->mobile }}">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ auth()->user()->state }}">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ auth()->user()->city }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-update">Update Profile</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-4">
            <div class="account-section progress-section card">
                <h3 class="account-section-title">Course Progress</h3>
                <div class="course-progress">
                    <h5>Web Development Fundamentals</h5>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div>
                </div>
                <div class="course-progress">
                    <h5>JavaScript Advanced Concepts</h5>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                    </div>
                </div>
                <div class="course-progress">
                    <h5>Responsive Web Design</h5>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                    </div>
                </div>
                
                <h3 class="account-section-title mt-4">Achievements</h3>
                <div class="d-flex flex-wrap justify-content-center">
                    <img src="https://media.istockphoto.com/id/978978230/vector/award-ribbon-icon-on-white-stock-vector-illustration.jpg?s=612x612&w=0&k=20&c=rHzU2X-6DBTR2zB-yu4oXKQ1f1uEW6aEEM-_RT4pZSA=" alt="HTML Master" class="achievement-badge" title="HTML Master" border="1">
                    <img src="https://media.istockphoto.com/id/978978230/vector/award-ribbon-icon-on-white-stock-vector-illustration.jpg?s=612x612&w=0&k=20&c=rHzU2X-6DBTR2zB-yu4oXKQ1f1uEW6aEEM-_RT4pZSA=" alt="CSS Wizard" class="achievement-badge" title="CSS Wizard" border="1">
                    <img src="https://media.istockphoto.com/id/978978230/vector/award-ribbon-icon-on-white-stock-vector-illustration.jpg?s=612x612&w=0&k=20&c=rHzU2X-6DBTR2zB-yu4oXKQ1f1uEW6aEEM-_RT4pZSA=" alt="JavaScript Ninja" class="achievement-badge" title="JavaScript Ninja" border="1">
                    <img src="https://media.istockphoto.com/id/978978230/vector/award-ribbon-icon-on-white-stock-vector-illustration.jpg?s=612x612&w=0&k=20&c=rHzU2X-6DBTR2zB-yu4oXKQ1f1uEW6aEEM-_RT4pZSA=" alt="React Rockstar" class="achievement-badge" title="React Rockstar" border="1">
                </div>
            </div>
        </div>
    </div>
</div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('imageUpload');
            const profileImage = document.getElementById('profileImage');

            imageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            const updateProfileForm = document.getElementById('updateProfileForm');
            updateProfileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Here you would typically send the form data to your server
                alert('Profile updated successfully!');
            });
        });
    </script>
@endsection
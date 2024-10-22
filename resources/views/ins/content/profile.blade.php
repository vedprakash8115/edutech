@extends('layout.app')

@section('content')

<div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="m-0"><i class="bi bi-person-plus me-2"></i>Add New User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.add') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="user_name" class="form-label required">Name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_email" class="form-label required">Email</label>
                                    <input type="email" class="form-control" id="user_email" name="user_email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="user_mobile" class="form-label required">Mobile Number</label>
                                    <input type="text" class="form-control" id="user_mobile" name="user_mobile" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_city" class="form-label required">City</label>
                                    <input type="text" class="form-control" id="user_city" name="user_city" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="user_state" class="form-label required">State</label>
                                    <input type="text" class="form-control" id="user_state" name="user_state" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_country" class="form-label required">Country</label>
                                    <input type="text" class="form-control" id="user_country" name="user_country" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="user_password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="user_password" name="user_password" placeholder ="Auto generated if left empty">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient text-white">
                                <i class="bi bi-person-plus-fill me-2"></i>Add User
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="m-0 d-inline"><i class="bi bi-file-earmark-arrow-up me-2"></i>Bulk Add Users</h3>
                                        <!-- Button to Open Modal -->
                        <button type="button" class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#instructionsModal">
                            Read Instructions
                        </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.bulkAddUsers') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="csv_file" class="form-label required">Upload CSV File</label>
                                <input type="file" class="form-control" name="csv_file" id="csv_file" required>
                            </div>
                            <button type="submit" class="btn btn-gradient text-white">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i>Bulk Add Users
                            </button>
                        </form>
                    </div>
                </div>


                <!-- Modal Structure -->
                <div class="modal fade" id="instructionsModal" tabindex="-1" aria-labelledby="instructionsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="instructionsModalLabel">Bulk Add Users Instructions</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Modal Body with Instructions -->
                            <div class="modal-body">
                                <a href="{{asset('csv_files/sample_users.csv')}}" class="btn btn-info">Sample user csv</a>

                                <p>When bulk adding users, ensure your CSV file follows the format below:</p>
                                
                                <!-- Instructions Table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Column</th>
                                            <th>Requirement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Name</strong></td>
                                            <td>Required (Full Name of the User)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td>Required (Must be a valid and unique email)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Mob ile Number</strong></td>
                                            <td>Required (Valid number, e.g. 123-456-7890)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>City</strong></td>
                                            <td>Optional (Max 100 characters)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>State</strong></td>
                                            <td>Optional (Max 100 characters)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Country</strong></td>
                                            <td>Optional (Max 100 characters)</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p><strong>Note:</strong></p>
                                <ul>
                                    <li>Ensure the file format is CSV (comma-separated values).</li>
                                    <li>The first row should contain the column headers: <code>Name, Email, Mobile, City, State, Country</code>.</li>
                                    <li>Name, Email, and Mobile are mandatory fields.</li>
                                    <li>Ensure no duplicate email addresses exist within the file.</li>
                                    <li>Empty fields in the optional columns (City, State, Country) are acceptable.</li>
                                </ul>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="m-0">Admin Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="profile-img">
                            <i class="bi bi-person"></i>
                        </div>
                        <form action="{{ route('admin.profile.update') }}" id="update-profile-form" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label required">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label required">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="mobile" value="{{ $admin->phone }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="current_password" class="form-label required">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label required">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label required">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" readonly>
                            </div>
                            <div class="card mt-3">
                               
                           
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" id="update-profile-btn" class="btn btn-gradient text-white">
                                    <i class="bi bi-save me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('update-profile-btn').addEventListener('click', function(event) {
          event.preventDefault(); // Prevent the default form submission
      
          const form = document.getElementById('update-profile-form');
          const formData = new FormData(form);
          for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
          fetch("{{ route('admin.profile.update') }}", {
            method: "POST",
            body: formData,
            headers: {
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
          })
          .then(response => response)
          .then(data => {
            console.log(data);
          });
        //       Swal.fire({
        //         title: 'Enter OTP',
        //         input: 'text',
        //         inputLabel: data.message,
        //         inputPlaceholder: data.message,
        //         showCancelButton: true,
        //         confirmButtonText: 'Verify OTP',
        //         preConfirm: (otp) => {
        //           return new Promise((resolve) => {
        //             fetch("{{ route('admin.profile.verifyOtp') }}", {
        //               method: "POST",
        //               body: JSON.stringify({ otp: otp }),
        //               headers: {
        //                 "Content-Type": "application/json",
        //                 "X-CSRF-TOKEN": "{{ csrf_token() }}"
        //               }
        //             })
        //             .then(response => response)
        //             .then(result => {
        //                 console.log(result);
        //               if (result.status === 200) {
        //                 resolve();
        //                 location.reload(); // Refresh or redirect as needed
        //               } else {
        //                 Swal.showValidationMessage('OTP is incorrect');
        //               }
        //             });
        //           });
        //         }
        //       });
            
        //   })
        //   .catch(error => console.error('Error:', error));
        });
      </script>
      
    @endpush --}}
@endsection
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
                        <h3 class="m-0"><i class="bi bi-file-earmark-arrow-up me-2"></i>Bulk Add Users</h3>
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
                        <form action="{{ route('admin.profile.update') }}" method="POST">
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" readonly>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gradient text-white">
                                    <i class="bi bi-save me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
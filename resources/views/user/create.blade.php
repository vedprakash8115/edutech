@extends('layout.app')

@section('title', isset($single_data) ? 'Edit User' : 'Add User')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ isset($single_data) ? 'Edit User' : 'Add User' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($single_data->id)?route('users.update',$single_data->id):route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($single_data)
                    @method('put')
                @endisset
                <!-- User Details Section -->
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $single_data->name ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $single_data->last_name ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $single_data->email ?? '') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="number" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $single_data->mobile ?? '') }}" required oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Leave to keep old password">
                            <span class="text-warning">password must be 8 character with Capital,Small letter and number , symbol</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $single_data->address ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $single_data->city ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $single_data->state ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $single_data->country ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="number" name="pincode" id="pincode" class="form-control" value="{{ old('pincode', $single_data->pincode ?? '') }}" required oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option class="" value="1" {{ old('status', $single_data->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option class="" value="0" {{ old('status', $single_data->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                @isset($roles)
                                @foreach ($roles as $role)
                                <option value="{{$role->id ?? ''}}" {{(isset($single_data->role_id) && $single_data->role_id==$role->id)?'selected':''}}>{{$role->name ?? ''}}</option>
                                @endforeach
                                @endisset
                                <!-- Add more roles as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="role">Details</label>
                        <textarea name="details" class="form-control" rows="">{{ old('details', $single_data->details ?? '') }}</textarea>
                    </div>
                </div>

                <h4 class="mt-4">Social Links</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="facebook_link">Facebook Link</label>
                            <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="{{ old('facebook_link', $single_data->facebook_link ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="youtube_url">YouTube URL</label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-control" value="{{ old('youtube_url', $single_data->youtube_url ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="twitter_url">Twitter URL</label>
                            <input type="url" name="twitter_url" id="twitter_url" class="form-control" value="{{ old('twitter_url', $single_data->twitter_url ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="linkedin_url">LinkedIn URL</label>
                            <input type="url" name="linkedin_url" id="linkedin_url" class="form-control" value="{{ old('linkedin_url', $single_data->linkedin_url ?? '') }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">{{ isset($single_data) ? 'Update User' : 'Add User' }}</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function() {
        // Validate Mobile Number
        $('#mobile').on('input', function() {
            var value = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
            if (value.length > 10) {
                value = value.slice(0, 10); // Limit to 10 digits
            }
            $(this).val(value); // Set the sanitized value
        });

        // Validate Pincode
        $('#pincode').on('input', function() {
            var value = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
            if (value.length > 6) {
                value = value.slice(0, 6); // Limit to 6 digits
            }
            $(this).val(value); // Set the sanitized value
        });
    });

</script>
@endpush
@endsection

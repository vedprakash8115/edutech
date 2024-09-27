@extends('layout.app')

@section('title', isset($single_data) ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ isset($single_data) ? 'Edit Testimonial' : 'Add Testimonial' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($single_data->id) ? route('testimonials.update', $single_data->id) : route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($single_data)
                        @method('put')
                    @endisset

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="name" id="user-select" required>
                                    <option value="" disabled {{ !isset($single_data) ? 'selected' : '' }}>...Please Select...</option>
                                    @isset($users_list)
                                    @foreach($users_list as $user)
                                        <option value="{{ $user->id }}" {{ isset($single_data) && $single_data->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image <span class="text-warning"> (2 MB allowed) </span></label>
                                <input type="file" name="image" id="image" class="form-control">
                                @isset($single_data->image)
                                    <img src="{{ asset($single_data->image) }}" height="60px" width="60px"/>
                                @endisset
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" id="role-select" name="role_id" required>
                                    {{-- <option value="" disabled {{ !isset($single_data) ? 'selected' : '' }}>...Please Select...</option>
                                    @isset($roles)
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ isset($single_data) && $single_data->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                    @endisset --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description" required>{{ isset($single_data) ? $single_data->description : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mt-3">{{ isset($single_data) ? 'Update Testimonial' : 'Add Testimonial' }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#user-select').change(function() {
                const userId = $(this).val();
                if (userId) {
                    $.ajax({
                        url: '{{ route("roles.byUser", ":id") }}'.replace(':id', userId), // Use the named route
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.roles);
                            const roleSelect = $('#role-select');
                            roleSelect.empty();
                            roleSelect.append('<option value="" disabled selected>...Please Select...</option>');
                            roleSelect.append(`<option value="${data.roles.id}">${data.roles.name}</option>`);
                        },
                        error: function(xhr) {
                            console.error(xhr);
                        }
                    });
                } else {
                    $('#role-select').empty().append('<option value="" disabled selected>...Please Select...</option>');
                }
            });
        });
    </script>
    @endpush
@endsection

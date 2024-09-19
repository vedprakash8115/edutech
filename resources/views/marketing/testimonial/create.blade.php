@extends('layout.app')

@section('title', isset($single_data) ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ isset($single_data) ? 'Edit Testimonial' : 'Add Testimonial' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($single_data->id)?route('testimonials.update',$single_data->id):route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($single_data)
                        @method('put')
                    @endisset
                    <!-- Coupon Details Section -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="name">
                                    <option selected value="" disabled>...Please Select...</option>
                                    @isset($users_list)
                                    @foreach($users_list as $key => $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="role_id">
                                    <option selected value="" disabled>...Please Select...</option>
                                    @isset($roles)
                                    @foreach($roles as $key => $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="position">
                                    <option selected value="" disabled>...Please Select...</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div> --}}
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

        });

    </script>
    @endpush
@endsection

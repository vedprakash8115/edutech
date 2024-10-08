@extends('layout.app')

@section('title', isset($single_data) ? 'Edit Slider' : 'Add Slider')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ isset($single_data) ? 'Edit Slider' : 'Add Slider' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($single_data->id) ? route('sliders.update', $single_data->id) : route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($single_data)
                        @method('put')
                    @endisset

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ $single_data->title??'' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image  {{isset($single_data->image)?'':'*' }} <span class="text-warning"> (5 MB allowed) </span></label>
                                <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.gif">
                                @isset($single_data->image)
                                    <img src="{{ asset($single_data->image) }}" height="60px" width="60px"/>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position">Position {{isset($single_data->position)?'':'*' }}</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="position" required>
                                    <option value="" selected disabled>...Please Select Position...</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                    @if (!in_array($i, $existingPositions)) <!-- Check if the position is in the existing positions -->
                                        <option value="{{ $i }}" {{ isset($single_data) && $single_data->position == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Link">Link (Format - https://www.google.com/)</label>
                                <input type="text" name="link" id="link" value="{{ $single_data->link??'' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="button_name">Button Name</label>
                                <input type="text" name="button_name" id="button_name" value="{{ $single_data->button_name??'' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
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
            // Any additional JavaScript
        });
    </script>
    @endpush
@endsection

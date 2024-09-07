@extends('layout.app')
@section('title', isset($single_data) ? 'Edit Course' : 'Add Course')
@section('content')
<div class="row">
    <div class="col-8 offset-2">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ isset($single_data) ? 'Edit Course' : 'Add Course' }}</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="courseForm" method="post" action="{{ isset($single_data) ? route('update_course', $single_data->id) : route('storecourse') }}">
                    @csrf
                    @if(isset($single_data))
                        @method('put') <!-- Use PUT if updating -->
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label class="col-form-label" for="course_name">Course Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', isset($single_data->name) ? $single_data->name : '') }}" placeholder="Enter Course Name" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="{{ isset($single_data) ? 'Update Course' : 'Add Course' }}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Any specific scripts for the form if needed
    });
</script>
@endpush

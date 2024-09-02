@extends('layout.app')
@section('title', 'Add Course')
@section('content')
<div class="row">
    <div class="col-8 offset-2">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Course</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="courseForm" method="post" action="{{ route('storecourse') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label class="col-form-label" for="course_name">Course Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Course Name" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="Add Course"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
$(document).ready(function() {

});
</script>

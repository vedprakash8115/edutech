@extends('layout.app')
@section('title', 'Add Category')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Category</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="categoryForm" method="post" action="{{ route('store_category') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="col-form-label" for="course">Course</label>
                            <select name="course_id" class="form-control" id="course">
                                <option value="">-- Select a Course --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" />
                        </div>
                        <div class="col-sm-12">
                            <label class="col-form-label" for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-sm-6 d-flex align-items-end">
                            <input type="submit" class="btn btn-primary" value="Add Category"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

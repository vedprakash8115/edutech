@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Live Class</h5>
                    <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('videocourse.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseName" class="form-label">Course Name</label>
                                    <input type="text" class="form-control" id="CourseName" placeholder="Course Name"
                                        name="course_name" value="{{ old('course_name') }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="Language" class="form-label">Language</label>
                                    <select class="form-select" aria-label="Default select example" id="Language"
                                        name="language">
                                        <option selected>Select Language</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="OriginalPrice" class="form-label">Original Price</label>
                                    <input type="text" class="form-control" id="OriginalPrice" name="original_price"
                                        value="{{ old('original_price') }}" placeholder="Original Price">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="DiscountPrice" class="form-label">Discount Price</label>
                                    <input type="text" class="form-control" id="DiscountPrice" name="discount_price"
                                        value="{{ old('discount_price') }}" placeholder="Discount Price">
                                </div>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="UploadBanner" class="form-label">Upload Banner</label>
                                    <input type="file" class="form-control" id="UploadBanner" name="video"
                                        placeholder="Original Price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseDuration" class="form-label">Course Duration</label>
                                    <input type="text" class="form-control" id="CourseDuration" name="course_duration"
                                        value="{{ old('course_duration') }}" placeholder="Course Duration">
                                </div>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="AboutCourse" class="form-label">About Course</label>
                                    <textarea class="form-control" placeholder="Leave a comment here" id="AboutCourse" name="about_course"
                                        value="{{ old('about_course') }}"></textarea>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseCategory" class="form-label">Choose Course Category</label>
                                    <select class="form-select" aria-label="Default select example" id="CourseCategory"
                                        name="course_category">
                                        <option selected>Select Category</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger">Reset</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered border-primary table-striped table-hover">
                            <thead style="background-color: #566A7F;">
                                <tr>
                                    <th scope="col" class="text-white">Sr.No</th>
                                    <th scope="col" class="text-white">Course Name</th>
                                    <th scope="col" class="text-white">Language</th>
                                    <th scope="col" class="text-white">Original Price</th>
                                    <th scope="col" class="text-white">Discount Price</th>
                                    <th scope="col" class="text-white">upload_banner</th>
                                    <th scope="col" class="text-white">Course Duration</th>
                                    <th scope="col" class="text-white">About Course</th>
                                    <th scope="col" class="text-white">Course Category</th>
                                    <th scope="col" class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videoCourseies as $videoCourse)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + ($videoCourseies->currentPage() - 1) * $videoCourseies->perPage() }}
                                        </th>
                                        <td>{{ $videoCourse->course_name }}</td>
                                        <td>{{ $videoCourse->language }}</td>
                                        <td>{{ $videoCourse->original_price }}</td>
                                        <td>{{ $videoCourse->discount_price }}</td>
                                        <td> <img src="{{ asset($videoCourse->video) }}" alt="Banner"
                                                width="80%" height="60px"></td>
                                        <td>{{ $videoCourse->course_duration }}</td>
                                        <td>{{ $videoCourse->about_course }}</td>
                                        <td>{{ $videoCourse->course_category }}</td>
                                        <td>
                                            <a class="badge bg-primary"
                                                href="{{ url('/videoCourseies/' . $videoCourse->id) }}">View</a>
                                            <a class="badge bg-secondary"
                                                href="{{ url('/videoCourseies/' . $videoCourse->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

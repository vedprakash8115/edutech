@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Video Course</h5>
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
                                        <option value="1">Hindi</option>
                                        <option value="2">English</option>
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
                                    <label for="banner" class="form-label">Upload Banner</label>
                                    <input type="file" class="form-control" id="banner" name="banner"
                                        value="{{ old('banner') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="video" class="form-label">Upload Video </label>
                                    <input type="file" class="form-control" id="video" name="video">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            {{-- <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseDuration" class="form-label">Course Duration </label>
                                    <input type="text" class="form-control" id="CourseDuration" name="course_duration"
                                        placeholder="Course Duration">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseCategory" class="form-label">Choose Course Category</label>
                                    <select class="form-select" aria-label="Default select example" id="CourseCategory"
                                        name="course_category_id">
                                        <option selected>Select Category</option>
                                        <option value="1">CCC</option>
                                        <option value="2">PHP</option>
                                        <option value="3">DRUPAL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="from" class="form-label">Form</label>
                                    <input type="date" class="form-control" id="from" name="form"
                                        placeholder="from">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">

                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="to" class="form-label">To</label>
                                    <input type="date" class="form-control" id="to" name="to"
                                        placeholder="to">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="AboutCourse" class="form-label">About Course</label>
                                    <textarea class="form-control" placeholder="Leave a comment here" id="AboutCourse" name="about_course"
                                        value="{{ old('about_course') }}"></textarea>
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
                                        <td>
                                            <img src="{{ asset($videoCourse->banner) }}" width="100%" height="100%">
                                        </td>
                                        <td>{{ $videoCourse->course_duration }} days</td>
                                        <td>{{ $videoCourse->course_category_id }}</td>
                                        <td>
                                            <button type="button" class="badge bg-primary" data-bs-toggle="modal"
                                                data-bs-target="#view{{ $videoCourse->id }}">
                                                View
                                            </button>
                                            <a class="badge bg-secondary"
                                                href="{{ url('/videoCourseies/' . $videoCourse->id) }}">Edit</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="view{{ $videoCourse->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel{{ $videoCourse->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{ $videoCourse->id }}">
                                                        Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- {{$videoCourse->id}} --}}
                                                    <div class="row">
                                                        <div class="col-md-5 p-3 bg-light border rounded-3">
                                                            <div class="row px-2">
                                                                <div class="col-12 mb-2 bg-light rounded-3" id="banner"
                                                                    style="width:100%; height:150px;">
                                                                    <img src="{{ asset($videoCourse->banner) }}"
                                                                        class="w-100 h-100 rounded-2" alt="">
                                                                </div>
                                                                <div class="col-12 mb-3 h3">
                                                                    {{ $videoCourse->course_name }}</div>
                                                                <hr class="hr">
                                                                <div class="col-12 mb-1"><span class="h5">Course
                                                                        Description:</span></div>
                                                                <div class="col-12 mb-2" style="text-align:justify;">
                                                                    {{ $videoCourse->about_course }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 rounded-3 p-2">
                                                            <h5 class="h5">Course Contents</h5>
                                                            <div
                                                                class="video-container row d-flex align-items-center justify-content-center">
                                                                <div class="col-1">
                                                                    {{ $videoCourse->id }}
                                                                </div>
                                                                <div class="col-4">
                                                                    <video controls muted
                                                                        src="{{ asset($videoCourse->video) }}"
                                                                        width="100%" height="100%"></video>
                                                                </div>
                                                                <div class="col-7">
                                                                    {{ $videoCourse->about_course }}
                                                                </div>
                                                            </div>
                                                            {{-- <video controls muted loop  poster="" width="100%" height="100%">
                                                    <source src="{{ asset($videoCourse->video) }}">
                                                </video> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

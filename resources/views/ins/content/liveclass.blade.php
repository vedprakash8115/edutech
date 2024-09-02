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
                    <form method="POST" action='{{ route('liveclass.store') }}' enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseName" class="form-label">Course Name</label>
                                    <input type="text" class="form-control" id="CourseName" placeholder="Course Name"
                                        name="course_name" value="{{ old('course_name') }}" required>
                                    @error('course_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                    <input type="text" class="form-control" id="OriginalPrice" name="original_price" value="{{ old('original_price') }}"
                                        placeholder="Original Price" required>
                                </div>
                                @error('original_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="DiscountPrice" class="form-label">Discount Price</label>
                                    <input type="text" class="form-control" id="DiscountPrice" name="discount_price" value="{{ old('discount_price') }}"
                                        placeholder="Discount Price" required>
                                </div>
                                @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="UploadBanner" class="form-label">Upload Banner</label>
                                    <input type="file" class="form-control" id="UploadBanner" name="upload_banner"
                                        placeholder="Original Price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="CourseDuration" class="form-label">Course Duration</label>
                                    <input type="text" class="form-control" id="CourseDuration" name="course_duration" value="{{ old('course_duration') }}"
                                        placeholder="Course Duration" required>
                                </div>
                                @error('course_duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="AboutCourse" class="form-label">About Course</label>
                                    <textarea class="form-control" placeholder="Leave a comment here" id="AboutCourse" name="about_course" value="{{ old('about_course') }}" required></textarea>
                                </div>
                                  @error('about_course')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                @foreach ($liveClasses as $liveClass)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + ($liveClasses->currentPage() - 1) * $liveClasses->perPage() }}
                                        </th>
                                        <td>{{ $liveClass->course_name }}</td>
                                        <td>{{ $liveClass->language }}</td>
                                        <td>{{ $liveClass->original_price }}</td>
                                        <td>{{ $liveClass->discount_price }}</td>
                                        <td> <img src="{{ asset($liveClass->upload_banner) }}" alt="Banner"
                                                width="80%" height="60px"></td>
                                        <td>{{ $liveClass->course_duration }}</td>
                                        <td>{{ $liveClass->about_course }}</td>
                                        <td>{{ $liveClass->course_category }}</td>
                                        <td>
                                            <a class="badge bg-primary" href="{{ url('/liveClasses/' . $liveClass->id)}}">View</a>
                                            <a class="badge bg-secondary" href="{{ url('/liveClasses/' . $liveClass->id)}}">Edit</a>
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



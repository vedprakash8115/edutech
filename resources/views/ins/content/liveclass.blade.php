@extends('layout.app')
@section('content')
   <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Live class </h5>
                    <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('liveclass.store') }}" enctype="multipart/form-data">
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
                                        value="{{ old('banner') }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
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
     <div class="modal fade" id="view{{ $liveClass->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $liveClass->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{ $liveClass->id }}">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            {{$liveClass->id}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@endsection



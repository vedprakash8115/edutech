@extends('layout.app')
@section('title', 'Add Category Level 1')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Categories</h5>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item col-sm-4" role="presentation">
                        <a class="nav-link {{ request()->routeIs('addlevel0') ? 'active' : '' }}" href="{{ route('addlevel0') }}">Course Category-0</a>
                    </li>
                    <li class="nav-item col-sm-4" role="presentation">
                        <a class="nav-link {{ request()->routeIs('category_level1') ? 'active' : '' }}" href="{{route('category_level1')}}" >Course Category-1</a>
                    </li>
                    <li class="nav-item col-sm-4" role="presentation">
                        <a class="nav-link {{ request()->routeIs('course_subcategory') ? 'active' : '' }}" href="{{route('course_subcategory')}}" >Course Category-2</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ isset($single_data) ? 'Edit Category Level 1' : 'Add Category Level 1' }}</h5>
            </div>
            <div class="card-body">
                <form id="level1Form" method="post" action="{{ isset($single_data) ? route('update_level1', $single_data->id) : route('store_level1') }}">
                    @csrf
                    @if(isset($single_data))
                        @method('PUT') <!-- This is needed for update operations -->
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="col-form-label" for="level0">Category Level 0</label>
                            <select name="cat0_id" class="form-control" id="level0">
                                <option value="">-- Select a Category --</option>
                                @isset($category_l0)
                                @foreach ($category_l0 as $level1)
                                    <option value="{{ $level1->id }}" {{ isset($single_data->cat0_id) && $single_data->cat0_id == $level1->id ? 'selected' : '' }}>
                                        {{ $level1->name }}
                                    </option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="level1">Category Level 1 Name</label>
                            <input type="text" name="name" class="form-control" id="level1" placeholder="Enter Category Level 1 Name" value="{{ isset($single_data->name) ? $single_data->name : '' }}" />
                        </div>
                        {{-- <div class="col-sm-12">
                            <label class="col-form-label" for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter Description">{{ isset($single_data->description) ? $single_data->description : '' }}</textarea>
                        </div> --}}
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 d-flex align-items-end">
                            <input type="submit" class="btn btn-primary" value="{{ isset($single_data) ? 'Update' : 'Save' }}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Level 1 Categories</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped shadow-sm" id="categoriesL1Table">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Category Level 0 Name</th>
                            <th>Category level 1 Name</th>
                            {{-- <th>Description</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function() {
        $('#categoriesL1Table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('course_category.data') }}',
            columns: [
                {
                    data: null,
                    name: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Serial number starts from 1
                    }
                },
                { data: 'cat0_id', name: 'catLevel0.name' }, // Adjust based on your relationship
                { data: 'name', name: 'name' },
                //{ data: 'description', name: 'description' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush

@endsection

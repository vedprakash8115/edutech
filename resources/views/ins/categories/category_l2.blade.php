@extends('layout.app')
@section('title', 'Add Category level 2')
@section('content')

<div class="row">
    <!-- <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Categories</h5>
            </div>
            <div class="card-body">
               
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
    </div> -->
    <div class="position-relative mb-4" style="height:2rem;">
    <div class="w-100 position-absolute top-50 start-50 translate-middle">
        <!-- Progress Bar -->
        <div class="progress" style="height:.25rem;">
            <div class="progress-bar bg-primary" id="progress-tab" role="progressbar"
                @if (request()->routeIs('addlevel0'))
                    style="width: 0%;"
                @elseif (request()->routeIs('category_level1'))
                    style="width: 50%;"
                @elseif (request()->routeIs('course_subcategory'))
                    style="width: 100%;"
                @endif
                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs border-0 w-100 hstack justify-content-between position-absolute top-50 start-50 translate-middle" id="skk-tabs">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('addlevel0') ? 'active' : '' }}" href="{{ route('addlevel0') }}">Level 0</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('category_level1') ? 'active' : '' }}" href="{{ route('category_level1') }}">Level 1</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('course_subcategory') ? 'active' : '' }}" href="{{ route('course_subcategory') }}">Level 2</a>
            </li>
        </ul>
    </div>
</div>
</div>

<div class="row">
    <!-- First Card (Form) -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ isset($single_data) ? 'Edit Category Level 2' : 'Add Category Level 2' }}</h5>
            </div>
            <div class="card-body">
                <form id="level2Form" method="post" action="{{ isset($single_data) ? route('update_subcategory', $single_data->id) : route('store_subcategory') }}">
                    @csrf
                    @if(isset($single_data))
                        @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="col-form-label" for="category">Category Level 1</label>
                            <select name="category_id" class="form-control" id="category">
                                <option value="">-- Select a Category --</option>
                                @isset($categories)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($single_data->category_id) && $single_data->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label" for="name">Category Level 2 Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Level 2 Name" value="{{ isset($single_data->name) ? $single_data->name : '' }}" />
                        </div>
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

    <!-- Second Card (Table) -->
    <div class="col-lg-8 col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Subcategories</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped shadow-sm" id="subcategoriesTable">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Category Level 1 Name</th>
                            <th>Category Level 2 Name</th>
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
        $('#subcategoriesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('subcategory.data') }}',
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
                { data: 'category_id', name: 'category.name' }, // Adjust based on your relationship
                { data: 'name', name: 'name' },
                // { data: 'description', name: 'description' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endpush

@endsection

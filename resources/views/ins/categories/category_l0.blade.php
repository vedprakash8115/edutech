@extends('layout.app')
@section('title', isset($single_data) ? 'Edit Category L0' : 'Add Category L0')
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
    <div class="col-8 offset-2">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ isset($single_data) ? 'Edit Category Level 0' : 'Add Category Level 0' }}</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="category_lo_form" method="post" action="{{ isset($single_data) ? route('update_level0', $single_data->id) : route('storelevel0') }}">
                    @csrf
                    @if(isset($single_data))
                        @method('put') <!-- Use PUT if updating -->
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label class="col-form-label" for="category_l0">Category Level 0 Name</label>
                            <input type="text" name="name" class="form-control" id="category_l0" value="{{ old('name', isset($single_data->name) ? $single_data->name : '') }}" placeholder="Enter Category L0 Name" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
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
                            <th>Name</th>
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
            ajax: '{{ route('category_level0.data') }}',
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
                { data: 'name', name: 'name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
@endsection

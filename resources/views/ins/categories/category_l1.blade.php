@extends('layout.app')
@section('title', 'Add Exams Category')
@section('content')
<div class="row">
    {{-- <div class="col-12">
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
    </div>  --}}
    <div class="position-relative mb-4" style="height:2rem;">
    <div class="w-100 position-absolute top-50 start-50 translate-middle">
        <!-- Progress Bar -->
        <div class="progress" style="height:.25rem;">
            <div class="progress-bar bg-primary" id="progress-tab" role="progressbar"
                @if (request()->routeIs('addlevel0'))
                    style="width: 0%;"
                @elseif (request()->routeIs('category_level1'))
                    style="width: 100%;"
                @elseif (request()->routeIs('edit_level0'))
                    style="width: 0%;"
                @elseif (request()->routeIs('edit_level1'))
                    style="width: 100%;"
                @endif
                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs border-0 w-100 hstack justify-content-between position-absolute top-50 start-50 translate-middle" id="skk-tabs">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ (request()->routeIs('addlevel0')?'active' : (request()->routeIs('edit_level0')?'active':''))}}" href="{{ route('addlevel0')??route('edit_level0') }}">Application Category</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ (request()->routeIs('category_level1')?'active' : (request()->routeIs('edit_level1')?'active':''))}}" href="{{ route('category_level1')??route('edit_level1') }}">Exam Category</a>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->routeIs('course_subcategory') ? 'active' : '' }}" href="{{ route('course_subcategory') }}">Level 2</a>
            </li> --}}
        </ul>
    </div>
</div>
</div>

<div class="row">
    <!-- First Card (Form) -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ isset($single_data) ? 'Edit Exams Category' : 'Add Exams Category' }}</h5>
            </div>
            <div class="card-body">
                <form id="level1Form" method="post" action="{{ isset($single_data) ? route('update_level1', $single_data->id) : route('store_level1') }}">
                    @csrf
                    @if(isset($single_data))
                        @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="col-form-label" for="level0">Application Category</label>
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
                        <div class="col-sm-12">
                            <label class="col-form-label" for="level1">Exams Category</label>
                            <input type="text" name="name" class="form-control" id="level1" placeholder="Enter Exams Category" value="{{ isset($single_data->name) ? $single_data->name : '' }}" />
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
                <h5 class="mb-0">Exams Category</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped shadow-sm" id="categoriesL1Table">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Application Category</th>
                            <th>Exams Category</th>
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

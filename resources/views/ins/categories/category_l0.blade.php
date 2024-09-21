@extends('layout.app')
@section('title', isset($single_data) ? 'Edit Category L0' : 'Add Category L0')
@section('content')

<div class="row">
    {{-- <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Categories</h5>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item col-sm-4 " role="presentation">
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
    </div> --}}
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
                <h5 class="mb-0">{{ isset($single_data) ? 'Edit Application Category' : 'Add Application Category' }}</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form id="category_lo_form" method="post" action="{{ isset($single_data) ? route('update_level0', $single_data->id) : route('storelevel0') }}">
                    @csrf
                    @if(isset($single_data))
                        @method('put')
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label class="col-form-label" for="category_l0">Application Category</label>
                            <input type="text" name="name" class="form-control" id="category_l0" value="{{ old('name', isset($single_data->name) ? $single_data->name : '') }}" placeholder="Enter Application Category" />
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

    <!-- Second Card (Table) -->
    <div class="col-lg-8 col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Application Category</h5>
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


<!--
   • https://getbootstrap.com/docs/5.1/utilities/position/
   • https://getbootstrap.com/docs/5.1/helpers/stacks/#horizontal
   • https://getbootstrap.com/docs/5.1/components/progress/
   • https://getbootstrap.com/docs/5.1/components/navs-tabs/
//-->

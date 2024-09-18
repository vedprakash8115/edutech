@extends('layout.app')
@section('title', 'Roles')
@section('content')
<style>
    /* Custom style for active tab */
    .nav-tabs .nav-link.active {
        color: #fff !important; /* White text color */
        background-color: #17a2b8; /* Bootstrap info color */
        border-color: #17a2b8; /* Border color matching the background */
    }

    .nav-tabs .nav-link {
        border: 1px solid transparent;

        border-radius: .375rem;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Add Roles</h3>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="roleName">Role Name</label>

                            <input type="text" name="name" class="form-control" id="roleName" placeholder="Enter Role Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="permissions" class="text-dark p-1 mb-3">Permissions</label>
                            <div class="row mb-3">
                                <!-- Tabs Navigation -->
                                <div class="col-5 col-sm-3">
                                    <ul class="nav nav-tabs flex-column h-100" id="vert-tabs-tab" role="tablist">
                                        @foreach($dataArray as $key=>$list)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab" data-bs-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                @php
                                                $formattedKeyTitle = ucwords(str_replace('_', ' ', $key));
                                                @endphp
                                                {{ $formattedKeyTitle }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Tabs Content -->
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <b class="float-end m-1">Check all</b>
                                        <input type="checkbox" id="check_all" class="float-end m-2 bo">
                                        @foreach($dataArray as $key=>$item)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
                                            @php
                                            $formattedKey = ucwords(str_replace('_', ' ', $key));
                                            @endphp
                                            <h4>{{ $formattedKey }}</h4>
                                            <hr>
                                            <div class="row">
                                                @foreach ($item as $keyval=>$list)
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permission[]" id="permission_{{ $list->id }}" value="{{ $list->id }}">
                                                        <label class="form-check-label" for="permission_{{ $list->id }}">
                                                            {{ Str::title($list->name) }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        // When the "check_all" checkbox is clicked
        $('#check_all').on('click', function() {
            // Find the closest container and then find all checkboxes within it
            $(this).closest('.tab-content').find('input[type="checkbox"]').prop('checked', this.checked);
        });
    });
</script>
@endpush
@endsection

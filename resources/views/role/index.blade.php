@extends('layout.app')
@section('title', 'Roles')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-secondary align-items-center d-flex justify-content-between">
                        <h3 class="card-title text-light">Role List</h3>
                        <a class="btn btn-success mb-2" href="{{ route('roles.create') }}">Add Roles</a>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $r)
                                    <tr>
                                        <td>{{ $r->name }}</td>
                                        @if ($r->name !== 'Admin')
                                            <td>
                                                <a class="btn btn-info" href="{{ route('roles.edit', ['role' => $r->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                {{-- <a class="btn btn-danger"
                                                    href="{{ route('roles.destroy', ['role' => $r->id]) }}"><i
                                                        class="fa fa-trash"></i></a> --}}
                                            </td>
                                        @else
                                            <td><span class="badge bg-danger">Not Permitted</span></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>



            </div>

        </div>
    @endsection

@extends('layout.app')
@section('title', 'Roles')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Edit Role</h3>
                </div>
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="roleName">Role Name</label>
                            <select name="name" id="name" class="form-control">
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="permission{{ $permission->id }}"
                                                @if($role->permissions->contains($permission->id)) checked @endif>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">{{ $formattedKeyTitle = ucwords(str_replace(['.', '_'], ' ', $permission->name)) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
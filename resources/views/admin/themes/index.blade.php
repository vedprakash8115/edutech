@extends('layout.app')

@section('content')
<h1>Manage Themes</h1>
<a href="" class="btn btn-primary">Add New Theme</a>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Preview</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($themes as $theme)
        <tr>
            <td>{{ $theme->name }}</td>
            <td>
                @if($theme->preview_image)
                <img src="{{ asset('storage/' . $theme->preview_image) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.themes.preview', $theme->id) }}" class="btn btn-secondary">Preview</a>
                <a href="{{ route('admin.themes.activate', $theme->id) }}" class="btn btn-success">Activate</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

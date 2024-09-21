@extends('layout.app')

@section('content')
@livewireStyles
@livewireScripts
{{-- @livewire('tests') --}}
{{ $slot }}
@endsection
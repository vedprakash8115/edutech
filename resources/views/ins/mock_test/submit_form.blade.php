@extends('layout.app')

@section('content')
@livewireStyles
@livewireScripts
@livewire('subject_form')
{{-- {{ $slot }} --}}
@endsection
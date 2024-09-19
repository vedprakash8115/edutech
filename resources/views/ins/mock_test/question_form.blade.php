@extends('layout.app')

@section('content')
@livewireStyles
@livewireScripts
@livewire('question-form')
{{-- {{ $slot }} --}}
@endsection
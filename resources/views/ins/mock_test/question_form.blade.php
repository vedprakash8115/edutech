@extends('layout.app')

@section('content')
@livewireStyles
@livewireScripts
@livewire('question-form')
{{-- {{ $slot }} --}}
@endsection
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endpush
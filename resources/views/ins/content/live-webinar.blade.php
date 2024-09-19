@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Live and Webinar</h1>

    <!-- Start and Schedule Live -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('liveWebinar.start') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Start Live Session</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('liveWebinar.schedule') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-secondary">Schedule Webinar</button>
            </form>
        </div>
    </div>

    <!-- Shareable Link -->
    <div class="mb-4">
        <input type="text" class="form-control" value="{{ url('/shareable-link') }}" readonly>
        <button class="btn btn-outline-primary mt-2" onclick="copyLink()">Copy Link</button>
    </div>

    <!-- Ongoing Classes -->
    <div class="mb-4">
        <h2>Ongoing Classes</h2>
        <ul class="list-group">
            <!-- Loop through ongoing classes -->
            <!-- @foreach ($ongoingClasses as $class) -->
            <!-- <li class="list-group-item">{{ $class->title }}</li> -->
            <!-- @endforeach -->
        </ul>
    </div>

    <!-- Upcoming Classes -->
    <div class="mb-4">
        <h2>Upcoming Classes</h2>
        <ul class="list-group">
            <!-- Loop through upcoming classes -->
            <!-- @foreach ($upcomingClasses as $class) -->
            <!-- <li class="list-group-item">{{ $class->title }}</li> -->
            <!-- @endforeach -->
        </ul>
    </div>
</div>

@section('scripts')
<script>
    function copyLink() {
        const link = document.querySelector('input[type="text"]');
        link.select();
        document.execCommand('copy');
        alert('Link copied to clipboard!');
    }
</script>
@endsection
@endsection

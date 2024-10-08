@extends('user-account.layout.app')

@section('content')
<div class="card py-4" style="border-radius: 5px; margin:0;">
    <div class="card-body">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h1 class="h3 mb-4 text-blue-800 fw-light">Query Room {{ $ticket->id }}</h1>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-blue-600 mb-2 fw-light">{{ $ticket->subject }}</h5>
                            <p class="mb-1"><small class="text-blue-500">Category: {{ $ticket->category->name }}</small></p>
                            <p class="mb-1"><small class="text-blue-500">Created: {{ $ticket->created_at->format('d-m-Y H:i') }}</small></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge bg-{{ $ticket->status == 'open' ? 'teal' : 'gray' }} mb-2">
                                {{ ucfirst($ticket->status) }}
                            </span>
                            <span class="badge bg-{{ $ticket->priority == 'high' ? 'coral' : ($ticket->priority == 'medium' ? 'orange' : 'cyan') }} mb-2">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
                    </div>
                    <div class="bg-blue-100 p-3 rounded mb-4">
                        <h6 class="text-blue-700 mb-2 fw-light">Description:</h6>
                        <p class="mb-0 fw-light text-blue-800">{{ $ticket->description }}</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-4 text-blue-800 fw-light">Conversation</h2>
                    <div id="messageContainer" class="custom-scrollbar" style="max-height: 400px; overflow-y: auto;">
                        <div id="messages">
                            @foreach($ticket->messages as $message)
                                <div class="mb-3 pb-3 border-bottom border-blue-200">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="fw-light text-blue-700">{{ $message->sender->name }}</strong>
                                        <small class="text-blue-500">{{ $message->created_at->format('d-m-Y H:i') }}</small>
                                    </div>
                                    <p class="mb-0 fw-light text-blue-800">{{ $message->message }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @php
                $lastMessage = $ticket->messages->last();
                $senderId = $lastMessage->sender_id ?? null;
                $senderUser = $senderId ? \App\Models\User::find($senderId) : null;
            @endphp

            @if($ticket->status == 'resolved' || $ticket->status == 'close' && $senderUser && $senderUser->hasRole('agent'))
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="h5 mb-4 text-blue-800 fw-light">Satisfaction</h2>
                        <p class="fw-light text-blue-700">Are you satisfied with the resolution?</p>
                        <div class="d-flex gap-2">
                            <form id="satisfiedForm" class="w-100">
                                <button type="submit" class="btn btn-outline-teal w-100" id="satisfiedBtn">
                                    <i class="fas fa-thumbs-up me-2"></i>Satisfied
                                </button>
                            </form>
                            <form action="{{ route('student.support.reopen', $ticket->id) }}" method="POST" id="unsatisfiedForm" class="w-100">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-coral w-100" id="unsatisfiedBtn">
                                    <i class="fas fa-thumbs-down me-2"></i>Unsatisfied
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card shadow-sm {{ $ticket->status == 'resolved' ? 'd-none' : '' }}" id="replyCard">
                <div class="card-body">
                    <h2 class="h5 mb-4 text-blue-800 fw-light">Enter your query</h2>
                    <form action="{{ route('student.support.reply', $ticket->id) }}" method="POST" id="replyForm">
                        @csrf
                        <div class="mb-3">
                            <textarea name="message" id="messageInput" class="form-control fw-light bg-blue-50 text-blue-800" rows="3" required placeholder="Type your reply here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-blue">
                            <i class="fas fa-paper-plane me-2"></i>Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('user-account.content.footer')
@include('user-account.content.fixed_button')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    // JavaScript remains the same as in the original code
</script>
@endpush

@push('styles')
<style>
    body {
        background-color: #f7fafc;
        font-family: 'Roboto', sans-serif;
        color: #2c5282;
    }
    .card {
        background-color: #ffffff;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        font-weight: 400;
    }
    .btn-outline-teal {
        color: #319795;
        border-color: #319795;
    }
    .btn-outline-teal:hover {
        background-color: #319795;
        color: #ffffff;
    }
    .btn-outline-coral {
        color: #fc8181;
        border-color: #fc8181;
    }
    .btn-outline-coral:hover {
        background-color: #fc8181;
        color: #ffffff;
    }
    .btn-blue {
        background-color: #3182ce;
        border-color: #3182ce;
        color: #ffffff;
    }
    .btn-blue:hover {
        background-color: #2c5282;
        border-color: #2c5282;
    }
    .bg-teal {
        background-color: #319795;
    }
    .bg-coral {
        background-color: #fc8181;
    }
    .bg-orange {
        background-color: #fbd38d;
    }
    .bg-cyan {
        background-color: #76e4f7;
    }
    .bg-gray {
        background-color: #a0aec0;
    }
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #e2e8f0 #ffffff;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #ffffff;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #e2e8f0;
        border-radius: 3px;
    }
    .fw-light {
        font-weight: 300 !important;
    }
    .text-blue-500 {
        color: #4299e1;
    }
    .text-blue-600 {
        color: #3182ce;
    }
    .text-blue-700 {
        color: #2b6cb0;
    }
    .text-blue-800 {
        color: #2c5282;
    }
    .bg-blue-50 {
        background-color: #ebf8ff;
    }
    .bg-blue-100 {
        background-color: #bee3f8;
    }
    .border-blue-200 {
        border-color: #90cdf4;
    }
</style>
@endpush

@endsection
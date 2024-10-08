@extends('layout.app')

@section('content')
<div class="card p-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="display-4 text-center mb-5 text-primary">Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</h1>

            <div class="row">
                <!-- Ticket Information -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h5 mb-0 text-white">
                                <i class="fas fa-info-circle me-2"></i> Ticket Information
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-muted">Category</h6>
                                    <p class="font-weight-bold">{{ $ticket->category->name }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-muted">Student</h6>
                                    <p class="font-weight-bold">{{ $ticket->user->name }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-muted">Status</h6>
                                    <span class="badge bg-{{ $ticket->status == 'open' ? 'success' : ($ticket->status == 'in_progress' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-muted">Priority</h6>
                                    <span class="badge bg-{{ $ticket->priority == 'low' ? 'info' : ($ticket->priority == 'medium' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </div>
                            </div>
                            <h6 class="text-muted">Description</h6>
                            <p>{{ $ticket->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Assign Agent Form -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h5 mb-0 text-white">
                                <i class="fas fa-user-plus me-2"></i> Assign to Agent
                            </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.support.assign', $ticket->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="assigned_to" class="form-label">Assign to</label>
                                    <select name="assigned_to" id="assigned_to" class="form-select">
                                        <option value="">Select Agent</option>
                                        @foreach($agents as $agent)
                                            <option value="{{ $agent->id }}" {{ $ticket->assigned_to == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-check me-2"></i> Assign
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h2 class="h5 mb-0 text-white">
                        <i class="fas fa-comments me-2"></i> Messages
                    </h2>
                </div>
                <div class="card-body">
                    <div id="messages-container">
                        @foreach($ticket->messages as $message)
                            <div class="message bg-light p-3 rounded mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>{{ $message->sender->name }}</strong>
                                    <div>
                                        <small class="text-muted">{{ $message->created_at->format('d-m-Y H:i') }}</small>
                                    </div>
                                </div>
                                <p class="mb-0">{{ $message->message }}</p>
                                
                                {{-- Check if there are any attachments for the message --}}
                                @if($message->attachments->isNotEmpty())
                                    <div class="mt-2">
                                        <strong>Attachments:</strong>
                                        <ul class="list-unstyled">
                                            @foreach($message->attachments as $attachment)
                                                <li class="mt-2">
                                                    {{-- Display file in iframe if it's a PDF or image --}}
                                                    @if(in_array(pathinfo($attachment->file_path, PATHINFO_EXTENSION), ['pdf', 'jpg', 'jpeg', 'png']))
                                                        <iframe src="{{ asset($attachment->file_path) }}" style="width:50%; height:200px;" frameborder="0"></iframe>
<br>
                                                        <a href="{{ asset($attachment->file_path) }}" target="_blank" class="text-info">
                                                            {{ basename($attachment->file_path) }}
                                                        </a>
                                                    @else
                                                        {{-- For other file types, show download link --}}
                                                        <a href="{{ asset($attachment->file_path) }}" target="_blank" class="text-info">
                                                            {{ basename($attachment->file_path) }}
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Update Status Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-info text-dark">
                    <h2 class="h5 mb-0 text-white">
                        <i class="fas fa-tasks me-2"></i> Update Status
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.support.status', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-sync-alt me-2"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Message Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMessageForm">
                    @csrf
                    <input type="hidden" id="editMessageId" name="id">
                    <div class="mb-3">
                        <label for="editMessageContent" class="form-label">Message</label>
                        <textarea id="editMessageContent" name="message" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Message Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this message?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button onclick="deleteMessage()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- New Message Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMessageModalLabel">New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newMessageForm">
                    @csrf
                    <div class="mb-3">
                        <label for="newMessageContent" class="form-label">Message</label>
                        <textarea id="newMessageContent" name="message" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openEditModal(messageId) {
        // Fetch message content and populate the form
        document.getElementById('editMessageId').value = messageId;
        document.getElementById('editMessageContent').value = 'Fetched message content';
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }

    function openDeleteModal(messageId) {
        // Set the message ID for deletion
        window.messageToDelete = messageId;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    function deleteMessage() {
        // Perform delete action
        console.log('Deleting message:', window.messageToDelete);
        var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        deleteModal.hide();
    }

    function openNewMessageModal() {
        var newMessageModal = new bootstrap.Modal(document.getElementById('newMessageModal'));
        newMessageModal.show();
    }

    // Form submission handlers
    document.getElementById('editMessageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Handle edit message submission
        var editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        editModal.hide();
    });

    document.getElementById('newMessageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Handle new message submission
        var newMessageModal = bootstrap.Modal.getInstance(document.getElementById('newMessageModal'));
        newMessageModal.hide();
    });
</script>
@endsection
@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h1>Edit Notification</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <form id="notificationForm" action="{{ route('notification.update', $notification->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required maxlength="255" value="{{ $notification->title }}">
                    <small class="form-text text-muted"><span id="titleCounter">{{ strlen($notification->title) }}</span>/255</small>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" required maxlength="1000">{{ $notification->message }}</textarea>
                    <small class="form-text text-muted"><span id="messageCounter">{{ strlen($notification->message) }}</span>/1000</small>
                </div>
                <div class="form-group">
                    <label for="link_url">Link URL</label>
                    <input type="url" class="form-control" id="link_url" name="link_url" value="{{ $notification->link_url }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    @if($notification->image_path)
                        <img src="{{ asset($notification->image_path) }}" alt="Notification Image" class="img-fluid mt-2">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Notification</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Notification Preview</div>
                <div class="card-body">
                    <h5 id="previewTitle">{{ $notification->title }}</h5>
                    <p id="previewMessage">{{ $notification->message }}</p>
                    <a id="previewLink" href="{{ $notification->link_url }}" target="_blank">{{ $notification->link_url ? 'View Link' : '' }}</a>
                    <img id="previewImage" src="{{ $notification->image_path ? asset($notification->image_path) : '' }}" alt="Notification Image" class="img-fluid mt-2" style="display: {{ $notification->image_path ? 'block' : 'none' }};">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Title:</h6>
                <p id="modalTitle">{{ $notification->title }}</p>
                <h6>Message:</h6>
                <p id="modalMessage">{{ $notification->message }}</p>
                <h6>Link URL:</h6>
                <p id="modalLink">{{ $notification->link_url }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSend">Update Notification</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Character counters
        $('#title, #message').on('input', function() {
            const id = $(this).attr('id');
            $(`#${id}Counter`).text($(this).val().length);
        });

        // Live preview
        $('#title, #message, #link_url').on('input', function() {
            $('#previewTitle').text($('#title').val());
            $('#previewMessage').text($('#message').val());
            const linkUrl = $('#link_url').val();
            if (linkUrl) {
                $('#previewLink').attr('href', linkUrl).text('View Link').show();
            } else {
                $('#previewLink').hide();
            }
        });

        // Form submission and confirmation modal
        $('#notificationForm').on('submit', function(e) {
            e.preventDefault();
            $('#modalTitle').text($('#title').val());
            $('#modalMessage').text($('#message').val());
            $('#modalLink').text($('#link_url').val() || 'None');
            $('#confirmationModal').modal('show');
        });

        $('#confirmSend').click(function() {
            $('#notificationForm')[0].submit();
        });
    });
</script>
@endpush

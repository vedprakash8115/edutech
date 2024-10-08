@extends('user-account.layout.app')

@section('content')

   
        <div class="col-md-12">
            <div class="card shadow-lg border-0" style="border-radius:5px; margin:0;" >
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0 text-white"><i class="fas fa-ticket-alt me-2"></i>Create Query chatroom</h2>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('student.support.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select name="priority" id="priority" class="form-select" required>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Create Chatroom
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
@include('user-account.content.footer')
@include('user-account.content.fixed_button')
    

@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .form-control, .form-select {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    // You can add any additional JavaScript here if needed
</script>
@endpush
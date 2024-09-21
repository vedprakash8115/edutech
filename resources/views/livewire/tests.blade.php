<div class="col-md-12">
    {{-- @livewire('navbar')
    @livewire('sidebar') --}}
    @livewire('header')
   
    
<div class="card ">
    <div class="card-body">
       
        <div class="card-title">Create Test</div>
    <form wire:submit.prevent="store">
        <!-- Title -->
        <div class="row">
        <div class="form-group mb-3 col-md-6">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" wire:model="title" placeholder="Enter test title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Description -->
        <div class="form-group mb-3 col-md-6">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" wire:model="description" placeholder="Enter test description"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
        <!-- Duration -->
        <div class="row">
        <div class="form-group mb-3 col-md-6">
            <label for="duration">Duration (minutes)</label>
            <input type="number" class="form-control" id="duration" wire:model="duration" min="1">
            @error('duration') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Total Marks -->
        <div class="form-group mb-3 col-md-6">
            <label for="total_marks">Total Marks</label>
            <input type="number" class="form-control" id="total_marks" wire:model="total_marks" min="1">
            @error('total_marks') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
        <!-- Total Questions -->
        <div class="row">
        <div class="form-group mb-3 col-md-6">
            <label for="total_questions">Total Questions</label>
            <input type="number" class="form-control" id="total_questions" wire:model.live="total_questions" min="1">
            @error('total_questions') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Passing Score -->
        <div class="form-group mb-3 col-md-6">
            <label for="passing_score">Passing Score</label>
            <input type="number" class="form-control" id="passing_score" wire:model="passing_score" min="0">
            @error('passing_score') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
    </div>
       <!-- Time Limit -->
       <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="time_limit">Time Limit per Question (optional)</label>
                    <input type="number" class="form-control" id="time_limit" wire:model="time_limit" min="1" placeholder="Enter time limit in minutes">
                    @error('time_limit') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="passing_score">Number of subjects</label>
                    <input type="number" class="form-control" id="number_of_subjects" wire:model="number_of_subjects" min="1">
                    @error('passing_score') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <!-- Is Randomized -->
                <div class="form-group mb-3 col-md-6">
                    <label for="is_randomized">Randomize Questions?</label>
                    <input type="checkbox" id="is_randomized" wire:model="is_randomized">
                    @error('is_randomized') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

                <!-- Has Negative Marks -->
                <div class="row">
                <div class="form-group mb-3 col-md-6" >
                    <label for="has_negative_marks">Allow Negative Marks?</label>
                    <input type="checkbox" id="has_negative_marks" wire:model.live="has_negative_marks">
                    @error('has_negative_marks') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <!-- Negative Marks Value (only visible if has_negative_marks is true) -->
                @if($has_negative_marks)
                <div class="form-group mb-3 col-md-6">
                    <label for="negative_marks">Negative Marks Value (per incorrect answer)</label>
                    <input type="number" class="form-control" id="negative_marks" wire:model="negative_marks" min="0" step="0.01" placeholder="Enter negative marks value">
                    @error('negative_marks') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>
                <!-- Allow Optional Questions -->
                <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="allow_optional_questions">Allow Optional Questions?</label>
                    <input type="checkbox" id="allow_optional_questions" wire:model.live="allow_optional_questions">
                    @error('allow_optional_questions') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <!-- Question Attempt (only visible if allow_optional_questions is true) -->
                @if($allow_optional_questions)
                <div class="form-group mb-3 col-md-6">
                    <label for="question_attempt">Number of Questions to Attempt</label>
                    <input type="number" class="form-control" id="question_attempt" wire:model="question_attempt" min="1" max="{{ $total_questions }}" placeholder="Enter number of questions to attempt">
                    @error('question_attempt') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @endif
        </div>
                <!-- Image Upload -->
                
                
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">
                            Create Test
                        </span>
                        <span wire:loading.class wire:loading.class.remove = "d-none" = "d-flex" wire:target="store" class="d-none align-items-center">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            <span class="visually-hidden">Loading...</span>
                            Submitting...
                        </span>
                    </button>
                </div>
                    {{-- <div class="d-flex justify-content-center"  wire:loading> --}}
                      
                    {{-- </div> --}}
                </div>
            </form>
        
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
           <!-- SweetAlert script to listen for events -->
    <script>
        window.addEventListener('swal', function(e) {
            Swal.fire({
                title: e.detail.title,
                icon: e.detail.icon,
                iconColor: e.detail.iconColor,
                timer: 3000,
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
            });
        });
    </script>
            </div>
        </div>
    </div>

<div class="col-md-12">
    @livewire('header')
    <div class="card py-2">
        <div class="card-body">
            <div class="card-title">Create Subjects</div>
            <form wire:submit.prevent="store">
                <!-- Test Dropdown -->
                <div class="form-group mb-4">
                    <label for="test_id" class="form-label">Select Test</label>
                    <select class="form-select" id="test_id" wire:model.live="test_id">
                        <option value="">Choose a Test</option>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}">{{ $test->title }}</option>
                        @endforeach
                    </select>
                    @error('test_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            
                <!-- Subjects Input Forms -->
                <div class="row">
                    @if($subjects && count($subjects) > 0)
                        @foreach($subjects as $index => $subject)
                            <div class="col-md-6">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Subject {{$index + 1}}</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" wire:model="subjects.{{ $index }}.id">
                                        
                                        <div class="mb-3">
                                            <label for="subjects.{{ $index }}.name" class="form-label">Subject Name</label>
                                            <input type="text" class="form-control" id="subjects.{{ $index }}.name" wire:model="subjects.{{ $index }}.name" placeholder="Enter subject name">
                                            @error("subjects.$index.name") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
            
                                        <div class="mb-3">
                                            <label for="subjects.{{ $index }}.description" class="form-label">Description</label>
                                            <textarea class="form-control" id="subjects.{{ $index }}.description" wire:model="subjects.{{ $index }}.description" placeholder="Enter description (optional)" rows="3"></textarea>
                                            @error("subjects.$index.description") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
            
                                        <div class="mb-3 form-check">
                                            <input class="form-check-input" type="checkbox" id="subjects.{{ $index }}.has_optional" wire:model.live="subjects.{{ $index }}.has_optional">
                                            <label class="form-check-label" for="subjects.{{ $index }}.has_optional">
                                                Has Optional Questions
                                            </label>
                                            @error("subjects.$index.has_optional") <span class="text-danger d-block">{{ $message }}</span> @enderror
                                        </div>
            
                                        @if(isset($subjects[$index]['has_optional']) && $subjects[$index]['has_optional'])
                                            <div class="mb-3">
                                                <label for="subjects.{{ $index }}.number_optional_questions" class="form-label">Number of Optional Questions</label>
                                                <input type="number" class="form-control" id="subjects.{{ $index }}.number_optional_questions" wire:model.live="subjects.{{ $index }}.number_optional_questions" min="0">
                                                @error("subjects.$index.number_optional_questions") <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        @endif
            
                                        <div class="mb-3">
                                            <label for="subjects.{{ $index }}.number_of_questions" class="form-label">Number of Questions</label>
                                            <input type="number" class="form-control" id="subjects.{{ $index }}.number_of_questions" wire:model="subjects.{{ $index }}.number_of_questions" min="1" placeholder="Enter number of questions">
                                            @error("subjects.$index.number_of_questions") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Show message only when subjects array is empty -->
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                No subjects available. Please select a test first.
                            </div>
                        </div>
                    @endif
                </div>
            
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">
                            Create Subjects
                        </span>
                        <span wire:loading.class wire:loading.class.remove = "d-none" = "d-flex" wire:target="store" class="d-none align-items-center">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            <span class="visually-hidden">Loading...</span>
                            Submitting...
                        </span>
                    </button>
                </div>
            </form>
            
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>

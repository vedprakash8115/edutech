<div class="col-md-12">
    <div class="card my-4">
        <div class="card-body">
            <div class="card-title">Flow Chart for mock test creation</div>
            <div class="card-text">
                <button class="btn btn-primary"><a href="{{ route('mock') }}" class="text-white">Create Test</a></button>
                <i class="fas fa-arrow-right"></i>
                <button class="btn btn-secondary"><a href="{{ route('mock.subject_form') }}" class="text-white">Create Subjects</a></button>
                <i class="fas fa-arrow-right"></i>
                <button class="btn btn-info">Create Questions</button>
                <i class="fas fa-arrow-right"></i>
                <button class="btn btn-success">Create Options</button>
            </div>
        </div>
        <div class="card-body">
            <div class="card-title">Hints</div>
            <ul class="list-group">
                <li class="list-item">Create the test section firstly</li>
                <li class="list-item">Create the subjects section for the test</li>
                <li class="list-item">Create questions for the test</li>
                <li class="list-item">Create options for the test (only in MCQ)</li>
            </ul>
        </div>
    </div>
    <div class="card py-2">
        <div class="card-body">
            <div class="card-title">Create Subjects</div>
            <form wire:submit.prevent="store">
                <!-- Test Dropdown -->
                <div class="form-group mb-3">
                    <label for="test_id">Select Test</label>
                    <select class="form-control" id="test_id" wire:model.live="test_id">
                        <option value="">Choose a Test</option>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}">{{ $test->title }}</option>
                        @endforeach
                    </select>
                    @error('test_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
        
                <!-- Subjects Input Forms -->
                <div class="row">
                @forelse($subjects as $index => $subject)
                <div class="col-md-6">
                    <div class="card mb-3 ">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="subjects.{{ $index }}.name">Subject {{$index}}</label>
                                <input type="text" class="form-control" id="subjects.{{ $index }}.name" wire:model="subjects.{{ $index }}.name" placeholder="Enter subject name">
                                @error("subjects.$index.name") <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subjects.{{ $index }}.description">Description</label>
                                <textarea class="form-control" id="subjects.{{ $index }}.description" wire:model="subjects.{{ $index }}.description" placeholder="Enter description (optional)"></textarea>
                                @error("subjects.$index.description") <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subjects.{{ $index }}.has_optional" wire:model="subjects.{{ $index }}.has_optional">
                                    <label class="form-check-label" for="subjects.{{ $index }}.has_optional">
                                        Has Optional Questions?
                                    </label>
                                </div>
                                @error("subjects.$index.has_optional") <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subjects.{{ $index }}.number_of_questions">Number of Questions</label>
                                <input type="number" class="form-control" id="subjects.{{ $index }}.number_of_questions" wire:model="subjects.{{ $index }}.number_of_questions" min="1" placeholder="Enter number of questions">
                                @error("subjects.$index.number_of_questions") <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                @empty
                    <p>No subjects available. Please select a test first.</p>
                @endforelse
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

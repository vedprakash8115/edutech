<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        @livewire('header')
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar for question numbers -->
                <div class="list-group">
                    @if($questions)
                        @for ($i = 1; $i <= $questions; $i++)
                            <a href="#" class="list-group-item list-group-item-action {{ $activeQuestion === $i - 1 ? 'active' : '' }}" wire:click.prevent="setActiveQuestion({{ $i - 1 }})">
                                <div class="d-flex justify-content-between">
                                    <span>Question {{ $i }}</span>
                                    <span class="badge bg-primary rounded-pill">{{ $i }}</span>
                                </div>
                            </a>
                        @endfor
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <form wire:submit.prevent="store">
                    <!-- Test Dropdown -->
                    <div class="form-group mb-3">
                        <label for="test_id">Select Test</label>
                        <select class="form-select" id="test_id" wire:model.live="test_id">
                            <option value="">Choose a Test</option>
                            @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->title }}</option>
                            @endforeach
                        </select>
                        @error('test_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                
                    <!-- Subject Dropdown -->
                    @if($test_id)
                        <div class="form-group mb-3">
                            <label for="subject_id">Select Subject</label>
                            <select class="form-select" id="subject_id" wire:model.live="subject_id">
                                <option value="">Choose a Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    @endif
                
                    <!-- Progress Bar -->
                    @if($subject_id && $questions > 0)
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: {{ ($activeQuestion + 1) / $questions * 100 }}%;" aria-valuenow="{{ $activeQuestion + 1 }}" aria-valuemin="0" aria-valuemax="{{ $questions }}">
                                Question {{ $activeQuestion + 1 }} of {{ $questions }}
                            </div>
                        </div>
                    @endif
                
                    <!-- Questions -->
                    @if($subject_id)
                        <div class="form-group mb-3">
                            @for ($i = 0; $i < $questions; $i++)
                                @if ($activeQuestion === $i)
                                    <div class="card mb-3" wire:key="question-card-{{ $i }}">
                                        <div class="card-header">
                                            <h5 class="card-title">Question {{ $i + 1 }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Question Text -->
                                            <div class="form-group mb-3">
                                                <label for="question_text_{{ $i }}">Question Text</label>
                                                <textarea class="form-control" id="question_text_{{ $i }}" wire:model.live="quesarray.{{ $i }}.question_text" rows="3"></textarea>
                                                @error("quesarray.$i.question_text") <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <!-- Question Type -->
                                            <div class="form-group mb-3">
                                                <label for="question_type_{{ $i }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Select the type of question">
                                                    Question Type
                                                </label>
                                                <select class="form-select" id="question_type_{{ $i }}" wire:model.live="quesarray.{{ $i }}.question_type">
                                                    <option value="">Select Type</option>
                                                    <option value="multiple_choice">Multiple Choice</option>
                                                    <option value="true_false">True/False</option>
                                                    <option value="short_answer">Short Answer</option>
                                                    <option value="essay">Essay</option>
                                                </select>
                                                @error("quesarray.$i.question_type") <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                
                                            <!-- Additional fields based on question type -->
                                            @if ($quesarray[$i]['question_type'] === 'multiple_choice')
                                                <div class="row">
                                                    @foreach (['a', 'b', 'c', 'd'] as $option)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="input-group">
                                                                <span class="input-group-text">Option {{ strtoupper($option) }}</span>
                                                                <input type="text" class="form-control" id="{{ $option }}_text_{{ $i }}" wire:model.live="quesarray.{{ $i }}.options.{{ $option }}.text">
                                                            </div>
                                                            @error("quesarray.$i.options.$option.text") <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <input type="file" class="form-control" id="{{ $option }}_image_{{ $i }}" wire:model.live="option_images.{{ $i }}.{{ $option }}">
                                                            @error("option_images.$i.$option") <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    @endforeach
                                                </div>
                                                
                                                <!-- Answer Selection -->
                                                <div class="form-group mb-3">
                                                    <label for="answer_{{ $i }}">Answer</label>
                                                    <select class="form-select" id="answer_{{ $i }}" wire:model.live="quesarray.{{ $i }}.answer">
                                                        <option value="">Choose Answer</option>
                                                        <option value="a">Option A</option>
                                                        <option value="b">Option B</option>
                                                        <option value="c">Option C</option>
                                                        <option value="d">Option D</option>
                                                    </select>
                                                    @error("quesarray.$i.answer") <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            @elseif ($quesarray[$i]['question_type'] === 'true_false')
                                                <!-- Is True Selection -->
                                                <div class="form-group mb-3" wire:key="is_true-{{ $i }}">
                                                    <label for="is_true_{{ $i }}">Is True</label>
                                                    <select id="is_true_{{ $i }}" wire:model.live="quesarray.{{ $i }}.is_true" class="form-select">
                                                        <option value="">Select</option>
                                                        <option value="1">True</option>
                                                        <option value="0">False</option>
                                                    </select>
                                                    @error("quesarray.$i.is_true") <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            @endif
                
                                            <!-- Marks -->
                                            <div class="form-group mb-3">
                                                <label for="marks_{{ $i }}">Marks</label>
                                                <input type="number" class="form-control" id="marks_{{ $i }}" wire:model.live="quesarray.{{ $i }}.marks" min="1" max="100">
                                                @error("quesarray.$i.marks") <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                    
                                            <!-- Question Image -->
                                            <div class="form-group mb-3">
                                                <label for="question_image_{{ $i }}">Question Image</label>
                                                <input type="file" class="form-control" id="question_image_{{ $i }}" wire:model.live="question_images.{{ $i }}">
                                                @error("question_images.$i") <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                    
                                            <!-- Optional Checkbox -->
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="is_optional_{{ $i }}" wire:model.live="quesarray.{{ $i }}.is_optional">
                                                <label class="form-check-label" for="is_optional_{{ $i }}">Optional</label>
                                                @error("quesarray.$i.is_optional") <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endif
                
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                            Submit
                        </button>
                        <div wire:loading wire:target="store" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    {{-- <button wire:click="saveQuestion({{ $index }})" class="btn btn-primary">Save Question</button> --}}
                </form>
                {{-- <div>
                    <form wire:submit.prevent="importCsv">
                        <div class="form-group">
                            <label for="test_id">Select Test</label>
                            <select class="form-control" id="test_id" wire:model.live="test_id">
                                <option value="">Select a test</option>
                                <!-- Add options for tests -->
                                @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->title }}</option>
                            @endforeach
                            </select>
                            @error('test_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="subject_id">Select Subject</label>
                            <select class="form-select" id="subject_id" wire:model.live="subject_id">
                                <option value="">Choose a Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="csv_file">Import CSV</label>
                            <input type="file" class="form-control" id="csv_file" wire:model.live="csv_file" accept=".csv">
                            @error('csv_file') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                
                        <button type="submit" class="btn btn-primary" {{ !$test_id || !$subject_id ? 'disabled' : '' }}>
                            Import CSV
                        </button>
                    </form>
                
                 
                </div> --}}
                
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit all questions?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="store" data-bs-dismiss="modal">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
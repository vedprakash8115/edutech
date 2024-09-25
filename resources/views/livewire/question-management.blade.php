<div class="container-fluid" x-data="{ activeTab: 'manual' }">
    <h2 class="mb-4">Question Management</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'manual' }" @click="activeTab = 'manual'" href="#">Manual Entry</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'import' }" @click="activeTab = 'import'" href="#">CSV Import</a>
        </li>
    </ul>

    <div x-show="activeTab === 'manual'">
        <form wire:submit.prevent="saveQuestions">
            @foreach ($subjects as $subject)
                <div class="card mb-4" data-aos="fade-up">
                    <div class="card-header">
                        <h3>{{ $subject->name }}</h3>
                        <p>Questions: {{ count($questions[$subject->id] ?? []) }} / {{ $subject->number_of_questions }}</p>
                    </div>
                    <div class="card-body">
                        @foreach ($questions[$subject->id] ?? [] as $index => $question)
                            <div class="question-container mb-4 p-3 border rounded">
                                <div class="form-group">
                                    <label>Question Text</label>
                                    <textarea class="form-control" wire:model.live="questions.{{ $subject->id }}.{{ $index }}.question_text"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Question Type</label>
                                        <select class="form-control" wire:model.live="questions.{{ $subject->id }}.{{ $index }}.question_type">
                                            <option value="multiple_choice">Multiple Choice</option>
                                            <option value="true_false">True/False</option>
                                            <option value="short_answer">Short Answer</option>
                                            <option value="essay">Essay</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Difficulty Level</label>
                                        <select class="form-control" wire:model.live="questions.{{ $subject->id }}.{{ $index }}.difficulty_level">
                                            <option value="">Select Difficulty</option>
                                            <option value="easy">Easy</option>
                                            <option value="medium">Medium</option>
                                            <option value="hard">Hard</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Marks</label>
                                        <input type="number" class="form-control" wire:model.live="questions.{{ $subject->id }}.{{ $index }}.marks">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Optional</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="optional{{ $subject->id }}{{ $index }}" wire:model.live="questions.{{ $subject->id }}.{{ $index }}.is_optional">
                                            <label class="custom-control-label" for="optional{{ $subject->id }}{{ $index }}">Is Optional</label>
                                        </div>
                                    </div>
                                </div>
                                @if ($question['question_type'] === 'multiple_choice')
                                    <div class="options-container">
                                        @foreach ($question['options'] as $optionIndex => $option)
                                            <div class="form-group">
                                                <label>Option {{ $option['key'] }}</label>
                                                <input type="text" class="form-control" wire:model.live="questions.{{ $subject->id }}.{{ $index }}.options.{{ $optionIndex }}.text">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm" wire:click="removeQuestion({{ $subject->id }}, {{ $index }})">
                                    <i class="fas fa-trash"></i> Remove Question
                                </button>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-primary" wire:click="addQuestion({{ $subject->id }})">
                            <i class="fas fa-plus"></i> Add Question
                        </button>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save Questions
            </button>
        </form>
    </div>

    <div x-show="activeTab === 'import'">
        <form wire:submit.prevent="importCsv">
            <div class="form-group">
                <label for="csvFile">Upload CSV File</label>
                <input type="file" class="form-control-file" id="csvFile" wire:model.live="csvFile">
                @error('csvFile') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-file-import"></i> Import CSV
            </button>
        </form>
    </div>
</div>
```

For the best user experience, you should include the following libraries in your layout or main template:

1. Bootstrap CSS and JS
2. Font Awesome
3. Alpine.js
4. AOS (Animate on Scroll)

Here's an example of how to include these in your layout:

<antArtifact identifier="layout-head" type="application/vnd.ant.code" language="html" title="Layout Head Section">
<head>
    <!-- ... other meta tags and title ... -->
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @livewireStyles
</head>
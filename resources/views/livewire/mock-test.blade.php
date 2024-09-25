<div class="container-fluid h-100">
    <div class="row h-100">
        <!-- Sidebar -->
        <div class="col-md-3 bg-light sidebar">
            <div class="p-3">
                @if (!$testStarted)
                    <h3 class="mb-4">Select a Test</h3>
                    <select wire:model.live="selectedTestId" class="form-select mb-4">
                        <option value="">Choose a test</option>
                        @foreach ($tests as $testOption)
                            <option value="{{ $testOption->id }}">{{ $testOption->title }}</option>
                        @endforeach
                    </select>
                @endif

                @if ($testStarted)
                    <h3 class="mb-4">{{ $test->title }}</h3>
                    <div class="mb-4">
                        <h5>Subjects</h5>
                        @foreach ($subjects as $subject)
                            <button wire:click="$set('selectedSubject', {{ $subject->id }})" 
                                    class="btn btn-sm {{ $selectedSubject == $subject->id ? 'btn-primary' : 'btn-outline-primary' }} me-2 mb-2">
                                {{ $subject->name }}
                            </button>
                        @endforeach
                    </div>
                    @if ($questions && $questions->count() > 0)
                        <div class="mb-4">
                            <h5>Questions</h5>
                            <div class="row g-2">
                                @foreach ($questions as $index => $question)
                                    <div class="col-3">
                                        <button wire:click="$set('currentQuestionIndex', {{ $index }})"
                                                class="btn btn-sm {{ $index === $currentQuestionIndex ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                                            {{ $index + 1 }}
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Main content -->
        <div class="col-md-9 main-content">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if ($testStarted)
                        <h2>{{ $subjects->find($selectedSubject)->name }}</h2>
                        <div class="timer">
                            Time Remaining: <span x-data="{ time: @entangle('timeRemaining') }" x-init="setInterval(() => { if(time > 0) time--; if(time === 0) $wire.submitTest(); }, 1000)" x-text="Math.floor(time / 60) + ':' + (time % 60).toString().padStart(2, '0')"></span>
                        </div>
                    @else
                        <h2>Mock Test</h2>
                    @endif
                </div>
                <div class="card-body">
                    @if (!$testStarted)
                        <div class="text-center">
                            <h3>Welcome to the Mock Test</h3>
                            <p>Please select a test from the sidebar to begin.</p>
                        </div>
                    @elseif (!$testCompleted)
                        @php $currentQuestion = $this->getCurrentQuestion(); @endphp
                        @if ($currentQuestion)
                            <div class="question-container">
                                <h4>Question {{ $currentQuestionIndex + 1 }}</h4>
                                <p class="lead">{{ $currentQuestion->question_text }}</p>

                                @if ($currentQuestion->question_type === 'multiple_choice')
                                    @foreach ($currentQuestion->options as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer" id="option{{ $option->id }}"
                                                   wire:model="userAnswers.{{ $currentQuestion->id }}" value="{{ $option->id }}">
                                            <label class="form-check-label" for="option{{ $option->id }}">
                                                {{ $option->text }}
                                            </label>
                                        </div>
                                    @endforeach
                                @elseif ($currentQuestion->question_type === 'true_false')
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer" id="true"
                                               wire:model="userAnswers.{{ $currentQuestion->id }}" value="1">
                                        <label class="form-check-label" for="true">True</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer" id="false"
                                               wire:model="userAnswers.{{ $currentQuestion->id }}" value="0">
                                        <label class="form-check-label" for="false">False</label>
                                    </div>
                                @else
                                    <textarea class="form-control" wire:model="userAnswers.{{ $currentQuestion->id }}"
                                              rows="4" placeholder="Enter your answer here"></textarea>
                                @endif
                            </div>

                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <button class="btn btn-outline-primary" wire:click="previousQuestion" {{ $currentQuestionIndex === 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-chevron-left"></i> Previous
                                </button>
                                <div>
                                    Question {{ $currentQuestionIndex + 1 }} of {{ count($questions) }}
                                </div>
                                @if ($currentQuestionIndex < count($questions) - 1)
                                    <button class="btn btn-outline-primary" wire:click="nextQuestion">
                                        Next <i class="fas fa-chevron-right"></i>
                                    </button>
                                @else
                                    <button class="btn btn-success" wire:click="submitTest">
                                        Submit Test <i class="fas fa-check"></i>
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="text-center">
                                <p>No questions available for this subject. Please select another subject or contact the administrator.</p>
                            </div>
                        @endif
                    @else
                        <h3>Test Completed</h3>
                        @php
                            $result = $this->getResult();
                        @endphp
                        <div class="result-container">
                            <p>Your score: {{ $result->score }} / {{ $result->total_questions * $test->marks_per_question }}</p>
                            <p>Correct answers: {{ $result->correct_answers }}</p>
                            <p>Incorrect answers: {{ $result->incorrect_answers }}</p>
                            <p>Unattempted: {{ $result->unattempted }}</p>
                            <p>Time taken: {{ $result->start_time->diffInMinutes($result->end_time) }} minutes</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
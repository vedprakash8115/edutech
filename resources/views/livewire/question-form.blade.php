<div class="container-fluid">
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

    <div class="row">
        
        <div class="col-md-3 bg-light card vh-100 overflow-auto py-3">
            <div class=" d-flex justify-content-center align-items-center " >
                <i class="fa fa-bars text-dark" style="font-size: 20px;  "></i>
            </div> 
            <hr style=" border:1px solid rgba(0, 0, 0, 0.474);">

            <div class="mock-test-flowchart">
            
                        <div class="text-center mt-4">
                         
                            <p>Questions number will appear here.</p>
                            <hr style="border-color:#007bff; border-style:dashed;">
                           
                        </div>
               
                <div class="modal fade" id="instructionsModal" tabindex="-1" aria-labelledby="instructionsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="instructionsModalLabel">Mock Test Creation Instructions</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Step-by-Step Guide</h4>
                                <ol>
                                    <li>
                                        <strong>Create the Test Section</strong>
                                        <p>Start by creating the overall structure of your mock test. This includes setting the test name, duration, and any specific instructions for test-takers.</p>
                                    </li>
                                    <li>
                                        <strong>Create the Subjects Section</strong>
                                        <p>Define the subjects or topics that will be covered in your mock test. This helps in organizing questions and ensures a balanced test structure.</p>
                                    </li>
                                    <li>
                                        <strong>Create Questions for the Test</strong>
                                        <p>Develop a variety of questions for each subject. Ensure that the questions align with the test objectives and cover the necessary topics.</p>
                                    </li>
                                    <li>
                                        <strong>Create Options for MCQs</strong>
                                        <p>If your test includes multiple-choice questions (MCQs), create options for each question. Make sure to include the correct answer and plausible distractors.</p>
                                    </li>
                                </ol>
                                <h4>Additional Tips</h4>
                                <ul>
                                    <li>Review and proofread all questions and answers to avoid errors.</li>
                                    <li>Upload images in question later if questions are uploaded via CSV </li>
                                    <li>Make sure if you proper negative marking and optional questions to avoid any conflicts.</li>
                                    <li>Provide clear instructions for each question type (e.g., MCQ, short answer, essay).</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                .mock-test-flowchart {
                    font-family: 'Arial', sans-serif;
                    max-width: 800px;
                    margin: 0 auto;
                }

    .card
    {
        border-radius: 5px;
    }

                .card {
                    background: #ffffff;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                    transition: all 0.3s ease;
                }
            
                .card:hover {
                    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
                }
            
                .card-title {
                    color: #333;
                    font-size: 1.5rem;
                    font-weight: bold;
                    margin-bottom: 1.5rem;
                }
            
                .flow-steps {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap;
                }
            
                .flow-step {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-decoration: none;
                    color: #333;
                    transition: all 0.3s ease;
                }
            
                .flow-step:hover {
                    transform: scale(1.05);
                }
            
                .step-icon {
                    width: 60px;
                    height: 60px;
                    background: #007bff;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-bottom: 10px;
                }
            
                .step-icon i {
                    font-size: 24px;
                    color: #fff;
                }
            
                .step-text {
                    font-size: 0.9rem;
                    font-weight: bold;
                    text-align: center;
                }
            
                .flow-arrow {
                    font-size: 24px;
                    color: #007bff;
                }
            
                @media (max-width: 768px) {
                    .flow-steps {
                        flex-direction: column;
                    }
                    
                    .flow-arrow {
                        transform: rotate(90deg);
                        margin: 15px 0;
                    }
                }
                </style>
                <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const flowSteps = document.querySelectorAll('.flow-step');
                    
                    flowSteps.forEach((step, index) => {
                        step.style.animationDelay = ${index * 0.2}s;
                        step.classList.add('animate-in');
                    });
                });
                </script>
                
            
            </div>
           
            <!-- Sidebar for question numbers -->
            <div class="list-group mt-3">
                @if($question_entry_type == 'manual' && $questions)
                    @for ($i = 1; $i <= $questions; $i++)
                        <a href="#" class="list-group-item list-group-item-action {{ $activeQuestion === $i - 1 ? 'active' : '' }} d-flex justify-content-between align-items-center" wire:click.prevent="setActiveQuestion({{ $i - 1 }})">
                            <span>Question {{ $i }}</span>
                            <span class="badge bg-primary rounded-pill">{{ $i }}</span>
                        </a>
                    @endfor
                @endif
            </div>
           
            <div class="mt-auto   p-3 justify-content-center">
                
                <hr style="border-color:#007bff; border-style:dashed;">

                  <button type="button" class="mx-auto d-flex justify-content-center align-content-center btn btn-info" data-bs-toggle="modal" data-bs-target="#instructionsModal">
                    Read Instructions 
                </button>
                <hr style=" border:1px solid rgba(0, 0, 0, 0.474);">
                <div class=" d-flex justify-content-center align-items-center " >
                    <i class="fa fa-bars text-dark" style="font-size: 20px;  "></i>
                </div> 
                </div>
        </div>
        <div class="col-md-9">
           
            <form wire:submit.prevent="store" class="bg-white p-4 shadow-sm rounded">
                <div class=" d-flex justify-content-center align-items-center" >
                    <i class="fa fa-bars text-dark" style="font-size: 20px;  "></i>
                </div> 
                <hr style="border:1px solid rgba(0, 0, 0, 0.489)">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="test_id" class="form-label">Select Test</label>
                        <select class="form-select border-bottom border-primary" id="test_id" wire:model.live="test_id">
                            <option value="">Choose a Test</option>
                            @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->title }}</option>
                            @endforeach
                        </select>
                        @error('test_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        
                            <label for="subject_id" class="form-label">Select Subject</label>
                            <select class="form-select border-bottom border-primary" id="subject_id" wire:model.live="subject_id">
                                <option value="">Choose a Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
                        
                    </div>
                </div>
<hr>
                @if($subject_id)
                    <div class="mb-4">
                        <label class="form-label d-block">How would you like to add questions?</label>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" id="manual" value="manual" wire:model.live="question_entry_type">
                            <label class="btn btn-outline-primary" for="manual">Manually</label>
                            <input type="radio" class="btn-check" id="csv" value="csv" wire:model.live="question_entry_type">
                            <label class="btn btn-outline-primary" for="csv">CSV Import</label>
                        </div>
                        @error('question_entry_type') <span class="text-danger d-block mt-2">{{ $message }}</span> @enderror
                    </div>
                @endif

                @if($question_entry_type == 'manual' && $subject_id && $questions > 0)
                <hr>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($activeQuestion + 1) / $questions * 100 }}%;" aria-valuenow="{{ $activeQuestion + 1 }}" aria-valuemin="0" aria-valuemax="{{ $questions }}">
                            Question {{ $activeQuestion + 1 }} of {{ $questions }}
                        </div>
                    </div>

                    @for ($i = 0; $i < $questions; $i++)
                        @if ($activeQuestion === $i)
                            <div class="card mb-4 border-primary" wire:key="question-card-{{ $i }}">
                                <div class="card-header bg-primary text-white">
                                    <p class="card-title text-white mb-0" style="font-weight:100">Question {{ $i + 1 }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="question_text_{{ $i }}" class="form-label">Question Text</label>
                                        <textarea class="form-control border-bottom border-primary" id="question_text_{{ $i }}" wire:model.live="quesarray.{{ $i }}.question_text" rows="3"></textarea>
                                        @error("quesarray.$i.question_text") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="question_type_{{ $i }}" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Select the type of question">
                                                Question Type
                                            </label>
                                            <select class="form-select border-bottom border-primary" id="question_type_{{ $i }}" wire:model.live="quesarray.{{ $i }}.question_type">
                                                <option value="">Select Type</option>
                                                <option value="multiple_choice">Multiple Choice</option>
                                                <option value="true_false">True/False</option>
                                                <option value="short_answer">Short Answer</option>
                                                <option value="essay">Essay</option>
                                            </select>
                                            @error("quesarray.$i.question_type") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="marks_{{ $i }}" class="form-label">Marks</label>
                                            <input type="number" class="form-control border-bottom border-primary" id="marks_{{ $i }}" wire:model.live="quesarray.{{ $i }}.marks" min="1" max="100">
                                            @error("quesarray.$i.marks") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    @if ($quesarray[$i]['question_type'] === 'multiple_choice')
                                        <div class="row mb-3">
                                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                                <div class="col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-primary text-white">Option {{ strtoupper($option) }}</span>
                                                        <input type="text" class="form-control border-bottom border-primary" id="{{ $option }}_text_{{ $i }}" wire:model.live="quesarray.{{ $i }}.options.{{ $option }}.text">
                                                    </div>
                                                    @error("quesarray.$i.options.$option.text") <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <input type="file" class="form-control border-bottom border-primary" id="{{ $option }}_image_{{ $i }}" wire:model.live="option_images.{{ $i }}.{{ $option }}">
                                                    @error("option_images.$i.$option") <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="answer_{{ $i }}" class="form-label">Answer</label>
                                            <select class="form-select border-bottom border-primary" id="answer_{{ $i }}" wire:model.live="quesarray.{{ $i }}.answer">
                                                <option value="">Choose Answer</option>
                                                <option value="a">Option A</option>
                                                <option value="b">Option B</option>
                                                <option value="c">Option C</option>
                                                <option value="d">Option D</option>
                                            </select>
                                            @error("quesarray.$i.answer") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    @elseif ($quesarray[$i]['question_type'] === 'true_false')
                                        <div class="mb-3" wire:key="is_true-{{ $i }}">
                                            <label for="is_true_{{ $i }}" class="form-label">Is True</label>
                                            <select id="is_true_{{ $i }}" wire:model.live="quesarray.{{ $i }}.is_true" class="form-select border-bottom border-primary">
                                                <option value="">Select</option>
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                            @error("quesarray.$i.is_true") <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="question_image_{{ $i }}" class="form-label">Question Image</label>
                                        <input type="file" class="form-control border-bottom border-primary" id="question_image_{{ $i }}" wire:model.live="question_images.{{ $i }}">
                                        @error("question_images.$i") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="is_optional_{{ $i }}" wire:model.live="quesarray.{{ $i }}.is_optional">
                                        <label class="form-check-label" for="is_optional_{{ $i }}">Optional</label>
                                        @error("quesarray.$i.is_optional") <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                            </div>
                            
                        @endif
                    @endfor

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <div wire:loading wire:target="store" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                @endif
            </form>
         
            @if($question_entry_type == 'csv')
                <form wire:submit.prevent="importCsv" class="bg-white p-4 shadow-sm rounded mt-4">
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Import CSV</label>
                        <input type="file" class="form-control border-bottom border-primary" id="csv_file" wire:model.live="csv_file" accept=".csv">
                        @error('csv_file') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" {{ !$test_id || !$subject_id ? 'disabled' : '' }}>
                        Import CSV
                    </button>
                </form>
                
            @endif
        </div>
    </div>
</div>


@if($showModal)
<div wire:ignore.self class="modal fade show" id="importInstructionModal" tabindex="-1" role="dialog" aria-labelledby="importInstructionModalLabel" aria-hidden="true" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="importInstructionModalLabel">Important Instructions</h5>
                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please make sure to import <strong>all questions</strong> for the selected subject, as missing questions may result in errors.</p>
                <p>The CSV file should contain the following columns:</p>
                <ul class="list-group">
                    <li class="list-group-item">question_text</li>
                    <li class="list-group-item">question_type (multiple_choice, true_false, etc.)</li>
                    <li class="list-group-item">difficulty_level (easy, medium, hard)</li>
                    <li class="list-group-item">marks</li>
                    <li class="list-group-item">is_true (for true/false questions)</li>
                    <li class="list-group-item">is_optional</li>
                    <li class="list-group-item">answer (correct answer)</li>
                    <li class="list-group-item">option_a, option_b, option_c, option_d (for multiple choice)</li>
                    <li class="list-group-item">option_a_image, option_b_image, option_c_image, option_d_image (optional images for each option)</li>
                </ul>
                <p><strong>Note:</strong> Only CSV files with a <code>.csv</code> extension are allowed. You will need to manually add images later if required.</p>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swal:toast', (data) => {
            Swal.fire({
                icon: data[0].icon,
                title: data[0].title,
                text: data[0].text,
                toast: true,
                position: data[0].position || 'top-end',
                showConfirmButton: false,
                timer: data[0].timer || 3000,
                timerProgressBar: true,
            });
        });
    });
</script>


</div>
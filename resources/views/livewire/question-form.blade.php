<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar for question numbers -->
            <div class="list-group">
                @if($questions)
                    {{-- @for ($i = 1; $i <= $questions; $i++)
                        <a href="#" class="list-group-item list-group-item-action" wire:click.prevent="setActiveQuestion({{ $i - 1 }})">
                            <div class="d-flex justify-content-between">
                                <span>Question {{ $i }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $i }}</span>
                            </div>
                        </a>
                    @endfor --}}
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
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

                <!-- Subject Dropdown -->
                @if($test_id)
                    <div class="form-group mb-3">
                        <label for="subject_id">Select Subject</label>
                        <select class="form-control" id="subject_id" wire:model.live="subject_id">
                            <option value="">Choose a Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif

                <!-- Questions -->
                @if($subject_id)
                <div class="form-group mb-3">
                    @for ($i = 0; $i < $questions; $i++)
                         @if ($activeQuestion === $i)
                             <div class="card mb-3">
                                 <div class="card-body">
                                     <h5 class="card-title">Question {{ $i + 1 }}</h5>
                                     
                                     <div class="form-group mb-3">
                                         <label for="question_text_{{ $i }}">Question Text</label>
                                         <input type="text" class="form-control" id="question_text_{{ $i }}" wire:model.defer="quesarray.{{ $i }}.question_text">
                                         @error("quesarray.$i.question_text") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                                     
                                     <div class="form-group mb-3">
                                         <label for="question_type_{{ $i }}">Question Type</label>
                                         <select class="form-control" id="question_type_{{ $i }}" wire:model.live="quesarray.{{ $i }}.question_type">
                                             <option value="multiple_choice">Multiple Choice</option>
                                             <option value="true_false">True/False</option>
                                             <option value="short_answer">Short Answer</option>
                                             <option value="essay">Essay</option>
                                         </select>
                                         @error("quesarray.$i.question_type") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                
                                     <!-- Additional fields based on question type -->
                                     @if ($quesarray[$i]['question_type'] === 'multiple_choice')
                                     @foreach(['a', 'b', 'c', 'd'] as $key => $option)
                                     <div class="mb-4">
                                         <label for="option_text_{{ $index }}_{{ $key }}">Option {{ strtoupper($option) }} Text</label>
                                         <input type="text" id="option_text_{{ $index }}_{{ $key }}" wire:model.defer="quesarray.{{ $index }}.options.{{ $key }}.text" class="form-control">
                                         @error("quesarray.$index.options.$key.text") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                     
                                     <div class="mb-4">
                                         <label for="option_image_{{ $index }}_{{ $key }}">Option {{ strtoupper($option) }} Image</label>
                                         <input type="file" id="option_image_{{ $index }}_{{ $key }}" wire:model="option_images.{{ $index }}.{{ $key }}" class="form-control">
                                         @error("option_images.$index.$key") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                                 @endforeach
                                         
                                         <div class="form-group mb-3">
                                             <label for="answer_{{ $i }}">Answer</label>
                                             <select class="form-control" id="answer_{{ $i }}" wire:model.defer="quesarray.{{ $i }}.answer">
                                                 <option value="">Choose Answer</option>
                                                 <option value="a">Option A</option>
                                                 <option value="b">Option B</option>
                                                 <option value="c">Option C</option>
                                                 <option value="d">Option D</option>
                                             </select>
                                             @error("quesarray.$i.answer") <span class="text-danger">{{ $message }}</span> @enderror
                                         </div>
                                         @elseif ($quesarray[$i]['question_type'] === 'true_false')
                                         <div class="form-group mb-3">
                                             <label for="is_true_{{ $i }}">Is True</label>
                                             <input type="checkbox" id="is_true_{{ $i }}" wire:model.defer="quesarray.{{ $i }}.is_true">
                                             @error("quesarray.$i.is_true") <span class="text-danger">{{ $message }}</span> @enderror
                                         </div>
                                     {{-- @endif --}}
                                     @endif
                                     
                                     <!-- More fields based on the type can be added here -->
                                    
                
                                     <div class="form-group mb-3">
                                         <label for="marks_{{ $i }}">Marks</label>
                                         <input type="number" class="form-control" id="marks_{{ $i }}" wire:model.defer="quesarray.{{ $i }}.marks" min="1">
                                         @error("quesarray.$i.marks") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                
                                     <div class="form-group mb-3">
                                         <label for="image_{{ $i }}">Question Image</label>
                                         <input type="file" class="form-control" id="image_{{ $i }}" wire:model="question_images.{{ $i }}">
                                         @error("question_images.$i") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                
                                     <div class="form-group mb-3">
                                         <label for="is_optional_{{ $i }}">Optional</label>
                                         <input type="checkbox" id="is_optional_{{ $i }}" wire:model.defer="quesarray.{{ $i }}.is_optional">
                                         @error("quesarray.$i.is_optional") <span class="text-danger">{{ $message }}</span> @enderror
                                     </div>
                                 </div>
                             </div>
                         @endif
                    @endfor
                @endif

                <button type="submit" class="btn btn-primary">Save Questions</button>
            </form>
        </div>
    </div>
</div>

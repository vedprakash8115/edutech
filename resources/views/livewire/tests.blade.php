<div class="col-md-12">
  
    @livewire('header')

    
<div class="card ">
    <div class="col-md-12 d-flex justify-content-center align-items-center bg-dark" >
        <i class="fa fa-bars text-white" style="font-size: 20px;  "></i>
        {{-- {{-- <hr> --}}
    </div> 
    <div class="card-body">
       
        {{-- <div class="card-title text-dark" style="font-size: 25px;">Create Test</div> --}}
        <form wire:submit.prevent="store">
            <div class="row g-3">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <label for="title" class="form-label">
                        <i class="fas fa-heading me-2"></i>Title
                    </label>
                    <input type="text" class="form-control" id="title" wire:model="title" placeholder="Enter test title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="100">
                    <label for="description" class="form-label">
                        <i class="fas fa-align-left me-2"></i>Description
                    </label>
                    <textarea class="form-control" id="description" wire:model="description" placeholder="Enter test description"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="200">
                    <label for="duration" class="form-label">
                        <i class="fas fa-clock me-2"></i>Duration (minutes)
                    </label>
                    <input type="number" class="form-control" id="duration" wire:model="duration" min="1">
                    @error('duration') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <label for="total_marks" class="form-label">
                        <i class="fas fa-star me-2"></i>Total Marks
                    </label>
                    <input type="number" class="form-control" id="total_marks" wire:model="total_marks" min="1">
                    @error('total_marks') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                    <label for="total_questions" class="form-label">
                        <i class="fas fa-list-ol me-2"></i>Total Questions
                    </label>
                    <input type="number" class="form-control" id="total_questions" wire:model.live="total_questions" min="1">
                    @error('total_questions') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="300">
                    <label for="passing_score" class="form-label">
                        <i class="fas fa-check-circle me-2"></i>Passing Score
                    </label>
                    <input type="number" class="form-control" id="passing_score" wire:model="passing_score" min="0">
                    @error('passing_score') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400">
                    <label for="time_limit" class="form-label">
                        <i class="fas fa-hourglass-half me-2"></i>Time Limit per Question (optional)
                    </label>
                    <input type="number" class="form-control" id="time_limit" wire:model="time_limit" min="1" placeholder="Enter time limit in minutes">
                    @error('time_limit') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400">
                    <label for="select_category" class="form-label">
                        <i class="fas fa-folder me-2"></i>Test Exam Category
                    </label>
                    <select class="form-select" id="select_category" wire:model="select_category">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('select_category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="500">
                    <label for="question_type" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Select the type of question">
                        <i class="fas fa-question-circle me-2"></i>Question Type
                    </label>
                    <select class="form-select" id="question_type" wire:model.live="question_type">
                        <option value="">Select Type</option>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True/False</option>
                        <option value="short_answer">Short Answer</option>
                        <option value="essay">Essay</option>
                        <option value="mix">Mix</option>
                    </select>
                    @error("question_type") <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="500">
                    <label for="number_of_subjects" class="form-label">
                        <i class="fas fa-book me-2"></i>Number of subjects
                    </label>
                    <input type="number" class="form-control" id="number_of_subjects" wire:model="number_of_subjects" min="1">
                    @error('number_of_subjects') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="600">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_randomized" wire:model="is_randomized">
                        <label class="form-check-label" for="is_randomized">
                            <i class="fas fa-random me-2"></i>Randomize Questions?
                        </label>
                    </div>
                    @error('is_randomized') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="600">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="has_negative_marks" wire:model.live="has_negative_marks">
                        <label class="form-check-label" for="has_negative_marks">
                            <i class="fas fa-minus-circle me-2"></i>Allow Negative Marks?
                        </label>
                    </div>
                    @error('has_negative_marks') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if($has_negative_marks)
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                        <label for="negative_marks" class="form-label">
                            <i class="fas fa-exclamation-triangle me-2"></i>Negative Marks Value
                        </label>
                        <input type="number" class="form-control" id="negative_marks" wire:model="negative_marks" min="0" step="0.01" placeholder="Enter negative marks value">
                        @error('negative_marks') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="700">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="allow_optional_questions" wire:model.live="allow_optional_questions">
                        <label class="form-check-label" for="allow_optional_questions">
                            <i class="fas fa-tasks me-2"></i>Allow Optional Questions?
                        </label>
                    </div>
                    @error('allow_optional_questions') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                @if($allow_optional_questions)
                    <div class="col-md-6" data-aos="fade-left" data-aos-delay="800">
                        <label for="question_attempt" class="form-label">
                            <i class="fas fa-pencil-alt me-2"></i>Number of Questions to Attempt
                        </label>
                        <input type="number" class="form-control" id="question_attempt" wire:model="question_attempt" min="1" max="{{ $total_questions }}" placeholder="Enter number of questions to attempt">
                        @error('question_attempt') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
            <div class="form-group my-5">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="store">
                        <i class="fas fa-plus-circle me-2"></i>Create Test
                       
                    </span>
                    <span wire:loading.class wire:loading.class.remove = "d-none" = "d-flex" wire:target="store" class="d-none align-items-center">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                        Submitting...
                    </span>
                </button>
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
          
         
           
            </div>
            <div class="col-md-12 d-flex justify-content-center align-items-center bg-dark" >
                <i class="fa fa-bars text-white" style="font-size: 20px;  "></i>
                {{-- {{-- <hr> --}}
            </div> 
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // ----------------------------------


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

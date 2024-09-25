<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Required for file uploads
use App\Models\Test;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CourseCategory0;
class Tests extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $duration;
    public $total_marks;
    public $total_questions;
    public $available_questions;
    public $optional_questions;
    public $passing_score;
    public $is_active = false;
    public $test_type = 'mcq';
    public $time_limit;
    public $is_randomized = false;
    public $has_negative_marks = false;
    public $negative_marks;
    public $allow_optional_questions = false;
    public $question_attempt;
    public $number_of_subjects;
    public $categories = [];
    public $select_category;
    public $question_type;
    public $pagetitle = 'Your Default Title';
    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1',
        'total_marks' => 'required|integer|min:1',
        'total_questions' => 'required|integer|min:1',
        'passing_score' => 'required|integer|min:0',
        'is_active' => 'boolean',
        'test_type' => 'required|in:mcq,descriptive,true_false',
        'time_limit' => 'nullable|integer|min:1',  // Time limit per question
        'is_randomized' => 'boolean',  // Is randomized order of questions
        'has_negative_marks' => 'boolean',  // Allow negative marks
        'negative_marks' => 'nullable|numeric|min:0',  // Negative marks value
        'allow_optional_questions' => 'boolean',  // Allow skipping some questions
        'question_attempt' => 'nullable|integer|min:1',  // Number of questions to attempt
        'number_of_subjects'=>'required|integer|min:1',
        'select_category' => 'required',
        'question_type' => 'required',
    ];
    public function mount()
    {
      

        
            $this->pagetitle = 'Test Creation';
        
        // Fetch categories and pass them to the Blade view
        $this->categories = CourseCategory0::where('status', true)->get(); // Adjust query as needed
    }

    // Store the data in the database
    public function store()
    {
        // Validate the inputs
        $validatedData = $this->validate();

        try {
            // Insert into the database
            Test::create([
                'title' => $this->title,
                'description' => $this->description,
                'duration' => $this->duration,
                'total_marks' => $this->total_marks,
                'total_questions' => $this->total_questions,
                'available_questions' => $this->total_questions,
                'passing_score' => $this->passing_score,
                'is_active' => $this->is_active,
                'test_type' => $this->test_type,
                'time_limit' => $this->time_limit,
                'is_randomized' => $this->is_randomized,
                'has_negative_marks' => $this->has_negative_marks,
                'negative_marks' => $this->negative_marks,
                'allow_optional_questions' => $this->allow_optional_questions,
                'question_attempt' => $this->question_attempt,
                'number_of_subjects' => $this->number_of_subjects,
                'optional_questions' => $this->total_questions - $this->question_attempt,
                'select_category' => $this->select_category,
                'question_type' => $this->question_type,
            ]);

            // Reset the form inputs
            $this->reset();

            // Show success toast
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'Test Created Successfully!',
                'timer' => 3000,
                'position' => 'top-end',
            ]);
        } catch (\Exception $e) {
            // Show error toast
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'Error Creating Test',
                'text' => 'An unexpected error occurred. Please try again.',
                'timer' => 5000,
                'position' => 'top-end',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.tests')
        ->extends('layout.app');
    }
    
}

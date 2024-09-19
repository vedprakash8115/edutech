<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Required for file uploads
use App\Models\Test;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
class Tests extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $duration;
    public $total_marks;
    public $total_questions;
    public $available_questions;
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
        'number_of_subjects'=>'required|integer|min:1'
    ];

    // Store the data in the database
    public function store()
    {
        // Validate the inputs
        $this->validate();

        // Handle the image upload if an image is provided
        // if ($this->image) {
        //     $fileName = time() . '_' . $this->image->getClientOriginalName();
        //     // $imagePath = $this->image->store('public/tests'); // Save in public/tests directory
        //     $imagePath = $this->image->move(public_path('mock_images'), $fileName); // Save in public/tests directory
        //     // $imagePath = str_replace('public/', '', $imagePath); // Adjust the path for public access
        // }

        // $bannerFile = $request->file('banner');
        // $destinationPath = 'upload_banner';
        // $fileName = time() . '_' . $bannerFile->getClientOriginalName();
        // $bannerFile->move(public_path($destinationPath), $fileName);
        // $validatedData['banner'] = $destinationPath . '/' . $fileName;


       
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
         'number_of_subjects'=>$this->number_of_subjects,
        ]);

        // Reset the form inputs
        $this->reset();
        
        // Redirect or show a success message
        session()->flash('message', 'Test created successfully.');
        // Alert::toast('Test added successfully', 'success');
            // Emit success message
    // $this->dispatch('swal:success', [
    //     'type' => 'success',
    //     'message' => 'Test Created Successfully!',
    //     'text' => 'The mock test has been added.',
    //     'icon'=>'success',
    // 'iconColor'=>'blue',
    // ]);

    }

    public function render()
    {
        return view('livewire.tests');
    }
}

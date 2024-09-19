<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Test;

class QuestionForm extends Component
{
    use WithFileUploads;

    public $test_id;
    public $subject_id;
    public $questions = 0; // Changed to integer to match expected type
    public $subjects = [];
    public $tests = [];
    public $quesarray = [];
    public $activeQuestion = null;

    // For file uploads
    public $option_images = []; // For storing file uploads
    public $question_images = []; // For storing file uploads

    public function setActiveQuestion($index)
    {
        $this->activeQuestion = $index;
    }

    protected $rules = [
        'test_id' => 'required|exists:tests,id',
        'subject_id' => 'required|exists:subjects,id',
        'quesarray.*.question_text' => 'required|string',
        'quesarray.*.question_type' => 'required|in:multiple_choice,true_false,short_answer,essay',
        'quesarray.*.difficulty_level' => 'required|in:easy,medium,hard',
        'quesarray.*.marks' => 'required|integer|min:1',
        'quesarray.*.image' => 'nullable|image|max:2048', // Updated to handle image uploads
        'quesarray.*.is_optional' => 'boolean',
        'quesarray.*.is_true' => 'nullable|boolean',
        'quesarray.*.options.*.text' => 'nullable|string',
        'quesarray.*.options.*.image' => 'nullable|image|max:2048', // Updated to handle image uploads
        'quesarray.*.answer' => 'nullable|in:a,b,c,d,true,false' // Added validation for answer
    ];

    public function mount()
    {
        $this->tests = Test::all();
        $this->initializeQuestions();
    }

    private function getDefaultQuestion()
    {
        return [
            'question_text' => '',
            'question_type' => 'multiple_choice',
            'options' => [
                'a' => ['text' => '', 'image' => ''],
                'b' => ['text' => '', 'image' => ''],
                'c' => ['text' => '', 'image' => ''],
                'd' => ['text' => '', 'image' => '']
            ],
            'answer' => null,
            'image' => '',
            'is_optional' => false,
            'difficulty_level' => 'easy',
            'marks' => 1
        ];
    }

    public function updatedTestId($testId)
    {
        $this->subjects = Subject::where('test_id', $testId)->get();
        $this->subject_id = null; // Reset subject_id when test_id changes
        $this->questions = 0; // Reset number of questions when test_id changes
        $this->quesarray = []; // Reset questions array
    }

    public function initializeQuestions()
    {
        if ($this->questions > 0) {
            $this->quesarray = array_fill(0, $this->questions, $this->getDefaultQuestion());
        } else {
            $this->quesarray = []; // Initialize as an empty array if invalid number of questions
        }
    }

    public function updatedSubjectId($subjectId)
    {
        $subject = Subject::find($subjectId);

        if ($subject) {
            $this->questions = $subject->number_of_questions;
            $this->initializeQuestions(); // Initialize questions based on number_of_questions
        } else {
            $this->questions = 0;
            $this->quesarray = []; // Clear questions array if subject is not found
        }
    }

    public function updatedQuestions($questionIndex)
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();

        foreach ($this->quesarray as $index => $questionData) {
            // Create or update the question record
            $question = Question::updateOrCreate(
                ['id' => $questionData['id'] ?? null],
                [
                    'test_id' => $this->test_id,
                    'subject_id' => $this->subject_id,
                    'question_text' => $questionData['question_text'],
                    'question_type' => $questionData['question_type'],
                    'difficulty_level' => $questionData['difficulty_level'],
                    'marks' => $questionData['marks'],
                    'is_true' => $questionData['question_type'] === 'true_false' ? $questionData['is_true'] : null,
                    'is_optional' => $questionData['is_optional'] ?? false,
                ]
            );

            // Handle question image upload
            if (isset($this->question_images[$index])) {
                $questionImage = $this->question_images[$index];
                $fileName = time() . '_' . $questionImage->getClientOriginalName();
                $path = $questionImage->storeAs('questions', $fileName, 'public');
                $question->update(['image' => $path]);
            }

            // Handle option images upload
            foreach ($questionData['options'] as $key => $option) {
                $optionData = [
                    'text' => $option['text'] ?? '',
                    'image' => null // Default image path to null
                ];

                // Handle option image upload
                if (isset($this->option_images[$index][$key])) {
                    $optionImage = $this->option_images[$index][$key];
                    $fileName = time() . '_' . $optionImage->getClientOriginalName();
                    $path = $optionImage->storeAs('options', $fileName, 'public');
                    $optionData['image'] = $path;
                }

                // Update or create the option record
                $question->options()->updateOrCreate(
                    ['key' => $key],
                    $optionData
                );
            }
        }

        session()->flash('message', 'Questions and options saved successfully.');
        $this->reset(); // Reset form fields after saving
    }


    public function render()
    {
        return view('livewire.question-form');
    }
}

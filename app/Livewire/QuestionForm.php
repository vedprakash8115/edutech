<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Question;
use App\Models\Option;
use App\Models\Subject;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
class QuestionForm extends Component
{
    use WithFileUploads;

    // Properties for form data
    public $test_id;
    public $subject_id;
    public $questions = 0;
    public $subjects = [];
    public $tests = [];
    public $quesarray = [];
    public $activeQuestion = null;
    public $csv_file;
    // Properties for file uploads
    public $question_images = [];
    public $option_images = [];

    // Validation rules
    protected function rules()
    {
        return [
            'test_id' => 'required',
            'subject_id' => 'required',
            'quesarray.*.question_text' => 'required|string|max:1000',
            'quesarray.*.question_type' => 'required',
            'quesarray.*.difficulty_level' => 'nullable',
            'quesarray.*.marks' => 'required|integer|min:1|max:100',
            'quesarray.*.is_optional' => 'boolean',
            'quesarray.*.is_true' => 'nullable|boolean',
            'quesarray.*.options.*.text' => 'nullable',
            'quesarray.*.answer' => 'nullable',
            'question_images.*' => 'nullable|image|max:2048',
            'option_images.*.*' => 'nullable|image|max:2048',
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ];
    }


    protected $messages = [
        'quesarray.*.question_text.required' => 'The question text is required.',
        'quesarray.*.question_text.max' => 'The question text must not exceed 1000 characters.',
        'quesarray.*.question_type.required' => 'Please select a question type.',
        'quesarray.*.difficulty_level.required' => 'Please select a difficulty level.',
        'quesarray.*.marks.required' => 'Please specify the marks for this question.',
        'quesarray.*.marks.min' => 'Marks must be at least 1.',
        'quesarray.*.marks.max' => 'Marks cannot exceed 100.',
        'quesarray.*.options.*.text.max' => 'Option text must not exceed 500 characters.',
        'question_images.*.max' => 'Question image must not exceed 2MB.',
        'option_images.*.*.max' => 'Option image must not exceed 2MB.',
    ];

    public function mount()
    {
        $this->tests = Test::all();
        $this->initializeQuestions();
    }

    private function getDefaultQuestion()
    {
        return [
            'subject_id' => $this->subject_id,  // Add this line to ensure subject_id is included
            'question_text' => '',
            'question_type' => 'multiple_choice',
            'difficulty_level' => 'easy',
            'marks' => 1,
            'is_optional' => false,
            'is_true' => null,
            'image' => '',
            'options' => [
                'a' => ['text' => '', 'image' => ''],
                'b' => ['text' => '', 'image' => ''],
                'c' => ['text' => '', 'image' => ''],
                'd' => ['text' => '', 'image' => '']
            ],
            'answer' => null,
        ];
    }
    

    public function setActiveQuestion($index)
    {
        $this->activeQuestion = $index;
    }

    public function updatedTestId($testId)
    {
        $this->subjects = Subject::where('test_id', $testId)->get();
        $this->subject_id = null;
        $this->questions = 0;
        $this->quesarray = [];
        $this->question_images = [];
        $this->option_images = [];
    }

    public function updatedSubjectId($subjectId)
    {
        $subject = Subject::find($subjectId);
    
        if ($subject) {
            $this->questions = $subject->number_of_questions;
    
            // Fetch existing questions for the selected test and subject
            $existingQuestions = Question::where('test_id', $this->test_id)
                                        ->where('subject_id', $subjectId)
                                        ->with('options') // Include options for multiple choice questions
                                        ->get();
    
            if ($existingQuestions->isNotEmpty()) {
                $this->loadExistingQuestions($existingQuestions);
            } else {
                $this->initializeQuestions();
            }
        } else {
            $this->questions = 0;
            $this->quesarray = [];
            $this->question_images = [];
            $this->option_images = [];
        }
    }
    private function loadExistingQuestions($existingQuestions)
{
    $this->quesarray = [];
    $this->question_images = [];
    $this->option_images = [];

    foreach ($existingQuestions as $index => $question) {
        $this->quesarray[$index] = [
            'id' => $question->id,
            'subject_id' => $question->subject_id,  // Add subject_id here
            'question_text' => $question->question_text,
            'question_type' => $question->question_type,
            'difficulty_level' => $question->difficulty_level,
            'marks' => $question->marks,
            'is_optional' => $question->is_optional,
            'is_true' => $question->question_type === 'true_false' ? $question->is_true : null,
            'answer' => $question->answer,
            'options' => [
                'a' => ['text' => $question->options->where('key', 'a')->first()->text ?? '', 'image' => $question->options->where('key', 'a')->first()->image ?? ''],
                'b' => ['text' => $question->options->where('key', 'b')->first()->text ?? '', 'image' => $question->options->where('key', 'b')->first()->image ?? ''],
                'c' => ['text' => $question->options->where('key', 'c')->first()->text ?? '', 'image' => $question->options->where('key', 'c')->first()->image ?? ''],
                'd' => ['text' => $question->options->where('key', 'd')->first()->text ?? '', 'image' => $question->options->where('key', 'd')->first()->image ?? '']
            ],
        ];

        // Load existing question image
        $this->question_images[$index] = $question->image;

        // Load existing option images
        $this->option_images[$index] = [
            'a' => $question->options->where('key', 'a')->first()->image ?? null,
            'b' => $question->options->where('key', 'b')->first()->image ?? null,
            'c' => $question->options->where('key', 'c')->first()->image ?? null,
            'd' => $question->options->where('key', 'd')->first()->image ?? null,
        ];
    }
}



    public function initializeQuestions()
    {
        if ($this->questions > 0) {
            $this->quesarray = array_fill(0, $this->questions, $this->getDefaultQuestion());
        } else {
            $this->quesarray = [];
        }

        $this->question_images = array_fill(0, $this->questions, null);
        $this->option_images = array_fill(0, $this->questions, [
            'a' => null,
            'b' => null,
            'c' => null,
            'd' => null,
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        $this->validateMultipleChoiceQuestions();
    
        // Loop through each subject and count optional questions
        foreach ($this->subjects as $subjectIndex => $subject) {
            $optionalQuestionCount = 0;
    
            // Loop through the questions related to the current subject
            foreach ($this->quesarray as $index => $questionData) {
                if ($questionData['subject_id'] == $subject['id']) {
                    // Count the number of optional questions
                    if (isset($questionData['is_optional']) && $questionData['is_optional']) {
                        $optionalQuestionCount++;
                    }
                }
            }
    
            // Check if the optional question count matches the subject's number of optional questions
            if ($optionalQuestionCount !== $subject['number_optional_questions']) {
                session()->flash('error', "Subject {$subject['name']} requires {$subject['number_optional_questions']} optional questions, but {$optionalQuestionCount} were provided.");
                return; // Stop execution if there's a mismatch
            }
        }
    
        DB::beginTransaction();
    
        try {
            foreach ($this->quesarray as $index => $questionData) {
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
                        'answer' => $questionData['answer'] ?? null,
                    ]
                );
    
                if (isset($this->question_images[$index]) && $this->question_images[$index]) {
                    $questionImage = $this->question_images[$index];
                    $destinationPath = 'upload_questions';
                    $fileName = time() . '_' . $questionImage->getClientOriginalName();
    
                    // Move the uploaded file to the desired location
                    $questionImage->move(public_path($destinationPath), $fileName);
    
                    // Update the question's image path in the database
                    $question->update(['image' => $destinationPath . '/' . $fileName]);
                }
    
                if ($questionData['question_type'] === 'multiple_choice') {
                    foreach (['a', 'b', 'c', 'd'] as $key) {
                        if (isset($questionData['options'][$key])) {
                            $optionData = [
                                'key' => $key,
                                'text' => $questionData['options'][$key]['text'] ?? '',
                                'image' => null,
                            ];
    
                            if (isset($this->option_images[$index][$key]) && $this->option_images[$index][$key]) {
                                $optionImage = $this->option_images[$index][$key];
                                $fileName = time() . '_' . $optionImage->getClientOriginalName();
                                $path = $optionImage->storeAs('upload_options', $fileName, 'public');
                                $optionData['image'] = $path;
                            }
    
                            $question->options()->updateOrCreate(
                                ['question_id' => $question->id, 'key' => $key],
                                $optionData
                            );
                        }
                    }
                }
            }
    
            DB::commit();
            session()->flash('message', 'Questions and options saved successfully.');
            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving questions: ' . $e->getMessage());
            session()->flash('error', 'Error saving questions: ' . $e->getMessage());
        }
    }
    
    private function resetForm()
    {
        $this->test_id = null;
        $this->subject_id = null;
        $this->questions = 0;
        $this->subjects = [];
        $this->tests = Test::all();
        $this->quesarray = [];
        $this->activeQuestion = null;
        $this->question_images = [];
        $this->option_images = [];
    }
    

    private function validateMultipleChoiceQuestions()
    {
        foreach ($this->quesarray as $index => $questionData) {
            if ($questionData['question_type'] === 'multiple_choice') {
                $filledOptions = array_filter($questionData['options'], function ($option) {
                    return !empty($option['text']);
                });

                if (count($filledOptions) < 2) {
                    $this->addError("quesarray.{$index}.options", 'Multiple choice questions must have at least two options.');
                }

                if (empty($questionData['answer'])) {
                    $this->addError("quesarray.{$index}.answer", 'Please select a correct answer for the multiple choice question.');
                }
            }
        }
    }


    // -----------------------------------------------csv insert--------------------------------------------


    // public function importCsv()
    // {
    //     // $this->validate();

    //     try {
    //         $csv = Reader::createFromPath($this->csv_file->getRealPath())->setHeaderOffset(0);

    //         DB::beginTransaction();

    //         foreach ($csv as $row) {
    //             $question = Question::create([
    //                 'test_id' => $this->test_id,
    //                 'subject_id' => $this->subject_id,
    //                 'question_text' => $row['question_text'],
    //                 'question_type' => $row['question_type'],
    //                 'difficulty_level' => $row['difficulty_level'],
    //                 'marks' => $row['marks'],
    //                 'is_true' => $row['question_type'] === 'true_false' ? $row['is_true'] : null,
    //                 'is_optional' => $row['is_optional'] ?? false,
    //                 'answer' => $row['answer'] ?? null,
    //             ]);

    //             if ($row['question_type'] === 'multiple_choice') {
    //                 foreach (['a', 'b', 'c', 'd'] as $key) {
    //                     if (isset($row["option_{$key}"])) {
    //                         Option::create([
    //                             'question_id' => $question->id,
    //                             'key' => $key,
    //                             'text' => $row["option_{$key}"],
    //                         ]);
    //                     }
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         session()->flash('message', 'CSV imported successfully.');
    //         $this->reset(['csv_file']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         session()->flash('error', 'Error importing CSV: ' . $e->getMessage());
    //     }
    //     // session()->flash('message', 'Questions and options saved successfully.');
    // }


    public function render()
    {
        return view('livewire.question-form', [
            'tests' => $this->tests,
            'subjects' => $this->subjects,
        ]);
    }
}
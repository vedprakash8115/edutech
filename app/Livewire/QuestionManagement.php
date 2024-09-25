<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Test;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Option;
use League\Csv\Reader;

class QuestionManagement extends Component
{
    use WithFileUploads;

    public $test;
    public $subjects = [];
    public $questions = [];
    public $csvFile;

    protected $rules = [
        'questions.*.question_text' => 'required',
        'questions.*.question_type' => 'required|in:multiple_choice,true_false,short_answer,essay',
        'questions.*.difficulty_level' => 'nullable|in:easy,medium,hard',
        'questions.*.marks' => 'required|numeric',
        'questions.*.is_optional' => 'boolean',
        'questions.*.options' => 'required_if:questions.*.question_type,multiple_choice',
    ];

    public function mount($testId)
    {
        $this->test = Test::findOrFail($testId);
        $this->loadSubjects();
        $this->loadQuestions();
    }

    public function loadSubjects()
    {
        $this->subjects = $this->test->subjects;
    }

    public function loadQuestions()
    {
        $this->questions = $this->test->questions()
            ->with('options')
            ->get()
            ->groupBy('subject_id')
            ->toArray();  // Convert to array for easier manipulation
    
        // Initialize empty array if there are no questions for a subject
        foreach ($this->subjects as $subject) {
            if (!isset($this->questions[$subject->id])) {
                $this->questions[$subject->id] = [];
            }
        }
    }
    

    public function addQuestion($subjectId)
    {
        $subject = Subject::find($subjectId);
        
        // Ensure the questions array is initialized for this subject
        if (!isset($this->questions[$subjectId])) {
            $this->questions[$subjectId] = [];
        }
    
        $currentCount = count($this->questions[$subjectId]);
    
        if ($currentCount < $subject->number_of_questions) {
            $this->questions[$subjectId][] = [
                'question_text' => '',
                'question_type' => 'multiple_choice',
                'difficulty_level' => null,
                'marks' => 0,
                'is_optional' => false,
                'options' => [
                    ['key' => 'A', 'text' => ''],
                    ['key' => 'B', 'text' => ''],
                    ['key' => 'C', 'text' => ''],
                    ['key' => 'D', 'text' => ''],
                ],
            ];
        }
    }
    

    public function removeQuestion($subjectId, $index)
    {
        unset($this->questions[$subjectId][$index]);
        $this->questions[$subjectId] = array_values($this->questions[$subjectId]);
    }

    public function saveQuestions()
    {
        $this->validate();

        foreach ($this->questions as $subjectId => $subjectQuestions) {
            foreach ($subjectQuestions as $questionData) {
                $question = Question::updateOrCreate(
                    ['id' => $questionData['id'] ?? null],
                    [
                        'test_id' => $this->test->id,
                        'subject_id' => $subjectId,
                        'question_text' => $questionData['question_text'],
                        'question_type' => $questionData['question_type'],
                        'difficulty_level' => $questionData['difficulty_level'],
                        'marks' => $questionData['marks'],
                        'is_optional' => $questionData['is_optional'],
                    ]
                );

                if ($questionData['question_type'] === 'multiple_choice') {
                    foreach ($questionData['options'] as $optionData) {
                        Option::updateOrCreate(
                            ['id' => $optionData['id'] ?? null],
                            [
                                'question_id' => $question->id,
                                'key' => $optionData['key'],
                                'text' => $optionData['text'],
                            ]
                        );
                    }
                }
            }
        }

        session()->flash('message', 'Questions saved successfully.');
    }

    public function importCsv()
    {
        $this->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
        ]);
    
        $csv = Reader::createFromPath($this->csvFile->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
    
        foreach ($records as $record) {
            $subject = Subject::where('test_id', $this->test->id)
                              ->where('name', $record['subject'])
                              ->first();
    
            if (!$subject) {
                continue;
            }
    
            // Initialize the subject's questions if not already done
            if (!isset($this->questions[$subject->id])) {
                $this->questions[$subject->id] = [];
            }
    
            $currentCount = count($this->questions[$subject->id]);
    
            if ($currentCount < $subject->number_of_questions) {
                $question = new Question([
                    'test_id' => $this->test->id,
                    'subject_id' => $subject->id,
                    'question_text' => $record['question_text'],
                    'question_type' => $record['question_type'],
                    'difficulty_level' => $record['difficulty_level'],
                    'marks' => $record['marks'],
                    'is_optional' => $record['is_optional'],
                ]);
    
                $question->save();
    
                if ($record['question_type'] === 'multiple_choice') {
                    for ($i = 1; $i <= 4; $i++) {
                        Option::create([
                            'question_id' => $question->id,
                            'key' => chr(64 + $i),
                            'text' => $record["option_{$i}"],
                        ]);
                    }
                }
    
                $this->questions[$subject->id][] = $question;
            }
        }
    
        $this->csvFile = null;
        session()->flash('message', 'CSV imported successfully.');
    }
    

    public function render()
    {
        return view('livewire.question-management');
    }
}
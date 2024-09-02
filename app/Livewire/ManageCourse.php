<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class ManageCourse extends Component
{
    public $courseId;
    public $courseName;
    public $status;

    protected $rules = [
        'courseName' => 'required|string|max:255',
        'status' => 'boolean',
    ];

    public function mount($courseId)
    {
        $course = Course::findOrFail($courseId);
        $this->courseId = $course->id;
        $this->courseName = $course->name;
        $this->status = $course->status;
    }

    public function updateCourse()
    {
        $this->validate();

        $course = Course::findOrFail($this->courseId);
        $course->name = $this->courseName;
        $course->is_disabled = $this->isDisabled;
        $course->save();

        session()->flash('message', 'Course updated successfully.');
    }

    public function render()
    {
        
        return view('livewire.manage-course');
    }
}

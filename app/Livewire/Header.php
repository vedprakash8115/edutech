<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{

    public $isMenuOpen = false;
    public $currentStep = 1;
    public $maxStep = 1;

    public function mount($currentStep = 1, $maxStep = 1)
    {
        $this->currentStep = $currentStep;
        $this->maxStep = $maxStep;
    }

    public $steps = [
        ['icon' => 'fa-file-alt', 'text' => 'Create Test', 'route' => 'mock_test'],
        ['icon' => 'fa-book', 'text' => 'Manage Subjects', 'route' => 'mock_subjects'],
        ['icon' => 'fa-question-circle', 'text' => 'Manage Questions', 'route' => 'mock_questions'],
    ];

    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }
    public function toggleInstructions()
    {
        $this->showInstructions = !$this->showInstructions;
    }

  
    public function setStep($step)
    {
        $this->currentStep = $step;
        $this->maxStep = max($this->maxStep, $step);
    }
    public function render()
    {
        return view('livewire.header');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{

    public $isMenuOpen = false;

    public $steps = [
        ['icon' => 'fa-file-alt', 'text' => 'Create Test', 'route' => 'mock_test'],
        ['icon' => 'fa-book', 'text' => 'Manage Subjects', 'route' => 'mock_subjects'],
        ['icon' => 'fa-question-circle', 'text' => 'Manage Questions', 'route' => 'mock_questions'],
    ];

    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }
    public function render()
    {
        return view('livewire.header');
    }
}

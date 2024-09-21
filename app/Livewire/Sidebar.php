<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = ['reRenderComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.sidebar');
    }
}

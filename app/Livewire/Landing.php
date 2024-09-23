<?php

namespace App\Livewire;

use Livewire\Component;

class Landing extends Component
{
    public function render()
    {
        return view('livewire.landing')
            ->layout('layouts.app',
                [
                    'title' => 'Task Management',
                    'page_title' => 'Task Management'
                ]);
    }
}

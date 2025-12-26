<?php

namespace App\Livewire;

use Livewire\Component;

class Events extends Component
{
    public $activeTab = 'upcoming';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('events')
            ->extends('layouts.app')
            ->section('content');
    }
}

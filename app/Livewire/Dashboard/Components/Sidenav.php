<?php

namespace App\Livewire\Dashboard\Components;

use Livewire\Component;

class Sidenav extends Component {
    public $user;

    public function mount() {
        $this->user = auth()->user();
    }

    public function render() {
        return view('livewire.dashboard.components.sidenav');
    }
}
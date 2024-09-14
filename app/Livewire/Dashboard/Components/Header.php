<?php

namespace App\Livewire\Dashboard\Components;

use Livewire\Component;

class Header extends Component {
    public $header;
    
    public function render() {
        return view('livewire.dashboard.components.header');
    }
}
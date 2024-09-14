<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Dasboard extends Component {
    public function render() {
        return view('livewire.dashboard.dasboard')
            ->layout('layouts.dashboard', [
                'header' => 'Dashboard'
            ]);
    }
}
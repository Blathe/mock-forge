<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardCard extends Component
{
    public $title;
    public $description;
    public $number;
    public $icon;
    public $color;
    public $lower_text;

    public function render()
    {
        return view('livewire.dashboard-card');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class FAQDetails extends Component
{
    public $title;
    public $body;

    public function render()
    {
        return view('livewire.faq-details');
    }
}

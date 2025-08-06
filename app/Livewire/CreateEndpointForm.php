<?php

namespace App\Livewire;

use App\Livewire\Forms\EndpointForm;
use Livewire\Component;

class CreateEndpointForm extends Component
{
    public EndpointForm $form;

    public function save() {
        $this->form->submit();
    }

    public function render()
    {
        return view('livewire.create-endpoint-form');
    }
}

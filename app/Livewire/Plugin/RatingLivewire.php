<?php

namespace App\Livewire\Plugin;

use Livewire\Component;

class RatingLivewire extends Component
{
    public $value;
    public function render()
    {
        return view('livewire.plugin.rating-livewire');
    }
}

<?php

namespace App\Livewire\Plugin;

use Livewire\Component;

class PlyrLivewire extends Component
{
    public $embedId;
    public $autoplay = true;
    public $id = "mediaPlayer";

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

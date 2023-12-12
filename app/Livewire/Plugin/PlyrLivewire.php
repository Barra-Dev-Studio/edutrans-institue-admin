<?php

namespace App\Livewire\Plugin;

use Livewire\Component;

class PlyrLivewire extends Component
{
    public $embedId;
    public $autoplay = true;
    public $id = "mediaPlayer";
    public $source = 'amazons3';

    public function mount()
    {
        if (str_contains($this->embedId, 'youtube.com')) {
            $this->source = 'youtube';
        }
    }

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

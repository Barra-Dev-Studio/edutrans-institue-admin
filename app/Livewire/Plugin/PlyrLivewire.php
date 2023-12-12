<?php

namespace App\Livewire\Plugin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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

        if (!str_contains($this->embedId, 'youtube.com')) {
            $this->processThePresignedUrl();
        }
    }

    private function processThePresignedUrl(): void
    {
        $this->embedId = Storage::disk('s3')->temporaryUrl($this->embedId, Carbon::now()->addMinute(10));
    }

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

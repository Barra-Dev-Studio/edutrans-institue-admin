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
        $embedId = Storage::disk('s3')->temporaryUrl($this->embedId, Carbon::now()->addMinutes(120));
        $this->embedId = str_contains($embedId, "%2B") ? str_replace("%2B", "+", $embedId) : $embedId;
    }

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

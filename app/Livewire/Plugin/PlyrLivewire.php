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
        if (str_contains($this->embedId, 'youtube.com') || str_contains($this->embedId, 'youtu.be')) {
            $this->source = 'youtube';
        }

        if (!str_contains($this->embedId, 'youtube.com') && !str_contains($this->embedId, 'youtu.be')) {
            $this->processThePresignedUrl();
        }
    }

    private function processThePresignedUrl(): void
    {
        $this->embedId = Storage::disk('s3')->temporaryUrl($this->embedId, Carbon::now()->addMinutes(120));
//        $this->embedId = str_replace('edutransinstitute.s3.ap-southeast-1.amazonaws.com', 'dbtu2xul1ioz8.cloudfront.net', $embedId);
    }

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

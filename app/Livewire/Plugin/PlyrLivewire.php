<?php

namespace App\Livewire\Plugin;

use App\Models\Course;
use Carbon\Carbon;
use Dreamonkey\CloudFrontUrlSigner\Facades\CloudFrontUrlSigner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PlyrLivewire extends Component
{
    public $embedId;
    public $autoplay = true;
    public $id = "mediaPlayer";
    public $source = 'amazons3';
    public $course;
    public $courseId;

    public function mount()
    {
        if (str_contains($this->embedId, 'youtube.com') || str_contains($this->embedId, 'youtu.be')) {
            $this->source = 'youtube';
        }

        if (!str_contains($this->embedId, 'youtube.com') && !str_contains($this->embedId, 'youtu.be')) {
            $this->processThePresignedUrl();
        }

        $this->course = Course::find($this->courseId);
    }

    private function processThePresignedUrl(): void
    {
        if(env('AWS_CLOUDFRONT_ACTIVE')) {
            $this->embedId = CloudFrontUrlSigner::sign(env("AWS_CLOUDFRONT_ENDPOINT") . str_replace(' ', '%20', $this->embedId));
        } else {
            $this->embedId = Storage::disk('s3')->temporaryUrl($this->embedId, Carbon::now()->addMinutes(120));
        }
    }

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

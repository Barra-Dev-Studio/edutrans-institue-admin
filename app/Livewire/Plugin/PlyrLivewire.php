<?php

namespace App\Livewire\Plugin;

use Aws\S3\S3Client;
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
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ]
        ]);

        $command = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $this->embedId
        ]);

        $request = $s3Client->createPresignedRequest($command, '+15 minutes');
        $this->embedId = (string) $request->getUri();
    }

    public function render()
    {
        return view('livewire.plugin.plyr-livewire');
    }
}

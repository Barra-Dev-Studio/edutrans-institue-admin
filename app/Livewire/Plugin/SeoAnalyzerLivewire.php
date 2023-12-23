<?php

namespace App\Livewire\Plugin;

use App\Livewire\Pages\Post\PostCreateLivewire;
use App\Livewire\Pages\Post\PostUpdateLivewire;
use App\Models\Post;
use App\Services\SeoAnalyzerService;
use Livewire\Component;

class SeoAnalyzerLivewire extends Component
{
    public $listeners = [
        PostCreateLivewire::ANALYZE_POST_CREATE_LIVEWIRE => 'analyzeSeo',
        PostUpdateLivewire::ANALYZE_POST_UPDATE_LIVEWIRE => 'analyzeSeo',
    ];

    public $data;
    public $results;
    public $id = null;

    public function mount()
    {
        $post = Post::where('id', $this->id)->first();
        $this->data = (object) [
            'title' => $post->title ?? '',
            'description' => $post->description ?? '',
            'main_keyword' => $post->main_keyword ?? '',
            'keyword' => $post->keyword ?? '',
            'content' => $post->content ?? '',
            'alt_image' => $post->alt_image ?? '',
        ];

        $SEOAnalyzer = new SeoAnalyzerService($this->data);
        $this->results = $SEOAnalyzer->analyze();
    }

    public function analyzeSeo($seoData)
    {
        $this->data->title = $seoData['title'];
        $this->data->description = $seoData['description'];
        $this->data->main_keyword = $seoData['main_keyword'];
        $this->data->keyword = $seoData['keyword'];
        $this->data->content = $seoData['content'];

        $SEOAnalyzer = new SeoAnalyzerService($this->data);
        $this->results = $SEOAnalyzer->analyze();
    }
    public function render()
    {
        return view('livewire.plugin.seo-analyzer-livewire');
    }
}

<?php

namespace App\Livewire\Pages\Post;

use App\Livewire\Plugin\CKEditorLivewire;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostUpdateLivewire extends Component
{
    use WithFileUploads;

    const ANALYZE_POST_UPDATE_LIVEWIRE = 'analyze_post_update_livewire';
    public $statuses = [
        ['id' => 'PUBLISH', 'name' => 'PUBLISH'],
        ['id' => 'DRAFT', 'name' => 'DRAFT']
    ];

    public $id;
    public $currentThumbnail;

    public $title;
    public $slug;
    public $content;
    public $thumbnail;
    public $tags;
    public $author;
    public $description;
    public $status;
    public $keyword;
    public $mainKeyword;
    public $altImage;
    public $categoryId;

    public $categories;

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'content' => 'required',
        'tags' => 'required',
        'author' => 'required',
        'description' => 'required',
        'status' => 'required',
        'keyword' => 'required',
        'mainKeyword' => 'required',
        'altImage' => 'required',
    ];

    public function mount()
    {
        $post = Post::where('id', $this->id)->first();
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->currentThumbnail = $post->thumbnail;
        $this->tags = $post->tags;
        $this->author = $post->author;
        $this->description = $post->description;
        $this->status = $post->status;
        $this->keyword = $post->keyword;
        $this->categoryId = $post->category_id;
        $this->mainKeyword = $post->main_keyword;
        $this->altImage = $post->alt_image;

        $this->categories = CategoryPost::orderBy('name')->get();

        $seoData = [
            'title' => $this->title,
            'description' => $this->description,
            'main_keyword' => $this->mainKeyword,
            'keyword' => $this->keyword,
            'content' => $this->content,
            'alt_image' => $this->altImage,
        ];
        $this->dispatch(self::ANALYZE_POST_UPDATE_LIVEWIRE, $seoData);
    }

    public $listeners = [
        CKEditorLivewire::EVENT_VALUE_UPDATED => 'updateFromCKEditor'
    ];

    public function updateFromCKEditor($value)
    {
        $this->content = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $seoData = [
            'title' => $this->title,
            'description' => $this->description,
            'main_keyword' => $this->mainKeyword,
            'keyword' => $this->keyword,
            'content' => $this->content,
            'alt_image' => $this->altImage,
        ];
        $this->dispatch(self::ANALYZE_POST_UPDATE_LIVEWIRE, $seoData);
    }

    public function updateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function submit()
    {
        $this->validate();
        try {
            $thumbnail = $this->thumbnail ? $this->thumbnail->store('posts') : $this->currentThumbnail;
            $isUpdated = Post::where('id', $this->id)->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'tags' => $this->tags,
                'author' => $this->author,
                'description' => $this->description,
                'status' => $this->status,
                'thumbnail' => $thumbnail,
                'keyword' => $this->keyword,
                'category_id' => $this->categoryId,
                'alt_image' => $this->altImage,
                'main_keyword' => $this->mainKeyword,
            ]);
            if (Storage::exists($this->currentThumbnail) && $isUpdated && $this->thumbnail) {
                Storage::delete($this->currentThumbnail);
            }
            return redirect()->route('dashboard.post.index')->with('success', 'Post updated successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update post');
        }
    }

    public function render()
    {
        return view('livewire.pages.post.post-update-livewire');
    }
}

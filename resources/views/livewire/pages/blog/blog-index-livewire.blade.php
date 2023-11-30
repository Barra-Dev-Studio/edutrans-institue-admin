<div>
    <a href="{{ route('blog.show', $featuredPost->slug) }}">
        <div class="card">
            <div class="card-body bg-slate-50 rounded border-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                    <div class="block md:hidden">
                        <img src="{{ \Storage::url($featuredPost->thumbnail) }}" class="rounded" alt="{{ $featuredPost->title }}">
                    </div>
                    <div class="md:p-8">
                        <div class="prose">
                            <h1 class="text-slate-800 mb-0">{{ $featuredPost->title }}</h1>
                            <p class="text-lg text-slate-500">{{ $featuredPost->description }}</p>
                            <div class="mb-4">
                                <span class="text-slate-500 mr-4">{{ $featuredPost->author }}</span><span class="text-slate-400">{{ \Carbon\Carbon::parse($featuredPost->created_at)->format('d F, Y') }}</span>
                            </div>
                            @foreach(explode(',', $featuredPost->tags) as $tag)
                            <span class="bg-blue-100 text-blue-600 text-sm px-4 py-2 rounded">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ \Storage::url($featuredPost->thumbnail) }}" class="rounded" alt="{{ $featuredPost->title }}">
                    </div>
                </div>
            </div>
        </div>
    </a>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8 mt-8">
        @forelse($posts as $post)
        <a href="{{ route('blog.show', $post->slug) }}">
            <div class="card h-full bg-slate-50">
                <div class="card-body h-full flex flex-col justify-between">
                    <div class="mb-0 md:mb-4 hidden md:block">
                        <img src="{{ \Storage::url($post->thumbnail) }}" class="rounded" alt="{{ $post->thumbnail}}">
                        <div class="hidden md:block md:mt-8">
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="bg-slate-200 text-slate-600 text-sm px-4 py-2 rounded">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="prose py-0">
                            <h4 class="text-slate-800 mt-4 line-clamp-2">{{ $post->title }}</h4>
                            <p class="text-slate-500 line-clamp-2 mb-8">{{ $post->description }}</p>
                        </div>
                    </div>
                    <div>
                        <span class="text-slate-400">{{ \Carbon\Carbon::parse($post->created_at)->format('d F, Y') }}</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        @endforelse
    </div>
    <div class="mt-8">
        {{ $posts->onEachSide(1)->links() }}
    </div>
</div>

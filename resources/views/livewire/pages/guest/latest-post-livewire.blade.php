<div class="md:px-16 py-10">
    <div class="px-6 md:px-8">
        <h3 class="mb-8">Postingan terbaru</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-8 mt-8">
            @forelse($posts as $post)
                <a href="{{ route('blog.show', $post->slug) }}">
                    <div class="card h-full bg-slate-50">
                        <div class="card-body h-full flex flex-col justify-between">
                            <div class="mb-0 md:mb-4 block">
                                <img src="{{ \Storage::url($post->thumbnail) }}" class="rounded hidden md:block" alt="{{ $post->thumbnail}}">
                                <div class="hidden md:block md:mt-8">
                                    <span class="bg-slate-200 text-slate-600 text-sm px-4 py-2 rounded">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                </div>
                                <div class="prose py-0">
                                    <h4 class="text-slate-800 mt-4 line-clamp-2">{{ $post->title }}</h4>
                                    <p class="text-slate-500 line-clamp-2 mb-8">{{ $post->description }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-700 font-medium">{{ $post->author }}</span>
                                <span class="text-slate-400">{{ \Carbon\Carbon::parse($post->created_at)->format('d F, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </div>
    </div>
</div>

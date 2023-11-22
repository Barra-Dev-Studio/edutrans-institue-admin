<x-blog-layout>
    @section('opengraph')
    <title>{{ $post->title }} | Edutrans Institue</title>
    <meta name="title" content="{{ $post->title }} | Edutrans Institue" />
    <meta name="description" content="{{ $post->description }}" />
    <meta name="author" content="{{ $post->author }}" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}" />
    <meta property="og:title" content="{{ $post->title }} | Edutrans Institue" />
    <meta property="og:description" content="{{ $post->description }}" />
    <meta property="og:image" content="{{ \Storage::url($post->thumbnail) }}" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ route('blog.show', $post->slug) }}" />
    <meta property="twitter:title" content="{{ $post->title }} | Edutrans Institue" />
    <meta property="twitter:description" content="{{ $post->description }}" />
    <meta property="twitter:image" content="{{ \Storage::url($post->thumbnail) }}" />
    @endsection


    <div class="md:p-16">
        <div class="px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                <div class="card md:col-span-2">
                    <div class="card-body bg-slate-50">
                        <div class="prose">
                            <h1>{{ $post->title }}</h1>
                            <p class="text-lg text-slate-500"><span class="font-medium mr-8">{{ $post->author }}</span><span>{{ \Carbon\Carbon::parse($post->created_at)->format('d F, Y') }}</span></p>
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="bg-blue-100 text-blue-600 text-sm px-4 py-2 rounded">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="prose mt-8">
                            <img src="{{ \Storage::url($post->thumbnail) }}" class="rounded" alt="{{ $post->title }}">
                        </div>
                        <div class="prose mt-8">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
                <div class="card bg-slate-50">
                    <div class="card-body">
                        <div class="prose">
                            <h4 class="text-slate-800">Mungkin kamu tertarik</h4>
                            <div class="flex flex-col items-center gap-4">
                                @forelse($anotherPosts as $post)
                                <a href="{{ route('blog.show', $post->slug )}}">
                                    <div class="flex gap-4 items-center border-b border-slate-200 hover:bg-slate-100 rounded">
                                        <div class="w-24">
                                            <img src="{{ \Storage::url($post->thumbnail) }}" alt="{{ $post->title }}">
                                        </div>
                                        <h6 class="!no-underline">{{ $post->title }}</h6>
                                    </div>
                                </a>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-blog-layout>

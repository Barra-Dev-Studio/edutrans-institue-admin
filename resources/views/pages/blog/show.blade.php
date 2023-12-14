<x-blog-layout>
    @section('opengraph')
    <title>{{ $post->title }} | Edutrans Institue</title>
    <meta name="title" content="{{ $post->title }} | Edutrans Institue" />
    <meta name="description" content="{{ $post->description }}" />
    <meta name="author" content="{{ $post->author }}" />
    <meta name="keywords" content="{{ $post->keyword }}"/>

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
                <div class="md:col-span-2">
                    <div class="card">
                        <div class="card-body bg-white">
                            <div class="prose p-1 md:p-8">
                                <h1>{{ $post->title }}</h1>
                                <p class="text-slate-500"><span class="mr-8">{{ $post->author }}</span><span>{{ \Carbon\Carbon::parse($post->created_at)->format('d F, Y') }}</span></p>
                                <span class="bg-slate-200 text-slate-600 text-sm px-4 py-2 rounded">{{ $post->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="prose mt-8 px-1 md:px-8">
                                <img src="{{ \Storage::url($post->thumbnail) }}" class="rounded" alt="{{ $post->title }}">
                            </div>
                            <div class="prose mt-8 px-1 md:px-8">
                                {!! $post->content !!}
                            </div>
                            <div class="prose mt-8 px-1 md:px-8">
                                @foreach(explode(',', $post->tags) as $tag)
                                    <span class="bg-slate-200 text-slate-600 text-sm px-4 py-2 rounded">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body bg-white pb-8">
                            <p class="text-slate-500 mb-6">Jika kamu merasa postingan ini bermanfaat, bagikan dengan cara klik tombol di bawah</p>
                            {!! $shareComponent !!}
                        </div>
                    </div>
                </div>
                <div class="card border-none">
                    <div class="card-body bg-white border border-gray-50 sticky top-8">
                        <div class="prose mb-8">
                            <h4 class="text-slate-800 mb-1">Jelajahi kursus populer</h4>
                            <p class="line-clamp-2 text-sm text-slate-500 mt-0 mb-4">Ikuti kursus populer di bawah ini</p>
                            <div class="flex flex-col justify-center">
                                @forelse($courses as $course)
                                    <a href="{{ route('course.detail', $course->slug )}}" class="!no-underline">
                                        <div class="grid grid-cols-4 gap-4 items-center border-b border-slate-200 hover:bg-slate-100 rounded">
                                            <div class="w-full col-span-1">
                                                <img src="{{ \Storage::url($course->thumbnail) }}" alt="{{ $course->title }}">
                                            </div>
                                            <div class="col-span-3">
                                                <h6 class="mb-0">{{ $course->title }}</h6>
                                                <p class="line-clamp-2 text-sm text-slate-500 mt-0">oleh {{ $course->mentor->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p>Nantikan kursus menarik di Edutrans Institute</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="prose">
                            <h4 class="text-slate-800 mb-1">Mungkin kamu tertarik</h4>
                            <p class="line-clamp-2 text-sm text-slate-500 mt-0 mb-4">Baca artikel lain yang menarik di bawah ini</p>
                            <div class="flex flex-col justify-center">
                                @forelse($anotherPosts as $post)
                                <a href="{{ route('blog.show', $post->slug )}}" class="!no-underline">
                                    <div class="grid grid-cols-4 gap-4 items-center border-b border-slate-200 hover:bg-slate-100 rounded">
                                        <div class="w-full col-span-1">
                                            <img src="{{ \Storage::url($post->thumbnail) }}" alt="{{ $post->title }}">
                                        </div>
                                        <div class="col-span-3">
                                            <h6 class="mb-0 line-clamp-2">{{ $post->title }}</h6>
                                            <p class="line-clamp-2 text-sm text-slate-500 mt-0">{{ $post->description }}</p>
                                        </div>
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

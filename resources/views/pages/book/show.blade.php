<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Book management</x-slot>
        <x-breadcrumb-item>Book management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $book->title }}</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Book data</h5>
        </div>
        <div class="card-body">
            <div class="flex justify-between">
                <div class="col-span-3">
                    <div class="prose">
                        <h1 class="mb-0 text-slate-800">{{ $book->title }}</h1>
                        <p class="text-slate-600">
                            {{ $book->author->name }}<br>
                            {{ $book->published_year}} .
                            {{ $book->publisher }}
                        </p>
                        <p class="text-slate-400">{!! $book->description !!}</p>
                        <span class="p-2 bg-slate-100 rounded border border-slate-200 text-slate-800">{{
                            $book->category->name }}</span>
                    </div>
                </div>
                <div class="w-[230px] h-[345px] rounded shadow">
                    <img src="{{ \Storage::url($book->cover) }}" class="object-cover w-full h-full"
                        alt="{{ $book->title }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Book statistic</h5>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-4 gap-2">
                <div class="bg-slate-50 rounded border border-slate-200">
                    <div class="border-b border-slate-200 p-2">
                        <p>Total pages</p>
                    </div>
                    <div class="p-2">
                        <h2 class="text-slate-600">{{ $book->total_pages }}</h2>
                    </div>
                </div>
                <div class="bg-slate-50 rounded border border-slate-200">
                    <div class="border-b border-slate-200 p-2">
                        <p>Total views</p>
                    </div>
                    <div class="p-2">
                        <h2 class="text-slate-600">{{ $book->total_views }}</h2>
                    </div>
                </div>
                <div class="bg-slate-50 rounded border border-slate-200">
                    <div class="border-b border-slate-200 p-2">
                        <p>Total shares</p>
                    </div>
                    <div class="p-2">
                        <h2 class="text-slate-600">{{ $book->total_shares }}</h2>
                    </div>
                </div>
                <div class="bg-slate-50 rounded border border-slate-200">
                    <div class="border-b border-slate-200 p-2">
                        <p>Total purchased</p>
                    </div>
                    <div class="p-2">
                        <h2 class="text-slate-600">{{ $book->total_purchased }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Section management</x-slot>
        <x-breadcrumb-item>Section management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $section->title }}</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Section data</h5>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-4 gap-8">
                <div class="w-full h-full overflow-hidden rounded">
                    <img src="{{ \Storage::url($section->photo) }}" alt="{{ $section->title }}">
                </div>
                <div class="col-span-3">
                    <div class="prose">
                        <h1 class="mb-1 text-slate-800">{{ $section->title }}</h1>
                        <div class="text-slate-600">{!! $section->content !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

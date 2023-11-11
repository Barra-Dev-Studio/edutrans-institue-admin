<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Mentor management</x-slot>
        <x-breadcrumb-item>Mentor management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $mentor->name }}</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Mentor data</h5>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-4 gap-8">
                <div class="w-full h-full overflow-hidden rounded">
                    <img src="{{ \Storage::url($mentor->photo) }}" alt="">
                </div>
                <div class="col-span-3">
                    <div class="prose">
                        <h1 class="mb-1 text-slate-800">{{ $mentor->name }}</h1>
                        <span class="text-slate-500">{{ $mentor->speciality }}</span>
                        <p class="text-slate-600">{!! $mentor->bio !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

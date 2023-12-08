<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Chapter management</x-slot>
        <x-breadcrumb-item>Chapter management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $chapter->title }}</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <div class="grid grid-cols-3 gap-4">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 col-span-2">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Playback</h5>
            </div>
            <div class="card-body">
                <livewire:plugin.plyr-livewire id="player" :embedId="$chapter->playback_url" :autoplay="false"
                    wire:key="{{ $chapter->id }}"></livewire:plugin.plyr-livewire>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">information</h5>
            </div>
            <div class="card-body">
                <div class="prose mt-4">
                    <h3 class="mt-0">{{ $chapter->title }}</h3>
                    <p>{{ $chapter->description }}</p>
                    <table class="table">
                        <tbody>
                            <tr class="bg-slate-100">
                                <td class="p-4">Duration</td>
                                <td class="p-4">{{ $chapter->duration }}m</td>
                            </tr>
                            <tr class="bg-slate-100">
                                <td class="p-4">Is preview</td>
                                <td class="p-4">{{ $chapter->is_preview ? "Yes" : "No" }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

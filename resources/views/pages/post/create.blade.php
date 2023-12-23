<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Post management</x-slot>
        <x-breadcrumb-item>Post management</x-breadcrumb-item>
        <x-breadcrumb-item>Create post</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="grid grid-cols-2 gap-4">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Create post</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <livewire:pages.post.post-create-livewire></livewire:pages.post.post-create-livewire>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Analyze SEO</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <livewire:plugin.seo-analyzer-livewire></livewire:plugin.seo-analyzer-livewire>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

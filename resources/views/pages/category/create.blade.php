<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Category management</x-slot>
        <x-breadcrumb-item>Category management</x-breadcrumb-item>
        <x-breadcrumb-item>Create category</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full md:w-1/2">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Create category</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <livewire:pages.category.category-create-livewire></livewire:pages.category.category-create-livewire>
            </div>
        </div>
    </div>
</x-app-layout>

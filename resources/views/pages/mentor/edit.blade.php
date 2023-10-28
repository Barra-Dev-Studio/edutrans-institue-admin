<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Mentor management</x-slot>
        <x-breadcrumb-item>Mentor management</x-breadcrumb-item>
        <x-breadcrumb-item>Update mentor</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full md:w-1/2">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Update mentor</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <livewire:pages.mentor.mentor-update-livewire :id="$id"></livewire:pages.mentor.mentor-update-livewire>
            </div>
        </div>
    </div>
</x-app-layout>

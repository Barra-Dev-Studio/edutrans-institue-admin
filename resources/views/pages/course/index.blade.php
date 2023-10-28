<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Course management</x-slot>
        <x-breadcrumb-item>Course management</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="flex justify-end items-center mb-4">
        <a href="{{ route('dashboard.course.create') }}"
            class="bg-emerald-500 px-6 py-3 rounded text-white hover:bg-emerald-600">Create new course</a>
    </div>
    <x-flash-notification></x-flash-notification>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Course data</h5>
        </div>
        <div class="card-body">
            <livewire:pages.course.course-table-livewire></livewire:pages.course.course-table-livewire>
        </div>
    </div>
</x-app-layout>

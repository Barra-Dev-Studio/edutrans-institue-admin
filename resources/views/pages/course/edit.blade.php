<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Course management</x-slot>
        <x-breadcrumb-item>Course management</x-breadcrumb-item>
        <x-breadcrumb-item>Update course</x-breadcrumb-item>
    </x-breadcrumb>

    <livewire:pages.course.course-update-livewire :id="$id"></livewire:pages.course.course-update-livewire>
</x-app-layout>

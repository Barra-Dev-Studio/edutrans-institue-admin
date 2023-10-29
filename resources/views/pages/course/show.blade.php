<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Course management</x-slot>
        <x-breadcrumb-item>Course management</x-breadcrumb-item>
        <x-breadcrumb-item>Detail</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $course->title }}</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <livewire:pages.course.course-show-livewire :course="$course"></livewire:pages.course.course-show-livewire>
</x-app-layout>

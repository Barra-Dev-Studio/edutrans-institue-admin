<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">{{ $course->title }}</x-slot>
        <x-breadcrumb-item>Play course</x-breadcrumb-item>
    </x-breadcrumb>
    <x-flash-notification></x-flash-notification>
    <div class="mb-24">
        <livewire:pages.member.course-play-livewire :course="$course" :sections="$sections"></livewire:pages.member.course-play-livewire>
    </div>
</x-app-layout>

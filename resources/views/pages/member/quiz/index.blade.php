<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Quiz</x-slot>
        <x-breadcrumb-item>{{ $ownedCourse->title }}</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50">
        <div class="card-body pb-4">
            <h5 class="dark:text-zinc-100">{{ $ownedCourse->title }}</h5>
        </div>
    </div>
    <x-flash-notification></x-flash-notification>
    <livewire:pages.member.quiz-play-livewire :owned-course="$ownedCourse"></livewire:pages.member.quiz-play-livewire>
</x-app-layout>

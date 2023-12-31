<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Quiz management</x-slot>
        <x-breadcrumb-item>Quiz management</x-breadcrumb-item>
        <x-breadcrumb-item>Create question</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full md:w-1/2">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Create question</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <livewire:pages.quiz.quiz-create-livewire :courseId="$courseId"></livewire:pages.quiz.quiz-create-livewire>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Quiz</x-slot>
        <x-breadcrumb-item>Result</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $ownedCourse->title }}</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="card bg-slate-50">
        <div class="p-8 text-center">
            <p class="text-lg text-slate-500">Hi {{ auth()->user()->name }}!</p>
            <p class="text-lg text-slate-500">Selamat kamu telah menyelesaikan quiz dari course berjudul</p>
            <h3 class="dark:text-zinc-100 my-4">{{ $ownedCourse->title }}</h3>
            <p class="text-lg text-slate-500">Dengan perolehan skor</p>
            <h1 class="dark:text-zinc-100 my-4">{{ $scores }}</h1>
            <p class="mb-16 text-slate-500 text-lg">Jawaban benar {{ $correctAnswers }} dari {{ $totalAnswers }}</p>
            <div class="mt-16 mb-8">
                <span class="bg-gray-900 text-white py-4 px-8 text-lg rounded mt-8">
                    <a href="{{ route('member.play', $ownedCourse->id) }}">Kembali</a>
                </span>
            </div>
        </div>
    </div>
    <x-flash-notification></x-flash-notification>

</x-app-layout>

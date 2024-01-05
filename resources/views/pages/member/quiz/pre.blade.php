<x-app-layout>
    <x-breadcrumb>
        <x-slot name="title">Quiz</x-slot>
        <x-breadcrumb-item>Result</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $ownedCourse->title }}</x-breadcrumb-item>
    </x-breadcrumb>
    <div class="card bg-slate-50">
        <div class="p-8 text-center flex flex-col">
            <p class="text-lg text-slate-500">Hi {{ auth()->user()->name }}!</p>
            <p class="text-lg text-slate-500">Kamu akan mulai mengerjakan quiz di course berjudul</p>
            <h3 class="dark:text-zinc-100 my-4">{{ $ownedCourse->title }}</h3>
            <p class="text-lg text-slate-500">Setiap kamu mengerjakan quiz ini, riwayat quiz sebelumnya akan dihapus.
                Kamu tidak bisa menskip soal dan tidak bisa berpindah soal.
                Setiap soal memiliki durasi pengerjaan, jadi perhatikan dengan baik.
                Jawab dengan memilih jawaban yang dirasa benar dari jawaban yang tersedia.
                Semoga berhasil.</p>
            <div class="mt-16 mb-8">
                <span class="bg-gray-900 text-white py-4 px-8 text-lg rounded mt-8">
                    <a href="{{ route('member.quiz.index', $ownedCourse->id) }}">Mulai mengerjakan</a>
                </span>
            </div>
        </div>
    </div>
    <x-flash-notification></x-flash-notification>

</x-app-layout>

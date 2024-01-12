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
            <p class="text-lg text-slate-500 md:px-16">Setiap kali Anda menyelesaikan kuis ini, riwayat kuis sebelumnya akan dihapus.
                Anda tidak dapat melewati soal dan tidak dapat beralih ke soal lain.
                Setiap soal memiliki batas waktu pengerjaan, oleh karena itu harap perhatikan dengan seksama.
                Jawablah dengan memilih jawaban yang dianggap benar dari opsi jawaban yang tersedia. S
                emoga Anda berhasil.</p>
            <p class="text-lg text-slate-500 md:px-16">Persyaratan untuk mendapatkan sertifikat adalah dengan menyelesaikan kuis.
                Anda dianggap berhasil menyelesaikan kuis jika skor Anda telah melebihi 80% dari skor kelulusan minimum.</p>
            <div class="mt-16 mb-8">
                <span class="bg-gray-900 text-white py-4 px-8 text-lg rounded mt-8 hover:bg-gray-950 cursor-pointer">
                    <a href="{{ route('member.quiz.index', $ownedCourse->id) }}">Mulai mengerjakan</a>
                </span>
            </div>
        </div>
    </div>
    <x-flash-notification></x-flash-notification>

</x-app-layout>

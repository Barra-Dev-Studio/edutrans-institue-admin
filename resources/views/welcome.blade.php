<x-guest-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 md:px-16 pt-4 md:pt-16 items-center">
        <div class="pl-6 pr-6 md:pr-0 md:pl-8 prose pb-8">
            <p class="font-medium text-sky-800">#TransformasiPositifBersamaEdutrans</p>
            <h1 class="leading-snug mb-0">Menjembatani Ilmu dan Aksi Bersama Edutrans Institute</h1>
            <p class="mt-2">Online course bersertifikat paling diminati berbagai kalangan dengan berbagai materi dan kategori paling update.</p>
            <div class="flex items-start md:items-center gap-1 md:gap-4 flex-col md:flex-row mt-8 md:mt-0">
                <a href="{{ route('courses') }}" class="bg-sky-800 px-6 py-3 rounded text-white hover:bg-sky-900 no-underline">Jelajahi kursus</a>
                <p class="text-sky-800 font-medium">Dipercaya berbagai lembaga dan institusi</p>
            </div>
        </div>
        <div class="pr-8 md:flex justify-end hidden">
            <img src="{{ asset('assets/images/hero.png') }}" class="h-[388px]" alt="Edutrans Institute">
        </div>
    </div>
    <div class="bg-sky-900">
        <div class="md:px-16 py-10">
            <div class="px-6 md:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 items-start justify-between gap-8 md:gap-4">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded bg-slate-200 flex items-center justify-center text-3xl text-sky-800 mt-2">
                            <i class="bx bx-book-content"></i>
                        </div>
                        <div class="w-2/3">
                            <h5 class="text-white">Great courses</h5>
                            <p class="text-slate-300 font-light">Berbagai kategori kursus yang bisa dipelajari dari berbagai bidang</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded bg-slate-200 flex items-center justify-center text-3xl text-sky-800 mt-2">
                            <i class="bx bx-book-content"></i>
                        </div>
                        <div class="w-2/3">
                            <h5 class="text-white">Professional Instructor</h5>
                            <p class="text-slate-300 font-light">Instruktur ahli dan professional yang berpengalaman di bidangnya</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded bg-slate-200 flex items-center justify-center text-3xl text-sky-800 mt-2">
                            <i class="bx bx-book-content"></i>
                        </div>
                        <div class="w-2/3">
                            <h5 class="text-white">Get Certified</h5>
                            <p class="text-slate-300 font-light">Materi bersertifikat untuk dan terus ditingkatkan serta diperbaharui</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded bg-slate-200 flex items-center justify-center text-3xl text-sky-800 mt-2">
                            <i class="bx bx-book-content"></i>
                        </div>
                        <div class="w-2/3">
                            <h5 class="text-white">Easy Access</h5>
                            <p class="text-slate-300 font-light">Akses materi dari mana saja, kapan saja, dan dari device apa saja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

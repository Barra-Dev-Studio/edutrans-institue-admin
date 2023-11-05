<x-guest-layout>
    <div class="bg-sky-900 pt-16 px-16">
        <div class="px-8">
            <div class="grid grid-cols-3 items-start">
                <div class="col-span-2">
                    <p class="text-slate-300 mb-4 prose">Kategori {{ $course->category->name }}</p>
                    <h1 class="text-white text-5xl leading-snug">{{ $course->title }}</h1>
                    <div class="flex items-center gap-4 mt-4">
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-zinc-500" src="{{ \Storage::url($course->mentor->photo) }}" alt="">
                        <div>
                            <h5 class="text-white">{{ $course->mentor->name }}</h5>
                            <p class="text-slate-300">{{ $course->mentor->speciality }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1692312344458-9a4d495f7163?auto=format&fit=crop&q=80&w=2071&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-t" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-16 pb-16">
        <div class="px-8">
            <div class="grid grid-cols-3">
                <div class="col-span-2">
                    <div class="prose pt-16">
                        <h2>Deskripsi</h2>
                        <p>{{ $course->description }}</p>
                        <h2>Catatan</h2>
                        <p>{{ $course->notes ?? 'Tidak ada catatan untuk kursus ini' }}</p>
                        <h2>Konten kursus</h2>
                    </div>
                    <div class="mt-8">
                        <div data-tw-accordion="collapse">
                            @foreach($chapters as $section => $chapter)
                            <div class="text-slate-700 accordion-item">
                                <h2>
                                    <button type="button"
                                        class="flex items-center justify-between w-full p-3 font-medium text-left border @if($loop->last) border-b @else border-b-0 @endif border-gray-100 rounded-t accordion-header group hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 dark:border-zinc-600 @if($loop->first) active @endif">
                                        <span class="text-15">{{ $section }}</span>
                                        <i class="mdi mdi-plus text-xl group-[.active]:hidden block"></i>
                                        <i class="mdi mdi-minus text-xl group-[.active]:block hidden"></i>
                                    </button>
                                </h2>

                                <div class="accordion-body block bg-slate-50">
                                    <div class="p-5 font-light @if($loop->last) border-b border-l border-r @else border-b-0 border @endif border-gray-100 dark:border-zinc-600">
                                        <div class="flex flex-col gap-4">
                                            @foreach($chapter as $item)
                                            <div class="flex items-center justify-between">
                                                <p>{{ explode(". ", $item->title)[1] }}</p>
                                                <p class="tex-right">{{ $item->duration }}m</p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-slate-50 p-4 shadow">
                        <h3 class="text-center mb-2">Rp250.000</h3>
                        <p class="text-center text-slate-400">Jaminan uang kembali</p>
                        <div class="flex flex-col gap-2 mt-8">
                            <button href="{{ route('register') }}" class="text-center flex items-center justify-center gap-4 !no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white"><i class="bx bx-cart-alt"></i> Beli sekarang</button>
                            <button class="text-center !no-underline prose border-sky-800 text-sky-800 py-3 border px-6 rounded hover:bg-sky-700 hover:text-white">Pratinjau</button>
                        </div>
                        <h6 class="mt-8 mb-4">Detail singkat terkait kursus</h6>
                        <ul class="flex flex-col gap-2">
                            <li><i class="bx bx-time-five"></i> Video akses selamanya</li>
                            <li><i class="bx bx-laptop"></i> Akses di semua perangkat</li>
                            <li><i class="bx bx-hourglass"></i> Total durasi kursus {{ $course->total_duration }}</li>
                            <li><i class="bx bx-book"></i> Total konten kursus {{ $course->chapters->count() }} konten</li>
                            @if($course->is_certified)
                            <li><i class="bx bx-file"></i> Sertifikat kursus</li>
                            @endif
                        </ul>
                        <div class="bg-slate-200 h-[1px] my-4"></div>
                        <div class="text-center">
                            <a href="#" class="text-sky-700  font-medium">Bagikan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

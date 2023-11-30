<div>
    <div class="md:px-16 pb-16">
        <div class="px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:gap-8">
                <div class="md:col-span-2">
                    <div class="prose pt-16">
                        <h2>Deskripsi</h2>
                        <p>{!! $course->description !!}</p>
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
                                    <div
                                        class="p-5 font-light @if($loop->last) border-b border-l border-r @else border-b-0 border @endif border-gray-100 dark:border-zinc-600">
                                        <div class="flex flex-col gap-4">
                                            @foreach($chapter as $item)
                                            <div class="flex items-center justify-between">
                                                <p class="prose">{{ trim(explode(".", $item->title)[1]) }}</p>
                                                <div
                                                    class="flex gap-4 @if($item->is_preview) justify-between @else justify-end @endif min-w-[125px]">
                                                    @if($item->is_preview)
                                                    <button wire:click="showPreview('{{ $item->id }}')"
                                                        class="prose !no-underline text-blue-600 font-medium">Pratinjau</button>
                                                    @endif
                                                    <p class="text-right prose font-medium">{{ $item->duration }}m</p>
                                                </div>
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
                    <div class="block md:hidden">
                        <img src="{{ \Storage::url($course->thumbnail) }}" class="rounded-t" alt="{{ $course->title }}">
                    </div>
                    <div class="bg-slate-50 p-4 shadow prose">
                        <h2 class="text-center mb-2">{{ $course->price == 0 ? 'Gratis akses' : 'Rp' . number_format($course->price) }}</h2>
                        <p class="text-center text-slate-400">Jaminan uang kembali</p>
                        <div class="flex flex-col gap-2 mt-8">
                            <a href="{{ route('checkout', $course->slug) }}"
                                class="text-center flex items-center justify-center gap-4 !no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white"><i
                                    class="bx bx-cart-alt"></i> Beli sekarang</a>
                            @if(count($previews) > 0)
                            <button wire:click="showPreview('{{ $previews[0]->id }}')" class="text-center !no-underline prose border-sky-800 text-sky-800 py-3 border px-6 rounded hover:bg-sky-700 hover:text-white">Pratinjau</button>
                            @endif
                        </div>
                        <h3 class="mt-8 mb-4">Detail singkat terkait kursus</h3>
                        <div class="flex flex-col gap-2 list-none text-slate-500">
                            <p class="mb-0 mt-0"><i class="bx bx-time-five"></i> Video akses selamanya</p>
                            <p class="mb-0 mt-0"><i class="bx bx-laptop"></i> Akses di semua perangkat</p>
                            <p class="mb-0 mt-0"><i class="bx bx-hourglass"></i> Total durasi kursus {{ $course->total_duration }}</p>
                            <p class="mb-0 mt-0"><i class="bx bx-book"></i> Total konten kursus {{ $course->chapters->count() }} konten</p>
                            @if($course->is_certified)
                            <p class="mb-0 mt-0"><i class="bx bx-file"></i> Sertifikat kursus</p>
                            @endif
                        </div>
                        <div class="bg-slate-200 h-[1px] my-4"></div>
                        <div class="text-center">
                            <a href="#" class="text-sky-700 font-medium no-underline">Bagikan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($previews as $preview)
    <x-modal :name="$preview->id" wire:key="{{ $preview->id }}">
        <div class="bg-slate-50">
            <div class="p-4">
                <div class="prose mb-4">
                    <p class="mb-0 font-medium">Pratinjau kursus</p>
                    <p class="text-lg mt-0">{{ trim(explode(".", $preview->title)[1]) }}</p>
                </div>
                <livewire:plugin.plyr-livewire id="player-{{ $loop->iteration }}" :embedId="$preview->playback_url"
                    :autoplay="false" wire:key="{{ $preview->id }}"></livewire:plugin.plyr-livewire>
            </div>
        </div>
    </x-modal>
    @endforeach
</div>

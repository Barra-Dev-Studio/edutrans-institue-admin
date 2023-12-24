<div>
    <div class="md:px-16 pb-16">
        <div class="px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:gap-8">
                <div class="md:col-span-2">
                    <div class="pt-10">
                        <div class="!text-lg !text-slate-600 text-justify">{!! $course->description !!}</div>
                        @if($course->notes && $course->notes === '-')
                            <div class="bg-amber-50 border border-slate-300 mt-4 p-4 rounded">
                                <div class="!text-lg !text-slate-600 text-justify">{{ $course->notes ?? 'Tidak ada catatan untuk kursus ini' }}</div>
                            </div>
                        @endif
                        <div>
                            @forelse($sections as $section)
                                <h1 class="text-slate-700 mt-16 mb-4">{{ $section->title }}</h1>
                                <img class="inline-block w-full rounded" src="{{ \Storage::url($section->photo) }}" alt="{{ $section->title }}">
                                <div class="!text-lg !text-slate-600 text-justify mt-8">{!! $section->content !!}</div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="mt-8">
                        <h1 class="text-slate-700">Konten kursus</h1>
                        <div class="mt-4">
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
                                                    <p class="prose">{{ (preg_match('/^\d+\.\s(.+)$/', $item->title, $matches)) ? $matches[1] : 'Chapter' }}</p>
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
                        <h1 class="text-slate-700 mt-16 mb-4">Meet your instructor</h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="order-last md:order-first">
                                <div class="!text-lg !text-slate-600 text-justify">{!! $course->mentor->bio !!}</div>
                            </div>
                            <div>
                                <div class="sticky top-8">
                                    <img class="inline-block object-cover rounded" src="{{ \Storage::url($course->mentor->photo) }}" alt="{{ $course->mentor->name }}">
                                    <h2 class="mt-4 text-slate-600">{{ $course->mentor->name }}</h2>
                                    <p class="text-slate-400 text-lg">{{ $course->mentor->speciality }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(count($ratings) > 0)
                    <div class="mt-8">
                        <h1 class="text-slate-700">Bagaimana kata sebagian dari mereka?</h1>
                        <div class="columns-1 md:columns-3 gap-6 space-y-6 mt-4">
                            @forelse($ratings as $rating)
                                <div class="break-inside-avoid-column">
                                    <div class="aspect-video p-4 rounded bg-white shadow">
                                        <div class="mb-4">
                                            <h6>{{ $rating->name  }}</h6>
                                            <div class="flex items-center mt-1">
                                                @foreach(range(1, 5) as $star)
                                                    @if($star <= $rating->rate)
                                                        <i class="bx bxs-star text-amber-500"></i>
                                                    @elseif($star <= $rating->rate + 0.5)
                                                        <i class="bx bxs-star-half text-amber-500"></i>
                                                    @else
                                                        <i class="bx bx-star text-amber-500"></i>
                                                    @endif
                                                @endforeach
                                                <span class="ml-2">{{ $rating->rate }}</span>
                                            </div>
                                        </div>
                                        <p class="text-slate-600 italic text-16">{{ $rating->content }}</p>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    @endif
                </div>
                <div>
                    <div class="block md:hidden">
                        <img src="{{ \Storage::url($course->thumbnail) }}" class="rounded-t" alt="{{ $course->title }}">
                    </div>
                    <div class="bg-slate-50 p-4 shadow prose sticky top-8">
                        <div class="flex items-center justify-between">
                            <div>
                                @if($course->discount_price > 0)
                                    <h6 class="line-through text-red-700">Rp{{ number_format($course->price) }}</h6>
                                    <h5 class="mb-0">Rp{{ number_format($course->discount_price) }}</h5>
                                @else
                                    <h5 class="mb-0">{{ $course->price == 0 ? 'Gratis!' : 'Rp' . number_format($course->price) }}</h5>
                                @endif
                            </div>
                            <div>
                                @if($course->discount_price > 0)
                                    <span class="px-4 py-2 rounded-full text-white bg-red-700 animate-pulse">Promo diskon</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center cursor-pointer" data-tooltip-target="rating-information">
                                <span class="mr-1">({{ $course->average_rating }})</span>
                                @foreach(range(1, 5) as $star)
                                    @if($star <= $course->average_rating)
                                        <i class="bx bxs-star text-xl text-amber-500"></i>
                                    @elseif($star <= $course->average_rating + 0.5)
                                        <i class="bx bxs-star-half text-xl text-amber-500"></i>
                                    @else
                                        <i class="bx bx-star text-xl text-amber-500"></i>
                                    @endif
                                @endforeach
                                <span class="ml-1">({{ $course->total_ratings }})</span>
                            </div>
                            <div id="rating-information" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Total rating {{ $course->average_rating }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="flex items-center cursor-pointer" data-tooltip-target="total-students-information">
                                <i class="dripicons-graduation text-xl text-blue-500 mb-0"></i>
                                <span class="ml-1 mb-1">({{ $course->total_students }})</span>
                            </div>
                            <div id="total-students-information" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Total siswa {{ $course->total_students }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 mt-4">
                            <a href="{{ route('checkout', $course->slug) }}"
                                class="text-center flex items-center justify-center gap-4 !no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white"><i
                                    class="bx bx-cart-alt"></i> Beli sekarang</a>
                            @if(count($previews) > 0)
                            <button wire:click="showPreview('{{ $previews[0]->id }}')" class="text-center !no-underline prose border-sky-800 text-sky-800 py-3 border px-6 rounded hover:bg-sky-700 hover:text-white">Pratinjau</button>
                            @endif
                        </div>
                        <h3 class="mt-8 mb-4">Detail singkat terkait kursus</h3>
                        <div class="flex flex-col gap-2 list-none text-slate-500">
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i class="bx bx-time-five"></i> Video akses selamanya</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i class="bx bx-laptop"></i> Akses di semua perangkat</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i class="bx bx-hourglass"></i> Total durasi kursus {{ floor($course->total_duration/60) }}:{{ $course->total_duration%60 }}</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i class="bx bx-book"></i> Total konten kursus {{ $course->chapters->count() }} konten</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i class="bx bx-money-withdraw"></i> Jaminan uang kembali</p>
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

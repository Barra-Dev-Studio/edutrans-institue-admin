<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full h-[400px] md:h-screen overflow-auto">
        @forelse($sections as $section => $chapters)
        <div class="card-body pb-4 border-b w-full @if(!$loop->first) border-t @endif border-slate-200">
            <h5 class="dark:text-zinc-100">{{ $section }}</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <ul class="">
                    @foreach($chapters as $chapter)
                    <li wire:key="{{ $chapter->id }}" class="text-slate-700  prose font-medium py-2 @if(!$loop->last) border-b border-slate-100 @endif @if($activeChapter === $chapter->id) border-l border-sky-500 bg-slate-100 @else hover:bg-slate-200 @endif border-slate-200 cursor-pointer"
                        wire:click="setActiveChapter('{{ $chapter->id }}')">{{ explode('. ', $chapter->title)[1] }} <i class="bx bx-badge-check text-emerald-600"></i></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @empty
        <div class="card-body">
            <p class="text-slate-600">This course does not have chapters</p>
        </div>
        @endforelse
    </div>
    <div class="md:col-span-3 order-first md:order-last">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full">
            <div class="card-body pb-4 border-b border-slate-200 flex justify-between items-center">
                <h5 class="dark:text-zinc-100">{{ $selectedChapter ? explode('. ', $selectedChapter->title)[1] : $course->title }}</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <div wire:ignore id="mediaPlayer" class="rounded w-full"></div>
                    </div>
                    @if($selectedChapter)
                    <div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-8">
                        <div class="prose !w-full">
                            <h4>Description</h4>
                            <p class="text-slate-500 !text-justify">{{ $selectedChapter->description }}</p>
                        </div>
                        <div>
                            <h4 class="mb-4">Information</h4>
                            <div class="flex gap-4">
                                <button class="bg-emerald-500 px-6 py-3 rounded text-white hover:bg-emerald-600 prose !no-underline">Tandai selesai</button>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="w-full h-[600px] overflow-hidden">
                        <img src="{{ \Storage::url($course->thumbnail) }}" class="w-full" alt="">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
                @this.on('player-updated', (event) => {
                    const player = new Playerjs({ id: "mediaPlayer", file: event.playback_url });
                });
            }, { passive: true });
    </script>
    @endpush
</div>

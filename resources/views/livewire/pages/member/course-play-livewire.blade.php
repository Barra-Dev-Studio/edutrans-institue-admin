<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full h-[400px] md:h-screen overflow-auto">
        @forelse($sections as $section => $chapters)
        <div class="card-body pb-4 border-b w-full @if(!$loop->first) border-t @endif border-slate-200">
            <h5 class="dark:text-zinc-100">{{ $section }}</h5>
        </div>
        <div class="">
            <div class="w-full">
                <div class="flex flex-col">
                    @foreach($chapters as $chapter)
                        <div class="@if($this->checkIfCompleted($chapter->id)) border-l-2 border-emerald-500 bg-emerald-50 @elseif($selectedChapter->id === $chapter->id) border-l-2 border-sky-500 bg-slate-100 @else hover:bg-slate-200 @endif">
                            <a href="{{ route('member.play', [$course->id, $chapter->id]) }}"
                            class="min-h-[75px] px-5 text-slate-700  prose font-medium py-2 @if(!$loop->last) border-b border-slate-100 @endif border-slate-200 cursor-pointer flex justify-between items-center gap-4">
                                <span>{{ (preg_match('/^\d+\.\s(.+)$/', $chapter->title, $matches)) ? $matches[1] : 'Chapter' }}</span>
                                @if($this->checkIfCompleted($chapter->id)) <i class="bx bx-check-circle text-emerald-600"></i> @endif
                            </a>
                        </div>
                    @endforeach
                </div>
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
                <h5 class="dark:text-zinc-100">{{ trim(explode('.', $selectedChapter->title)[1]) }}</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <livewire:plugin.plyr-livewire wire:ignore :embedId="$selectedChapter->playback_url" :course-id="$selectedChapter->course_id"></livewire:plugin.plyr-livewire>
                    <div class="grid grid-cols-1 mt-8 gap-4">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4>Deskripsi</h4>
                                <p class="mt-4 text-slate-500 text-16">{{ $selectedChapter->description }}</p>
                            </div>
                        </div>
                        @if(!$this->checkIfCompleted($selectedChapter->id))
                        <div>
                            <div class="flex gap-4 justify-end">
                                <button wire:loading.attr="disabled" wire:click="setAsComplete" class="bg-emerald-500 hover:bg-emerald-600 px-6 py-3 text-white rounded"
                                    type="submit"><span wire:target="setAsComplete">Tandai selesai</span><span wire:loading
                                        wire:target="setAsComplete"><x-spinner></x-spinner></span></button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

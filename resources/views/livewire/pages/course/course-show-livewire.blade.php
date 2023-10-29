<div class="grid grid-cols-3 gap-4">
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Create course</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <ul class="mb-4">
                    <li class="font-medium p-4 @if($activeTab === 'information') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-200 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('information')">Course infromation</li>
                    <li class="font-medium p-4 @if($activeTab === 'chapters') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-200 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('chapters')">Chapters</li>
                    <li class="font-medium p-4 @if($activeTab === 'managechapter') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-200 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('managechapter')">{{ $state == 'create' ? 'Add new' : 'Update' }} chapters</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-span-2">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full @if($activeTab != 'information') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200 flex justify-between items-center">
                <h5 class="dark:text-zinc-100">Course information</h5>
            </div>
            <div class="card-body">
                <div class="w-full prose">
                    <h3 class="mb-1 text-slate-700">{{ $course->title }}</h3>
                    <p class="text-slate-600">{{ $course->description }}</p>
                    <div class="flex gap-6 items-center">
                        <div>
                            <img class="block h-14 w-14 rounded-full ring-2 ring-white dark:ring-zinc-500"
                                src="{{ \Storage::url($course->mentor->photo ?? '') }}" alt="{{ $course->mentor->name }}">
                        </div>
                        <div class="prose">
                            <h4 class="mb-0 text-slate-700">{{ $course->mentor->name ?? "-" }}</h4>
                            <p class="text-sm text-slate-500">{{ $course->mentor->speciality ?? "-" }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full @if($activeTab != 'chapters') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200 flex justify-between items-center">
                <h5 class="dark:text-zinc-100">Course chapters</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div class="flex flex-col gap-4">
                        @forelse($sections as $section => $chapters)
                        <div>
                            <h6 class="bg-slate-200 rounded-tl rounded-tr p-4">{{ $section }}</h6>
                            <div class="bg-slate-100 rounded-bl rounded-br p-4">
                                <ul>
                                    @foreach($chapters as $chapter)
                                    <li class="border-b border-slate-200 py-4 flex justify-between items-center">
                                        <div>
                                            <p>{{ $chapter->title }}</p>
                                        </div>
                                        <div class="flex">
                                            <button wire:click="updateChapter('{{ $chapter->id }}')"
                                                class="p-2 flex items-center bg-amber-400 hover:bg-amber-500 rounded-tl rounded-bl text-lg">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                            <button wire:click="showModal('dashboard.chapter.destroy', '{{ $chapter->id }}')"
                                                class="p-2 flex items-center bg-rose-600 hover:bg-rose-700 rounded-tr rounded-br text-white text-lg">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @empty
                        <p>You don't have any active chapter. Add them.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full @if($activeTab != 'managechapter') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200 flex justify-between items-center">
                <h5 class="dark:text-zinc-100">{{ $state == 'create' ? 'Add' : 'Update' }} chapters</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <form wire:submit.prevent="submit">
                        <div>
                            <x-input-label for="title" :value="__('Chapter title')" />
                            <x-text-input wire:model.live="title" id="title" class="block mt-1 w-full" type="text" name="title"
                                placeholder="Chapter title" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="section" :value="__('Chapter section')" />
                            <x-text-input wire:model.live="section" id="section" class="block mt-1 w-full" type="text" name="section"
                                placeholder="Chapter section" required />
                            <x-input-error :messages="$errors->get('section')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Chapter description')" />
                            <x-textarea-input wire:model.live="description" id="description" class="block mt-1 w-full" type="text"
                                name="description" placeholder="Chapter description" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="playbackUrl" :value="__('Chapter URL')" />
                            <x-text-input wire:model.live="playbackUrl" id="playbackUrl" class="block mt-1 w-full" type="text"
                                name="playbackUrl" placeholder="Chapter URL" required />
                            <x-input-error :messages="$errors->get('playbackUrl')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="duration" :value="__('Duration')" />
                            <x-text-input wire:model.live="duration" id="duration" class="block mt-1 w-full" type="number"
                                name="duration" placeholder="Duration" required />
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="playbackUrl" :value="__('Make a preview')" />
                            <div class="grid grid-cols-2 items-center gap-4">
                                <div class="w-full @if($isPreview) bg-emerald-100 @else bg-slate-100 @endif p-4 cursor-pointer border-slate-200 border rounded" wire:click="setIsPreview(true)">
                                    <h5 class="text-slate-700">Yes, make it preview</h5>
                                    <p class="text-slate-500">User can play this video as a preview</p>
                                </div>
                                <div class="w-full @if(!$isPreview) bg-emerald-100 @else bg-slate-100 @endif p-4 cursor-pointer border-slate-200 border rounded" wire:click="setIsPreview(false)">
                                    <h5 class="text-slate-700">No, don't make it preview</h5>
                                    <p class="text-slate-500">User can't play this video as a preview</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="bg-emerald-500 px-6 py-3 rounded text-white hover:bg-emerald-600" type="submit">{{ $state == 'create' ? 'Add' : 'Save' }}
                                chapter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-datatable.modal :isModalShow="$isModalShow" :deleteRoute="$deleteRoute"></x-datatable.modal>
</div>

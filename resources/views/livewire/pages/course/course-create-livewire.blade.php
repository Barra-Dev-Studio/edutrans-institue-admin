<div class="grid grid-cols-3 gap-4">
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full">
        <div class="card-body pb-4 border-b border-slate-200">
            <h5 class="dark:text-zinc-100">Create course</h5>
        </div>
        <div class="card-body">
            <div class="w-full">
                <ul class="mb-4">
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'thumbnail') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('thumbnail')">Thumbnail</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'title') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('title')">Title and Slug</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'description') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('description')">Description and Notes</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'category') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('category')">Category</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'price') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('price')">Price</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'mentor') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('mentor')">Mentor</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'statistics') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('statistics')">Statistics</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'certificate') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('certificate')">Certificate</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'status') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('status')">Status</li>
                    <li class="text-slate-700 prose font-medium p-4 @if($activeTab === 'review') border-l border-sky-500 bg-slate-100 @else hover:bg-slate-100 @endif border-slate-200 cursor-pointer" wire:click="setActiveTab('review')">Review</li>
                </ul>
                <button class="bg-emerald-500 px-6 py-3 rounded text-white hover:bg-emerald-600 block w-full" form="create-course-form" type="submit">Save course</button>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="submit" class="col-span-2" id="create-course-form">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'thumbnail') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Thumbnail</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    @if($thumbnail)
                    <div class="mb-4">
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="">
                    </div>
                    @endif
                    <div>
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input wire:model.live="thumbnail" id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail"
                            placeholder="Photo" required />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'title') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Title and slug</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input wire:model.live="title" id="title" class="block mt-1 w-full" type="text" name="title"
                            placeholder="Title" required wire:keyup="updateSlug" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input wire:model.live="slug" id="slug" class="block mt-1 w-full" type="text" name="slug"
                            placeholder="Slug" required />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'description') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Description and notes</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <livewire:plugin.trix-livewire :value="$description"></livewire:plugin.trix-livewire>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-textarea-input wire:model.live="notes" id="notes" class="block mt-1 w-full" name="notes"
                            placeholder="Notes" required />
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'category') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Category</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <x-select-input :options="$categories" :value="'id'" :label="'name'" name="category" wire:model.live="category" wire:change="setSelectedCategory"></x-select-input>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                    @if($selectedCategory != null)
                    <div class="mt-4 prose">
                        <h4 class="mb-0 text-slate-700">{{ $selectedCategory->name }}</h4>
                        <p class="text-sm text-slate-500">{{ $selectedCategory->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'price') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Price</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input wire:model.live="price" id="price" class="block mt-1 w-full" type="number" name="price"
                            placeholder="Price" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'mentor') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Mentor</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <x-input-label for="mentor" :value="__('Mentor')" />
                        <x-select-input :options="$mentors" :value="'id'" :label="'name'" name="mentor" wire:model.live="mentor"
                            wire:change="setSelectedMentor"></x-select-input>
                        <x-input-error :messages="$errors->get('mentor')" class="mt-2" />
                    </div>
                    @if($selectedMentor != null)
                    <div class="flex gap-6 items-center mt-6">
                        <div>
                            <img class="block h-20 w-20 rounded-full ring-2 ring-white dark:ring-zinc-500" src="{{ \Storage::url($selectedMentor->photo) }}" alt="{{ $selectedMentor->name }}">
                        </div>
                        <div class="prose">
                            <h4 class="mb-0 text-slate-700">{{ $selectedMentor->name }}</h4>
                            <p class="text-sm text-slate-500">{{ $selectedMentor->speciality }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'statistics') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Statistics</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div>
                        <x-input-label for="totalViews" :value="__('Total views')" />
                        <x-text-input wire:model.live="totalViews" id="totalViews" class="block mt-1 w-full" type="number" name="totalViews"
                            placeholder="Total views" required />
                        <x-input-error :messages="$errors->get('totalViews')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="totalShares" :value="__('Total shares')" />
                        <x-text-input wire:model.live="totalShares" id="totalShares" class="block mt-1 w-full" type="number" name="totalShares"
                            placeholder="Total shares" required />
                        <x-input-error :messages="$errors->get('totalShares')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="totalStudents" :value="__('Total students')" />
                        <x-text-input wire:model.live="totalStudents" id="totalStudents" class="block mt-1 w-full" type="number"
                            name="totalStudents" placeholder="Total students" required />
                        <x-input-error :messages="$errors->get('totalStudents')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="totalDurations" :value="__('Total duration')" />
                        <x-text-input wire:model.live="totalDuration" id="totalDuration" class="block mt-1 w-full" type="number"
                            name="totalDuration" placeholder="Total duration" required />
                        <x-input-error :messages="$errors->get('totalDurations')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'certificate') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Certificate</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="@if(!$isCertified) bg-emerald-100 @else bg-slate-100 @endif p-4 border border-slate-300 cursor-pointer" wire:click="setCertified(false)">
                            <h5 class="text-slate-700">No Certificate @if(!$isCertified) <span><i class="bx bx-badge-check"></i></span>@endif</h5>
                            <p class="text-slate-500">Student will not get the certificate after finished the course</p>
                        </div>
                        <div class="@if($isCertified) bg-emerald-100 @else bg-slate-100 @endif p-4 border border-slate-300 cursor-pointer" wire:click="setCertified(true)">
                            <h5 class="text-slate-700">With Certificate @if($isCertified) <span><i class="bx bx-badge-check"></i></span>@endif</h5>
                            <p class="text-slate-500">Student will get the certificate after finished the course</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'status') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Status</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="@if($status === 'DRAFT') bg-emerald-100 @else bg-slate-100 @endif p-4 border border-slate-300 cursor-pointer"
                            wire:click="setStatus('DRAFT')">
                            <h5 class="text-slate-700">Draft @if($status === 'DRAFT') <span><i class="bx bx-badge-check"></i></span>@endif</h5>
                            <p class="text-slate-500">The course is hidden from public</p>
                        </div>
                        <div class="@if($status === 'PUBLISHED') bg-emerald-100 @else bg-slate-100 @endif p-4 border border-slate-300 cursor-pointer"
                            wire:click="setStatus('PUBLISHED')">
                            <h5 class="text-slate-700">Publish @if($status === 'PUBLISHED') <span><i class="bx bx-badge-check"></i></span>@endif</h5>
                            <p class="text-slate-500">The course will be published and visible from public</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 w-full  @if($activeTab !== 'review') hidden @endif">
            <div class="card-body pb-4 border-b border-slate-200">
                <h5 class="dark:text-zinc-100">Review</h5>
            </div>
            <div class="card-body">
                <div class="w-full">
                    @if($thumbnail)
                    <div>
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="">
                    </div>
                    @endif
                    <div class="table-rep-plugin mt-8">
                        <div class="table-wrapper overflow-auto">
                            <div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns">
                                <table class="table table-striped w-full text-left border border-gray-50 dark:border-zinc-600">
                                    <tbody>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Title</td>
                                            <td class="p-3">{{ $title }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Slug</td>
                                            <td class="p-3">{{ $slug }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Description</td>
                                            <td class="p-3">{!! $description !!}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Notes</td>
                                            <td class="p-3">{{ $notes }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Category</td>
                                            <td class="p-3">{{ $selectedCategory != null ? $selectedCategory->name : "" }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Price</td>
                                            <td class="p-3">IDR{{ $price }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Mentor</td>
                                            <td class="p-3">{{ $selectedMentor != null ? $selectedMentor->name : "" }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Total views</td>
                                            <td class="p-3">{{ $totalViews }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Total shares</td>
                                            <td class="p-3">{{ $totalShares }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Total students</td>
                                            <td class="p-3">{{ $totalStudents }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Total duration</td>
                                            <td class="p-3">{{ $totalDuration }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Certificate</td>
                                            <td class="p-3">{{ $isCertified ? "Yes with certificate" : "No certificate" }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white">
                                            <td class="p-3">Status will be</td>
                                            <td class="p-3">{{ \Str::ucfirst($status) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

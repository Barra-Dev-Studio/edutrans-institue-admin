<div>
    <div class="grid grid-cols-1 md:grid-cols-12 mb-5 md:space-x-8 gap-4 md:gap-0">
        <div class="md:col-span-6 prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Filter </label>
            <div class="grid grid-cols-3 gap-4 items-center">
                <div>
                    <select wire:model.live="showPage"
                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <option>Category</option>
                    </select>
                </div>
                <div>
                    <select wire:model.live="showPage"
                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <option>Instructur</option>
                    </select>
                </div>
                <div>
                    <button class="block bg-emerald-500 w-full py-[7px] rounded text-white hover:bg-emerald-600">Filter</button>
                </div>
            </div>
        </div>
        <div class="md:col-span-6 prose">
            <x-input-label for="search" :value="__('Search')" />
            <x-text-input wire:model.live="search" id="search" class="block mt-1 w-full" type="text" name="search" placeholder="Search your course" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @forelse($courses as $course)
        <div>
            <x-course-card
                img="{{ \Storage::url($course->thumbnail) }}"
                mentor="{{ $course->mentor->name }}" title="{{ $course->title }}"
                description="{{ $course->description }}"
                price="{{ $course->price }}"></x-course-card>
        </div>
        @empty
        <div>
            <p class="prose">Belum ada kursus. Akses halaman <a href="{{ route('courses') }}">Katalog</a> untuk melihat list kursus yang tersedia</p>
        </div>
        @endforelse
    </div>
    <div class="my-5">
        {{ $courses->onEachSide(1)->links() }}
    </div>
</div>

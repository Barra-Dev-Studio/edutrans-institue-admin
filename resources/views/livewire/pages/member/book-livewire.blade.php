<div>
    <div class="grid grid-cols-1 md:grid-cols-2 mb-5 md:space-x-8 gap-4 md:gap-0 items-start">
        <div class="prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Filter </label>
            <div>
                <div>
                    <select wire:model.live="category"
                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <option value="-1">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Search </label>
            <x-text-input wire:model.live="search" id="search" class="block mt-1 w-full" type="text" name="search"
                placeholder="Search your course" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($books as $book)
        <div>
            <x-own-book-card :book="$book"></x-own-book-card>
        </div>
        @empty
        <div class="col-span-4" wire:key="not-found">
            <p class="prose">Belum ada kursus. Akses halaman <a href="{{ route('courses') }}">Katalog</a> untuk melihat
                list kursus yang tersedia</p>
        </div>
        @endforelse
    </div>
    <div class="my-5">
        {{ $books->onEachSide(1)->links() }}
    </div>
</div>

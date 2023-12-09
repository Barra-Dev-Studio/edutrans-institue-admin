<div class="mb-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-slate-50 rounded p-8 border border-slate-200">
            <h4 class="mb-3">Filter kategori</h4>
            <div class="border-b border-slate-200 h-1"></div>
            <div class="flex flex-col gap-4 mt-4">
                <div class="flex cursor-pointer items-center gap-4" wire:click="selectCategory('all')">
                    <div class="h-4 w-4 @if($selectedCategory == 'all') bg-sky-700 @else bg-slate-300 @endif rounded"></div>
                    <p class="prose hover:text-sky-800">Semua kategori</p>
                </div>
                @forelse($categories as $category)
                <div class="flex cursor-pointer items-center gap-4" wire:key="{{ $category->id }}" wire:click="selectCategory('{{ $category->id }}')">
                    <div class="h-4 w-4 @if($selectedCategory == $category->id) bg-sky-700 @else bg-slate-300 @endif rounded"></div>
                    <p class="prose hover:text-sky-800">{{ $category->name }}</p>
                </div>
                @empty
                @endforelse
            </div>
            <h4 class="mb-3 mt-8">Urutkan</h4>
            <div class="border-b border-slate-200 h-1"></div>
            <div class="flex flex-col gap-4 mt-4">
                <div class="flex cursor-pointer items-center gap-4" wire:click="selectSort('terbaru')">
                    <div class="h-4 w-4 @if($selectedSort == 'terbaru') bg-sky-700 @else bg-slate-300 @endif rounded"></div>
                    <p class="prose hover:text-sky-800">Terbaru</p>
                </div>
                <div class="flex cursor-pointer items-center gap-4" wire:click="selectSort('promo')">
                    <div class="h-4 w-4 @if($selectedSort == 'promo') bg-sky-700 @else bg-slate-300 @endif rounded"></div>
                    <p class="prose hover:text-sky-800">Sedang promo</p>
                </div>
                <div class="flex cursor-pointer items-center gap-4" wire:click="selectSort('terpopuler')">
                    <div class="h-4 w-4 @if($selectedSort == 'terpopuler') bg-sky-700 @else bg-slate-300 @endif rounded"></div>
                    <p class="prose hover:text-sky-800">Terpopuler</p>
                </div>
            </div>
        </div>
        <div class="md:col-span-3">
            <div class="grid grid-cols-1 items-center gap-4">
                <x-text-input wire:model.live="query" id="query" class="block w-full h-16 text-lg px-4" type="query" name="query" required placeholder="Cari berdasarkan judul atau nama Instruktur" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 mt-4 gap-4">
                @forelse($courses as $course)
                <a href="{{ route('course.detail', $course->slug) }}" class="h-full">
                    <x-course-card
                    :course="$course"></x-course-card>
                </a>
                @empty
                <div class="h-full col-span-3">
                    <p class="text-slate-500">Kursus tidak ditemukan, silakan gunakan kata kunci atau filter yang lain</p>
                </div>
                @endforelse
            </div>
            <div class="my-5">
                {{ $courses->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>

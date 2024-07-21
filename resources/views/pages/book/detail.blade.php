<x-guest-layout>
    <div class="bg-sky-900 py-6 md:px-16">
        <div class="px-6 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 items-end gap-8">
                <div class="col-span-2 md:pb-12">
                    <p class="text-slate-300 mb-4 prose">Kategori {{ $book->category->name }}</p>
                    <h1 class="text-white text-5xl leading-snug">{{ $book->title }}</h1>
                    <div class="flex items-center gap-4 mt-4">
                        <div class="h-10 w-10 rounded-full ring-2 ring-white overflow-hidden">
                            <img class="inline-block object-cover h-full w-full" src="{{ \Storage::url($book->author->photo) }}"
                                alt="{{ $book->author->name }}">
                        </div>
                        <div>
                            <h5 class="text-white">{{ $book->author->name }}</h5>
                            <p class="text-slate-300">{{ $book->author->speciality }}</p>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex md:justify-center">
                    <div class="h-[250px] w-[170px] overflow-hidden shadow">
                        <img src="{{ \Storage::url($book->cover) }}" class="object-cover rounded h-full w-full" alt="{{ $book->title }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:pages.book.book-detail-livewire :$book></livewire:pages.book.book-detail-livewire>
</x-guest-layout>

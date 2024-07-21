@props(['book'])
<div class="card bg-slate-50 cursor-pointer h-full flex flex-col justify-between">
    <div class="relative">
        @if($book->discount_price > 0)
        <div class="absolute left-0 top-0 h-16 w-16">
            <div class="ribbon-discount">
                Promo diskon
            </div>
        </div>
        @endif
        <div class="h-[338px] overflow-hidden">
            <img class="rounded-tl rounded-tr h-full w-full object-cover" src="{{ \Storage::url($book->cover) }}" alt="{{ $book->title }}">
        </div>
        <div class="card-body !pt-0 flex flex-col justify-between">
            <div>
                <div class="mt-4">
                    <h5 class="mb-2 line-clamp-2">{{ $book->title }}</h5>
                    <div class="flex items-center gap-2">
                        <div class="inline-block h-8 w-8 rounded ring-2 ring-white overflow-hidden">
                            <img class="object-cover h-full w-full" src="{{ \Storage::url($book->author->photo) }}"
                                alt="{{ $book->author->name }}">
                        </div>
                        <div>
                            <p class="font-bold mb-0 line-clamp-1">{{ $book->author->name }}</p>
                            <p class="text-slate-500 line-clamp-1">{{ $book->author->speciality }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex justify-between items-center">
                    @if($book->discount_price > 0)
                        <h6 class="line-through text-red-700">Rp{{ number_format($book->price) }}</h6>
                        <h4 class="mb-0">Rp{{ number_format($book->discount_price) }}</h4>
                    @else
                        <h5 class="mb-0">{{ $book->price == 0 ? 'Gratis!' : 'Rp' . number_format($book->price) }}</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

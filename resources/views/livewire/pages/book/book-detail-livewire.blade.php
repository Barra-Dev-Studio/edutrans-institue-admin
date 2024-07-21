<div>
    <div class="md:px-16 pb-16">
        <div class="px-6 md:px-8 relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:gap-8">
                <div class="md:col-span-2">
                    <div class="pt-10">
                        <div class="!text-lg !text-slate-600 text-justify">{!! $book->description !!}</div>
                    </div>
                </div>
                <div>
                    <div class="flex md:hidden justify-center mb-4">
                        <div class="w-[230px] h-[345px] overflow-hidden">
                            <img src="{{ \Storage::url($book->cover) }}" class="rounded object-cover" alt="{{ $book->title }}">
                        </div>
                    </div>
                    <div class="bg-slate-50 p-4 shadow prose sticky top-8">
                        <div class="flex items-center justify-between">
                            <div>
                                @if($book->discount_price > 0)
                                <h4 class="mb-0 mt-0">Rp{{ number_format($book->discount_price) }}</h4>
                                <h5 class="line-through text-red-700">Rp{{ number_format($book->price) }}</h5>
                                @else
                                <h5 class="mb-0">{{ $book->price == 0 ? 'Gratis!' : 'Rp' .
                                    number_format($book->price) }}</h5>
                                @endif
                            </div>
                            <div>
                                @if($book->discount_price > 0)
                                <span class="px-4 py-2 rounded-full text-white bg-red-700 animate-pulse">Promo
                                    diskon</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 mt-4">
                            <a href="{{ route('checkout', $book->slug) }}"
                                class="text-center flex items-center justify-center gap-4 !no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white"><i
                                    class="bx bx-cart-alt"></i> Beli sekarang</a>
                        </div>
                        <h3 class="mt-8 mb-4">Detail singkat terkait ebook</h3>
                        <div class="flex flex-col gap-2 list-none text-slate-500">
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i
                                    class="bx bx-time-five"></i> Ebook akses selamanya</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i
                                    class="bx bx-laptop"></i> Akses di semua perangkat</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i
                                    class="bx bx-book"></i> Total halaman {{ $book->total_pages }} halaman</p>
                            <p class="mb-0 mt-0 flex items-center gap-2 cursor-pointer hover:text-black"><i
                                    class="bx bx-money-withdraw"></i> Jaminan uang kembali</p>
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
</div>

<div class="md:px-16 py-10">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <div class="px-6 md:px-8">
        @if(count($books) > 0)
        <div class="flex items-center justify-between mb-8">
            <h3>Baca ebook populer</h3>
            <a href="{{ route('books') }}" class="prose">Lihat semua ebook</a>
        </div>
        @endif
        <div>
            <div class="swiper popular-books">
                <div class="swiper-wrapper">
                    @foreach($books as $book)
                    <div class="swiper-slide h-full">
                        <a href="{{ route('book.detail', $book->slug) }}" class="h-full">
                            <x-book-card :book="$book"></x-book-card>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiperbook = new Swiper(".popular-books", {
            loop: true,
            slidesPerView: 1,
            centeredSlides: false,
            slidesPerGroupSkip: 1,
            grabCursor: true,
            autoplay: true,
            autoHeight: true,
            spaceBetween: 20,
            keyboard: {
                enabled: true,
            },
            breakpoints: {
                769: {
                    slidesPerView: 5,
                    slidesPerGroup: 1,
                },
            },
        });
    </script>
</div>

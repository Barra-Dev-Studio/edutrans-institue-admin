<div class="md:px-16 py-10">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <div class="px-6 md:px-8">
        <div class="flex items-center justify-between mb-8">
            <h3>Jelajahi kursus populer</h3>
            <a href="{{ route('courses') }}" class="prose">Jelajahi kursus</a>
        </div>
        <div>
            <div class="swiper popular-courses">
                <div class="swiper-wrapper">
                    @foreach($courses as $course)
                        <div class="swiper-slide h-full">
                            <a href="{{ route('course.detail', $course->slug) }}" class="h-full">
                                <x-course-card
                                    :course="$course"></x-course-card>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".popular-courses", {
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
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                },
            },
        });
    </script>
</div>

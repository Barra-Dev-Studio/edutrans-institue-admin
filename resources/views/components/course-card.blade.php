@props(['course'])
<div class="card bg-slate-50 cursor-pointer h-full flex flex-col justify-between">
    <div>
        <div class="h-[170px] overflow-hidden">
            <img class="rounded-tl rounded-tr h-full w-full object-cover" src="{{ \Storage::url($course->thumbnail) }}" alt="{{ $course->title }}">
        </div>
        <div class="card-body !pt-0 flex flex-col justify-between">
            <div>
                <div class="mt-6">
                    <h5 class="mb-4 line-clamp-3">{{ $course->title }}</h5>
                    <div class="flex items-center gap-2">
                        <div class="inline-block h-8 w-8 rounded ring-2 ring-white overflow-hidden">
                            <img class="object-cover h-full w-full" src="{{ \Storage::url($course->mentor->photo) }}" alt="{{ $course->mentor->name }}">
                        </div>
                        <div>
                            <p class="font-bold mb-0 line-clamp-1">{{ $course->mentor->name }}</p>
                            <p class="text-slate-500 line-clamp-1">{{ $course->mentor->speciality }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <div>
                        @if($course->discount_price > 0)
                            <h6 class="line-through text-red-700">Rp{{ number_format($course->price) }}</h6>
                            <h5 class="mb-0">Rp{{ number_format($course->discount_price) }}</h5>
                        @else
                            <h5 class="mb-0">{{ $course->price == 0 ? 'Gratis!' : 'Rp' . number_format($course->price) }}</h5>
                        @endif
                    </div>
                    <div>
                        @if($course->discount_price > 0)
                        <span class="px-4 py-2 rounded-full text-white bg-red-700 animate-pulse">Promo diskon</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 pb-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="bx bxs-star text-xl text-amber-500"></i>
            <i class="bx bxs-star text-xl text-amber-500"></i>
            <i class="bx bxs-star text-xl text-amber-500"></i>
            <i class="bx bxs-star text-xl text-amber-500"></i>
            <i class="bx bxs-star text-xl text-amber-500"></i>
            <span class="ml-1">({{ $course->total_ratings }})</span>
        </div>
        <div class="flex items-center">
            <i class="dripicons-graduation text-xl text-blue-500 mb-0"></i>
            <span class="ml-1 mb-1">({{ $course->total_students }})</span>
        </div>
    </div>
</div>

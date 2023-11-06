@props(['img', 'mentor', 'title', 'description', 'price'])
<div class="card bg-slate-50 cursor-pointer md:h-[435px]">
    <img class="rounded-tl rounded-tr" src="{{ $img }}" alt="">
    <div class="card-body h-[260px] flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start">
                <p class="font-bold line-clamp-2">{{ $mentor }}</p>
                <p class="text-right text-sky-800">Semua level</p>
            </div>
            <div class="mt-6">
                <h4 class="mb-3 line-clamp-2">{{ $title }}</h4>
                <p class="text-slate-500 line-clamp-2">{{ $description }}</p>
            </div>
        </div>
        <div class="mt-6">
            <h3 class="mb-0">Rp{{ number_format($price) }}</h3>
        </div>
    </div>
</div>

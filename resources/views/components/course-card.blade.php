@props(['img', 'mentor', 'title', 'description', 'price'])
<div class="card bg-slate-50 cursor-pointer md:h-min-[435px]">
    <div class="h-[250px] overflow-hidden">
        <img class="rounded-tl rounded-tr" src="{{ $img }}" alt="">
    </div>
    <div class="card-body h-[260px] flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start">
                <p class="font-bold line-clamp-2">{{ $mentor }}</p>
                <p class="text-right text-sky-800">Semua level</p>
            </div>
            <div class="mt-6">
                <h4 class="mb-3 line-clamp-2">{{ $title }}</h4>
                <p class="text-slate-500 line-clamp-2">{{ strip_tags($description) }}</p>
            </div>
        </div>
        <div class="mt-6">
            <h3 class="mb-0">{{ $price == 0 ? 'Gratis akses' : 'Rp' . number_format($price) }}</h3>
        </div>
    </div>
</div>

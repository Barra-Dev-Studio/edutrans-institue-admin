@props(['img', 'mentor', 'title', 'description', 'price'])
<div class="card bg-slate-50 cursor-pointer h-full">
    <div class="h-[170px] overflow-hidden">
        <img class="rounded-tl rounded-tr h-full w-full" src="{{ $img }}" alt="{{ $title }}">
    </div>
    <div class="card-body flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start">
                <p class="font-bold line-clamp-2">{{ $mentor }}</p>
            </div>
            <div class="mt-6">
                <h5 class="mb-3 line-clamp-3">{{ $title }}</h5>
                <p class="text-slate-500 line-clamp-2">{{ strip_tags($description) }}</p>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="mb-0 text-slate-700">{{ $price == 0 ? 'Gratis akses' : 'Rp' . number_format($price) }}</h4>
        </div>
    </div>
</div>

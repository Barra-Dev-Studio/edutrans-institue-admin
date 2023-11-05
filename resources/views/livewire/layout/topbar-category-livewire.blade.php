<div class="border-b border-slate-300/70">
    @if($categories)
    <div class="flex p-4 items-center justify-center gap-8">
        @foreach($categories as $category)
        <a href="" class="my-0 prose no-underline hover:text-black">{{ $category->name }}</a>
        @endforeach
    </div>
    @endif
</div>

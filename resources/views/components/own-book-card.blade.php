@props(['book'])
<div class="card bg-white mb-0">
    <div class="flex items-start gap-4 p-4">
        <div>
            <img src="{{ \Storage::url($book->book->cover) }}" class="w-[170px] rounded" alt="{{ $book->title }}">
        </div>
        <div class="h-full">
            <div class="h-full flex flex-col justify-between gap-4">
                <div class="flex-1">
                    <h4>{{ $book->title }}</h4>
                    <p class="mb-0 text-slate-500 text-sm">{{ $book->author }}</p>
                </div>
                <div class="flex-1">
                    <a href="{{ route('member.book.download', $book->id) }}" class="bg-emerald-500 text-white p-2 rounded hover:bg-emerald-600">Download eBook</a>
                </div>
                <div class="border border-slate-200 rounded p-2">
                    <p>key: {{ $book->key }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

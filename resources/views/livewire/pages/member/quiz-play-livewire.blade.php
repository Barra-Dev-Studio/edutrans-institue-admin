<div class="grid grid-cols-12 gap-4">
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 col-span-8">
        <div class="card-body prose">
            {!! $questions[$index]['question'] !!}
        </div>
        <div class="card-body border-t border-slate-200 flex flex-col gap-4">
            @foreach($questions[$index]['answers'] as $answer)
                <div class="@if($loop->index === $selectedAnswer) bg-emerald-200 hover:bg-emerald-300 @else bg-slate-100 hover:bg-slate-200 @endif p-4 rounded cursor-pointer"
                     wire:click="selectAnswer({{$loop->index}})">
                    <span class="prose">{{ $answer->text }}</span>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card dark:border-zinc-600 dark:bg-zinc-800 bg-slate-50 col-span-4">
        <div class="card-body flex items-center justify-center h-full w-full">
            <div class="text-center">
                <h4 class="mb-4 text-slate-500">Waktu</h4>
                <h1 class="text-8xl @if($timer > 5) text-slate-700 @else text-red-500 @endif" wire:poll.1s="countdown" wire:poll.keep-alive>{{ $timer }}</h1>
            </div>
        </div>
    </div>
</div>

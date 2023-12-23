<div>
    <p class="prose mb-3">Seo score {{ round($results->seo_score, 2) }}%</p>
    <div class="mb-6">
        <div class="progress h-2.5 w-full bg-gray-50 mb-4 rounded-full relative dark:bg-zinc-600">
            <div class="progress-bar h-2.5 rounded-full ltr:rounded-r-none rtl:rounded-l-none
                 @if($results->seo_score < 40)
                    bg-red-500
                 @elseif($results->seo_score >= 40 && $results->seo_score < 70)
                    bg-amber-500
                 @else
                    bg-emerald-500
                 @endif"
                 style="width: {{ $results->seo_score }}%;"
                 role="progressbar"></div>
        </div>
    </div>
    <p class="prose mb-3">Keyword score {{ round($results->seo_keyword, 2) }}%</p>
    <div class="mb-6">
        <div class="progress h-2.5 w-full bg-gray-50 mb-4 rounded-full relative dark:bg-zinc-600">
            <div class="progress-bar h-2.5 rounded-full ltr:rounded-r-none rtl:rounded-l-none
                 @if($results->seo_keyword < 40)
                    bg-red-500
                 @elseif($results->seo_keyword >= 40 && $results->seo_keyword < 70)
                    bg-amber-500
                 @else
                    bg-emerald-500
                 @endif"
                 style="width: {{ $results->seo_keyword }}%;"
                 role="progressbar"></div>
        </div>
    </div>
    <p class="prose mb-3 font-bold border-b pb-3">Messages</p>
    @foreach($results->messages as $messages => $items)
        @foreach($items as $item)
            <p class="prose mb-3 font-medium
                @if($messages === 'dangers') text-red-500
                @elseif($messages === 'warnings') text-amber-500
                @else text-emerald-500
                  @endif">{{ $item }}
            </p>
        @endforeach
    @endforeach
</div>

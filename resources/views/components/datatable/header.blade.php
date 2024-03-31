@props(['columns', 'action', 'order'])

<thead>
    <tr>
        @forelse($columns as $column => $property)
            @if($column === 'id')
                <th class="{{ $property['classes'] ?? '' }} cursor-pointer p-1 w-[7rem]" wire:key="{{ $column }}" wire:click="setOrder('{{ $column }}')">
                    <div class="flex justify-between items-center">
                        <span class="mt-2">{{ $property['label'] ?? '-' }}</span>
                        @if(isset($order[$column]) && $order[$column] === 'desc')
                            <i class="ti ti-sort-descending-2 text-2xl"></i>
                        @else
                            <i class="ti ti-sort-ascending-2 text-2xl"></i>
                        @endif
                    </div>
                </th>
            @else
            <th class="{{ $property['classes'] ?? '' }} cursor-pointer p-1" wire:key="{{ $column }}" wire:click="setOrder('{{ $column }}')">
                <div class="flex justify-between items-center">
                    <span class="mt-2">{{ $property['label'] ?? '-' }}</span>
                    @if(isset($order[$column]) && $order[$column] === 'desc')
                        <i class="ti ti-sort-descending-2 text-2xl"></i>
                    @else
                        <i class="ti ti-sort-ascending-2 text-2xl"></i>
                    @endif
                </div>
            </th>
            @endif
        @empty
        @endforelse
        @if($action)
            <th class="min-w-40" rowspan="2">
                <div class="px-4">
                    <i class="ti ti-settings text-2xl"></i>
                </div>
            </th>
        @endif
    </tr>
    <tr>
        @forelse($columns as $column => $property)
            <th class="p-1">
                @if($column !== 'id')
                    <x-text-input type="{{ $property['type'] ?? 'text' }}" placeholder="{{ $property['label'] ?? '' }}" class="min-w-[10rem] font-normal" wire:model.live="search.{{ $column }}"></x-text-input>
                @endif
            </th>
        @empty
        @endforelse
    </tr>
</thead>

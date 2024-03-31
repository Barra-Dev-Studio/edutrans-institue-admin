<div>
    <div class="overflow-x-auto js-scrollable">
        <table class="w-full table table-striped">
            <x-datatable.header :action="$action" :columns="$columns" :order="$order"></x-datatable.header>
            <tbody>
            @forelse($data as $row)
                <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white"
                    wire:key="{{ $row->id }}">
                    <td class="p-3 text-center"><x-datatable.row-index :data="$data" :loop="$loop"></x-datatable.row-index></td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d, H:i') }}</td>
                    <td class="p-3">{{ $row->title }}</td>
                    <td class="p-3">{{ $row->mentor }}</td>
                    <td class="p-3">{{ $row->category }}</td>
                </tr>
            @empty
                <x-datatable.nodata :column-length="count($columns)"></x-datatable.nodata>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex items-center justify-between gap-4">
        @if(!method_exists($data, 'getCursorName'))
            <div class="mt-4">
                <x-select-v2-input :options="$perPageOptions" model="perPage" class="w-20"></x-select-v2-input>
            </div>
        @endif
        <x-datatable.pagination :data="$data"></x-datatable.pagination>
    </div>
</div>

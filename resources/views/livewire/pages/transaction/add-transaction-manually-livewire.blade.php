<div>
    <div class="overflow-x-auto js-scrollable">
        <table class="w-full table table-striped">
            <x-datatable.header :action="$action" :columns="$columns" :order="$order"></x-datatable.header>
            <tbody>
            @forelse($data as $row)
                <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white"
                    wire:key="{{ $row->id }}">
                    <td class="p-3 text-center"><x-datatable.row-index :data="$data" :loop="$loop"></x-datatable.row-index></td>
                    <td class="p-3">{{ $row->title }}</td>
                    <td class="p-3">{{ $row->mentor->name }}</td>
                    <td class="p-3">Rp{{ number_format($row->price) }}</td>
                    <td class="p-3">Rp{{ number_format($row->discount_price) }}</td>
                    <td>
                        <button class="btn bg-emerald-500 text-white hover:bg-emerald-600" wire:click="assign('{{ $row->id }}')">Assign this course</button>
                    </td>
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

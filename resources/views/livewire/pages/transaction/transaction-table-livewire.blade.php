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
                    <td class="p-3">{{ $row->member->name }}</td>
                    <td class="p-3">
                        @foreach($row->transactionDetails as $detail)
                            {{ $detail->item_name }} ({{ $detail->item_type }})
                        @endforeach
                    </td>
                    <td class="p-3">{{ $row->paymentMethod->name }}</td>
                    <td class="p-3">Rp{{ number_format($row->total_disc) }}</td>
                    <td class="p-3">Rp{{ number_format($row->total_price) }}</td>
                    <td class="p-3">Rp{{ number_format($row->total_payment) }}</td>
                    <td class="p-3">{{ $row->status }}</td>
                    <td class="p-3 flex">
                        <a href="{{ route('dashboard.transaction.show', $row->id) }}"
                           class="p-2 flex items-center bg-sky-400 hover:bg-sky-300 rounded text-lg !no-underline">
                            <i class="bx bx-search-alt-2"></i>
                        </a>
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

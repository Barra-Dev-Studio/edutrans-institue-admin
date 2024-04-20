<div>
    <div class="overflow-x-auto js-scrollable">
        <table class="w-full table table-striped">
            <x-datatable.header :action="$action" :columns="$columns" :order="$order"></x-datatable.header>
            <tbody>
                @forelse($data as $row)
                <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white"
                    wire:key="{{ $row->id }}">
                    <td class="p-3 text-center"><x-datatable.row-index :data="$data"
                            :loop="$loop"></x-datatable.row-index></td>
                    <td class="p-3">{{ $row->name }}</td>
                    <td class="p-3">{{ $row->qty }}</td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($row->valid_start)->format('d F, Y') }} s.d
                        {{ \Carbon\Carbon::parse($row->valid_end)->format('d F, Y') }}
                    </td>
                    <td class="p-3">
                        <p>Price off: Rp{{ number_format($row->disc_off_price) }}</p>
                        <p>Percent off: {{ number_format($row->disc_off_percent) }}%</p>
                    </td>
                    <td class="p-3 flex">
                        <a href="{{ route('dashboard.voucher.show', $row->id) }}"
                            class="p-2 flex items-center bg-sky-400 hover:bg-sky-300 rounded-bl rounded-tl text-lg !no-underline">
                            <i class="bx bx-search-alt-2"></i>
                        </a>
                        <a href="{{ route('dashboard.voucher.edit', $row->id) }}"
                            class="p-2 flex items-center bg-amber-400 hover:bg-amber-300 text-lg !no-underline">
                            <i class="bx bx-edit"></i>
                        </a>
                        <button wire:click="showModal('dashboard.voucher.destroy', '{{ $row->id }}')"
                            class="p-2 flex items-center bg-rose-600 hover:bg-rose-700 rounded-tr rounded-br text-white text-lg">
                            <i class="bx bx-trash-alt"></i>
                        </button>
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
    <x-datatable.modal :isModalShow="$isModalShow" :deleteRoute="$deleteRoute"></x-datatable.modal>
</div>

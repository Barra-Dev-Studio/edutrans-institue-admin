<div>
    <div class="grid grid-cols-12 mb-5 space-x-3">
        <div class="col-span-3 md:col-span-1 prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Per page</label>
            <select wire:model.live="showPage"
                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div class="md:col-span-3 col-span-9 prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Search</label>
            <input wire:model.live="search"
                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                type="text" placeholder="Search you data">
        </div>
    </div>

    <div class="table-rep-plugin">
        <div class="table-wrapper overflow-auto">
            <div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns">
                <table class="table table-striped w-full text-left border border-gray-50 dark:border-zinc-600">
                    <thead>
                        <tr
                            class="border-b border-gray-50 dark:border-zinc-600 bg-gray-50/50 dark:bg-zinc-700/50 dark:text-zinc-100">
                            <th class="p-3">No.</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Product</th>
                            <th class="p-3">Payment method</th>
                            <th class="p-3">Discount</th>
                            <th class="p-3">Total payment</th>
                            <th class="p-3">Status</th>
                            <th class="p-3" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white prose"
                            wire:key="{{ $transaction->id }}">
                            <td class="p-3" width="50">{{ ($transactions->currentpage()-1) * $transactions->perpage() +
                                $loop->index +
                                1 }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d') }}</td>
                            <td class="p-3">
                                @foreach($transaction->transactionDetails as $detail)
                                    - {{ $detail->item_name }} ({{ $detail->item_type }})
                                @endforeach
                            </td>
                            <td class="p-3">{{ $transaction->paymentMethod->name }}</td>
                            <td class="p-3">Rp{{ number_format($transaction->total_disc) }}</td>
                            <td class="p-3">Rp{{ number_format($transaction->total_payment) }}</td>
                            <td class="p-3">{{ $transaction->status }}</td>
                            <td class="p-3 flex">
                                <a href="{{ route('member.transaction.show', $transaction->id) }}"
                                    class="p-2 flex items-center bg-sky-400 hover:bg-sky-300 rounded text-lg !no-underline">
                                    <i class="bx bx-search-alt-2"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr
                            class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-red-50/50">
                            <td class="p-3 text-center" colspan="7">We can't find what you are looking for</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="my-5">
        {{ $transactions->onEachSide(1)->links() }}
    </div>
</div>

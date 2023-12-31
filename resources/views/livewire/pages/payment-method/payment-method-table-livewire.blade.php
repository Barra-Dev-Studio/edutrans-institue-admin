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
                            <th class="p-3">Name</th>
                            <th class="p-3">Type</th>
                            <th class="p-3">Code</th>
                            <th class="p-3" width="100px">Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentMethods as $paymentMethod)
                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white prose"
                            wire:key="{{ $paymentMethod->id }}">
                            <td class="p-3" width="50">{{ ($paymentMethods->currentpage()-1) * $paymentMethods->perpage() + $loop->index +
                                1 }}</td>
                            <td class="p-3">{{ $paymentMethod->name }}</td>
                            <td class="p-3">{{ $paymentMethod->type }}</td>
                            <td class="p-3">{{ $paymentMethod->code }}</td>
                            <td class="p-3 flex">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer" @if($paymentMethod->is_active) checked @endif wire:change="updateStatus('{{ $paymentMethod->id }}')">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                            </td>
                        </tr>
                        @empty
                        <tr
                            class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-red-50/50">
                            <td class="p-3 text-center" colspan="4">We can't find what you are looking for</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="my-5">
        {{ $paymentMethods->onEachSide(1)->links() }}
    </div>
    <x-datatable.modal :isModalShow="$isModalShow" :deleteRoute="$deleteRoute"></x-datatable.modal>
</div>

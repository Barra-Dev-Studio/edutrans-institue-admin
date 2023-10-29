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
                            <th class="p-3" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr class="border-b border-gray-50 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 bg-white prose"
                            wire:key="{{ $category->id }}">
                            <td class="p-3" width="50">{{ ($categories->currentpage()-1) * $categories->perpage() + $loop->index +
                                1 }}</td>
                            <td class="p-3">{{ $category->name }}</td>
                            <td class="p-3 flex">
                                <a href="{{ route('dashboard.category.edit', $category->id) }}"
                                    class="p-2 flex items-center bg-amber-400 hover:bg-amber-300 text-lg rounded-tl rounded-bl !no-underline">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <button wire:click="showModal('dashboard.category.destroy', '{{ $category->id }}')"
                                    class="p-2 flex items-center bg-rose-600 hover:bg-rose-700 rounded-tr rounded-br text-white text-lg">
                                    <i class="bx bx-trash-alt"></i>
                                </button>
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
        {{ $categories->onEachSide(1)->links() }}
    </div>
    <x-datatable.modal :isModalShow="$isModalShow" :deleteRoute="$deleteRoute"></x-datatable.modal>
</div>

<div class="grid grid-cols-12 mb-5 space-x-3">
    <div class="col-span-3 md:col-span-1">
        <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Per page</label>
        <select wire:model.live="showPage"
            class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
            <option>5</option>
            <option>10</option>
            <option>25</option>
            <option>50</option>
        </select>
    </div>
    <div class="md:col-span-3 col-span-9">
        <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Search</label>
        <input wire:model.live="search"
            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
            type="text" placeholder="Search you data">
    </div>
</div>

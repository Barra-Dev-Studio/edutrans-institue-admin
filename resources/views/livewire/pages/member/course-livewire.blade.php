<div>
    <div class="grid grid-cols-12 mb-5 space-x-8">
        <div class="col-span-6 prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Filter </label>
            <div class="grid grid-cols-3 gap-4 items-center">
                <div>
                    <select wire:model.live="showPage"
                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <option>Category</option>
                    </select>
                </div>
                <div>
                    <select wire:model.live="showPage"
                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <option>Instructur</option>
                    </select>
                </div>
                <div>
                    <button class="block bg-emerald-500 w-full py-[7px] rounded">Filter</button>
                </div>
            </div>
        </div>
        <div class="col-span-6 prose">
            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">Search</label>
            <input wire:model.live="search"
                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                type="text" placeholder="Search you course">
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div class="cursor-pointer">
            <div class="card overflow-hidden">
                <img class="rounded-tl rounded-tr hover:scale-105 transition" src="assets/images/small/img-1.jpg" alt="">
                <div class="card-body bg-white">
                    <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">Course title</h6>
                    <p class="text-13 text-gray-500 dark:text-zinc-100">Short description at least two paragraph</p>
                </div>
                <div class="card-body flex items-center gap-4 bg-white border-t border-slate-200">
                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white dark:ring-zinc-500" src="assets/images/users/avatar-1.jpg" alt="">
                    <p class="text-13">Instructur</p>
                </div>
            </div>
        </div>
    </div>
</div>

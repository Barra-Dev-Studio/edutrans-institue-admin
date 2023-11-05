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
                    <button class="block bg-emerald-500 w-full py-[7px] rounded text-white hover:bg-emerald-600">Filter</button>
                </div>
            </div>
        </div>
        <div class="col-span-6 prose">
            <x-input-label for="search" :value="__('Search')" />
            <x-text-input wire:model.live="search" id="search" class="block mt-1 w-full" type="text" name="search" placeholder="Search your course" />
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div>
            <x-course-card
                img="https://images.unsplash.com/photo-1692312344458-9a4d495f7163?auto=format&fit=crop&q=80&w=2071&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                mentor="Khoerul Umam" title="Pengembangan diri dengan public speaking"
                description="Deskripsi singkat ini terkait dengan materi public speaking yang akan diajarkan..."
                price="250000"></x-course-card>
        </div>
    </div>
</div>
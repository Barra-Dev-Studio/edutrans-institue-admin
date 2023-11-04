<x-app-layout>
    <div class="grid grid-cols-2 gap-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="card bg-white cursor-pointer hover:bg-slate-100">
                <div class="card-body">
                    <div>
                        <div class="grid grid-cols-1 gap-5 items-center">
                            <div>
                                <span class="text-gray-700 dark:text-zinc-100">Continue on your journey</span>
                                <h4 class="mt-4 text-xl text-gray-800 dark:text-gray-100 ">Title course how to create PHP</h4>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        <span class="text-gray-700 text-13 dark:text-zinc-100">Last chapter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border border-slate-300 p-4 mb-8">
        <livewire:pages.member.course-livewire></livewire:pages.member.course-livewire>
    </div>
</x-app-layout>

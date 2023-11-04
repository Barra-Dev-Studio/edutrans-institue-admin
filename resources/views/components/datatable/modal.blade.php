@props(['isModalShow', 'deleteRoute'])
@if($isModalShow)
<div id="deleteModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-screen p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full bg-slate-800/70">
    <div class="relative w-full max-w-2xl max-h-full mx-auto translate-y-1/2 top-0">
        <div class="relative bg-slate-50 rounded shadow prose">
            <div class="px-6 pt-6">
                <div class="flex items-start gap-4">
                    <div>
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto rounded-full bg-red-50">
                            <i class="text-red-500 mdi mdi-alert-outline text-22"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mt-0" id="modal-title">Delete data
                        </h3>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-zinc-100/60">Are you sure you want to delete this data? All
                                of your data will be permanently removed. This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ $deleteRoute }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex items-center p-6 space-x-2 border-t border-slate-200 rounded-b ">
                    <button type="submit"
                        class="text-white bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded text-sm px-5 py-2.5 text-center">Delete</button>
                    <button type="button"
                        class="text-slate-500 bg-white hover:bg-slate-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded border border-slate-200 text-sm font-medium px-5 py-2.5 hover:text-slate-900 focus:z-10"
                        wire:click="resetModal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

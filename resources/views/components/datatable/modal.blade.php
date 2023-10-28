@props(['isModalShow', 'deleteRoute'])
@if($isModalShow)
<div id="deleteModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-screen p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full bg-slate-800/70">
    <div class="relative w-full max-w-2xl max-h-full mx-auto translate-y-1/2 top-0">
        <div class="relative bg-slate-50 rounded shadow ">
            <div class="flex items-start justify-between p-4 border-b rounded-t border-slate-200">
                <h3 class="text-xl font-semibold text-slate-900 ">
                    Are you sure want to delete this data?
                </h3>
                <button type="button"
                    class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded text-sm p-1.5 ml-auto inline-flex items-center "
                    wire:click.prevent="resetModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ $deleteRoute }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-slate-500 ">
                        You can&apos;t undo this action
                    </p>
                </div>
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

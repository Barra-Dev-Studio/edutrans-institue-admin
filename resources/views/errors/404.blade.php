<x-guest-layout>
    <div class="bg-gray-50/20 dark:bg-zinc-800 flex flex-col align-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-8xl text-gray-600 mb-3 dark:text-gray-100">4<span class="text-violet-500 mx-2">0</span>4</h1>
            <h4 class="uppercase mb-2 text-gray-600 text-[21px] dark:text-gray-100">Sorry, page not found</h4>
        </div>
        <div class="mt-12 text-center">
            <a class="!no-underline prose bg-sky-800 text-white py-3 px-6 rounded hover:bg-sky-700 hover:text-white" href="{{ url('/') }}">Back to Home</a>
        </div>
    </div>
</x-guest-layout>

<div>
    @if (session('success'))
    <div class="relative px-5 py-3 border-2 bg-green-50 text-green-700 border-green-100 rounded mb-3 !w-full">
        <p class="prose !text-green-700">{{ session('success') }}</p>
    </div>
    @endif
    @if (session('error'))
    <div class="relative px-5 py-3 border-2 bg-red-50 text-red-700 border-red-100 rounded mb-3 !w-full">
        <p class="prose !text-red-700">{{ session('error') }}</p>
    </div>
    @endif
</div>

<button {{ $attributes->merge(['type' => 'submit', 'class' => '!no-underline prose border border-sky-800 text-sky-800 py-3 px-8 rounded hover:bg-slate-200 hover:text-sky-800']) }}>
    {{ $slot }}
</button>

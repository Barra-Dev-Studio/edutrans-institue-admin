<button {{ $attributes->merge(['type' => 'submit', 'class' => '!no-underline prose bg-sky-800 text-white py-3 px-8 rounded hover:bg-sky-700 hover:text-white']) }}>
    {{ $slot }}
</button>

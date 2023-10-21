@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded border-gray-100
placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50
dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100']) !!}></textarea>

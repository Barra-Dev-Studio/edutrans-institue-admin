@props(['options', 'value', 'label'])

<select
    {!! $attributes->merge(['class' => 'dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border
    focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100']) !!}>
    <option value="-1">Select</option>
    @foreach($options as $option)
    <option value="{{ $option[$value] }}">{{ $option[$label] }}</option>
    @endforeach
</select>

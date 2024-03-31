@props(['data', 'loop'])

<span>
    @if(!method_exists($data, 'getCursorName'))
    {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
    @endif
</span>

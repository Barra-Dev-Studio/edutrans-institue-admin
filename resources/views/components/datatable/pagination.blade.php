@props(['data', 'perPage', 'perPageOptions'])

<div class="mt-4 basis-full">
    {{ method_exists($data, 'getCursorName') ? $data->links() : $data->onEachSide(2)->links() }}
</div>

@props(['model', 'options', 'multiple' => false, 'key' => null, 'value' => null, 'all' => false])

<label>
    <select @if($multiple) data-choices data-choices-removeItem multiple @endif {{ $attributes->merge(["class" => "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm font-normal"]) }} wire:model.live="{{ $model }}">
        <option value="-1" @if(!$all) disabled @endif selected>{{ $all ? 'Semua data' : 'Select data' }}</option>
        @if($key === null && $value === null)
            @foreach($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        @else
            @foreach($options as $option)
                <option value="{{ $option[$key] }}">{{ $option[$value] }}</option>
            @endforeach
        @endif
    </select>
</label>

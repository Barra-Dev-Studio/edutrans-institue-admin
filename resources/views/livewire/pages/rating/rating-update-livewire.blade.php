<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit" class="prose">
        @if ($currentPhoto && !$photo)
        <div class="mb-4">
            <img src="{{ \Storage::url($currentPhoto) }}" alt="">
        </div>
        @elseif($photo)
        <div>
            <img src="{{ $photo->temporaryUrl() }}" alt="">
        </div>
        @endif
        <div class="mt-4">
            <x-input-label for="photo" :value="__('Photo')" />
            <x-text-input wire:model.live="photo" id="photo" class="block mt-1 w-full" type="file" name="photo"
                placeholder="Photo" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live="name" id="name" class="block mt-1 w-full" type="text" name="name"
                          placeholder="Name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="rate" :value="__('Rate')"></x-input-label>
            <div class="flex items-center gap-4">
                <livewire:plugin.rating-livewire :value="$rate"></livewire:plugin.rating-livewire>
                <span>{{ $rate }} dari 5</span>
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <x-textarea-input wire:model.live="content" id="content" class="block mt-1 w-full" type="text" name="content"
                              placeholder="Content" required />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit" class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove wire:target="submit">Save rating</span><span wire:loading wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

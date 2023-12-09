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
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model.live="title" id="title" class="block mt-1 w-full" type="text" name="title"
                placeholder="Title" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <livewire:plugin.trix-livewire :value="$content"></livewire:plugin.trix-livewire>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit" class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove wire:target="submit">Save course section</span><span wire:loading wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

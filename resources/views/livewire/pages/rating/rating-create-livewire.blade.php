<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit" class="prose">
        @can('access-admin')
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live="name" id="name" class="block mt-1 w-full" type="text" name="name"
                placeholder="Name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        @endcan
        <div>
            <x-input-label for="rate" :value="__('Rate')"></x-input-label>
            <div class="flex items-center gap-4">
                <livewire:plugin.rating-livewire :value="$rate"></livewire:plugin.rating-livewire>
                <span>{{ $rate }} dari 5</span>
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="content" :value="__('Komentar')" />
            <x-textarea-input wire:model.live="content" id="content" class="block mt-1 w-full" type="text" name="content"
                          placeholder="Komentar" required />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit" class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove wire:target="submit">Kirimkan komentar</span><span wire:loading wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

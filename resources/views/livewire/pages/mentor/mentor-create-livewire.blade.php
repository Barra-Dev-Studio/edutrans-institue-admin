<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit" class="prose">
        @if ($photo)
        <div class="mb-4">
            <img src="{{ $photo->temporaryUrl() }}" alt="">
        </div>
        @endif
        <div>
            <x-input-label for="photo" :value="__('Photo')" />
            <x-text-input wire:model.live="photo" id="photo" class="block mt-1 w-full" type="file" name="photo"
                placeholder="Photo" required />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live="name" id="name" class="block mt-1 w-full" type="text" name="name"
                placeholder="Name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="speciality" :value="__('Speciality')" />
            <x-text-input wire:model.live="speciality" id="speciality" class="block mt-1 w-full" type="text" name="speciality"
                placeholder="Professional Educator" required />
            <x-input-error :messages="$errors->get('speciality')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="bio" :value="__('Bio')" />
            <livewire:plugin.trix-livewire :value="$bio"></livewire:plugin.trix-livewire>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit" class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove wire:target="submit">Add new mentor</span><span wire:loading wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

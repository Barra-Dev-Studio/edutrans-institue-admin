<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit">
        @if ($currentPhoto && !$photo)
        <div class="mt-4">
            <img src="{{ \Storage::url($currentPhoto) }}" alt="">
        </div>
        @elseif($photo)
        <div class="mt-4">
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
            <x-input-label for="speciality" :value="__('Speciality')" />
            <x-text-input wire:model.live="speciality" id="speciality" class="block mt-1 w-full" type="text"
                name="speciality" placeholder="Professional Educator" required />
            <x-input-error :messages="$errors->get('speciality')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="bio" :value="__('Email')" />
            <x-textarea-input wire:model.live="bio" id="bio" class="block mt-1 w-full" name="bio"
                placeholder="Short bio" required />
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit">Save mentor</button>
        </div>
    </form>
</div>

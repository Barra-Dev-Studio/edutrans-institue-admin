<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit">
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live="name" id="password" class="block mt-1 w-full" type="text" name="name"
                placeholder="Name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input wire:model.live="description" id="description" class="block mt-1 w-full" name="description"
                placeholder="Description" required />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit">Save category</button>
        </div>
    </form>
</div>

<div>
    <form wire:submit.prevent="submit" class="prose">
        @if ($currentThumbnail && !$thumbnail)
        <div class="mb-4">
            <img src="{{ \Storage::url($currentThumbnail) }}" alt="">
        </div>
        @elseif($thumbnail)
        <div>
            <img src="{{ $thumbnail->temporaryUrl() }}" alt="">
        </div>
        @endif
        <div>
            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
            <x-text-input wire:model.live="thumbnail" id="thumbnail" class="block mt-1 w-full" type="file"
                name="thumbnail" placeholder="thumbnail" />
            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model.live="title" id="title" class="block mt-1 w-full" type="text" title="title"
                placeholder="Title" required wire:keyup="updateSlug" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input wire:model.live="slug" id="slug" class="block mt-1 w-full" type="text" name="slug"
                placeholder="Slug" required />
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <livewire:plugin.trix-livewire :value="$content"></livewire:plugin.trix-livewire>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="tags" :value="__('Tags')" />
            <x-text-input wire:model.live="tags" id="tags" class="block mt-1 w-full" type="text" name="tags"
                placeholder="Education, Tips, Trick" required />
            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input :options="$statuses" :value="'id'" :label="'name'" name="status"
                wire:model.live="status"></x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="tags" :value="__('Search Enginer Optimization (SEO)')" />
        </div>
        <div class="mt-4">
            <x-input-label for="author" :value="__('Author')" />
            <x-text-input wire:model.live="author" id="author" class="block mt-1 w-full" type="text" name="author"
                placeholder="Author" required />
            <x-input-error :messages="$errors->get('author')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input wire:model.live="description" id="description" class="block mt-1 w-full" type="text"
                name="description" placeholder="Description" required />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="keyword" :value="__('Keyword')" />
            <x-text-input wire:model.live="keyword" id="keyword" class="block mt-1 w-full" type="text" name="keyword"
                              placeholder="Keyword" required />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit"
                class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove
                    wire:target="submit">Save post</span><span wire:loading
                    wire:target="submit"><x-spinner></x-spinner></span>
            </button>
            <x-flash-notification></x-flash-notification>
        </div>
    </form>
</div>


<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit" class="prose">
        @if ($currentCover && !$cover)
        <div class="mb-4">
            <img src="{{ \Storage::url($currentCover) }}" alt="">
        </div>
        @elseif($cover)
        <div>
            <img src="{{ $cover->temporaryUrl() }}" alt="">
        </div>
        @endif
        <div>
            <x-input-label for="cover" :value="__('Cover')" />
            <x-text-input wire:model.live="cover" id="cover" class="block mt-1 w-full" type="file" name="cover"
                placeholder="Cover" />
            <x-input-error :messages="$errors->get('cover')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model.live="title" id="title" class="block mt-1 w-full" type="text" name="title"
                placeholder="Title" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input wire:model.live="slug" id="slug" class="block mt-1 w-full" type="text" name="slug"
                placeholder="Slug" required />
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <livewire:plugin.trix-livewire :value="$description"></livewire:plugin.trix-livewire>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mt-4">
            <div>
                <x-input-label for="category" :value="__('Category')" />
                <x-select-input :options="$categories" :value="'id'" :label="'name'" name="category"
                    wire:model.live="category" wire:change="setSelectedCategory"></x-select-input>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            @if($selectedCategory != null)
            <div class="mt-4 prose">
                <h4 class="mb-0 text-slate-700">{{ $selectedCategory->name }}</h4>
                <p class="text-sm text-slate-500">{{ $selectedCategory->description }}</p>
            </div>
            @endif
        </div>
        <div class="grid grid-cols-2 mt-4 gap-2">
            <div>
                <x-input-label for="author" :value="__('Author')" />
                <x-text-input wire:model.live="author" id="author" class="block mt-1 w-full" type="text" name="author"
                    placeholder="Author" required />
                <x-input-error :messages="$errors->get('author')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="publisher" :value="__('Publisher')" />
                <x-text-input wire:model.live="publisher" id="publisher" class="block mt-1 w-full" type="text"
                    name="publisher" placeholder="Publisher" required />
                <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-2 mt-4 gap-2">
            <div>
                <x-input-label for="isbn" :value="__('ISBN')" />
                <x-text-input wire:model.live="isbn" id="isbn" class="block mt-1 w-full" type="text" name="isbn"
                    placeholder="ISBN" required />
                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="publishedYear" :value="__('Published year')" />
                <x-text-input wire:model.live="publishedYear" id="publishedYear" class="block mt-1 w-full" type="month"
                    name="publishedYear" placeholder="Published year" required />
                <x-input-error :messages="$errors->get('publishedYear')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-2 mt-4 gap-2">
            <div>
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input wire:model.live="price" id="price" class="block mt-1 w-full" type="number" name="price"
                    placeholder="Price" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="discountPrice" :value="__('Discount price')" />
                <x-text-input wire:model.live="discountPrice" id="discountPrice" class="block mt-1 w-full" type="number"
                    name="discountPrice" placeholder="Discount price" required />
                <x-input-error :messages="$errors->get('discountPrice')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-4 mt-4 gap-2">
            <div>
                <x-input-label for="totalPages" :value="__('Total pages')" />
                <x-text-input wire:model.live="totalPages" id="totalPages" class="block mt-1 w-full" type="number" name="totalPages"
                    placeholder="Total pages" required />
                <x-input-error :messages="$errors->get('totalPages')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="totalViews" :value="__('Total views')" />
                <x-text-input wire:model.live="totalViews" id="totalViews" class="block mt-1 w-full" type="number"
                    name="totalViews" placeholder="Total views" required />
                <x-input-error :messages="$errors->get('totalViews')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="totalShares" :value="__('Total shares')" />
                <x-text-input wire:model.live="totalShares" id="totalShares" class="block mt-1 w-full" type="number"
                    name="totalShares" placeholder="Total shares" required />
                <x-input-error :messages="$errors->get('totalShares')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="totalPurchased" :value="__('Total purchased')" />
                <x-text-input wire:model.live="totalPurchased" id="totalPurchased" class="block mt-1 w-full"
                    type="number" name="totalPurchased" placeholder="Total purchased" required />
                <x-input-error :messages="$errors->get('totalPurchased')" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="@if($status === 'DRAFT') bg-emerald-100 @else bg-slate-100 @endif p-4 border border-slate-300 cursor-pointer"
                    wire:click="setStatus('DRAFT')">
                    <h5 class="text-slate-700 mb-0">Draft @if($status === 'DRAFT') <span><i
                                class="bx bx-badge-check"></i></span>@endif
                    </h5>
                    <p class="text-slate-500 m-0">The course is hidden from public</p>
                </div>
                <div class="@if($status === 'PUBLISHED') bg-emerald-100 @else bg-slate-100 @endif p-4 border border-slate-300 cursor-pointer"
                    wire:click="setStatus('PUBLISHED')">
                    <h5 class="text-slate-700 mb-0">Publish @if($status === 'PUBLISHED') <span><i
                                class="bx bx-badge-check"></i></span>@endif</h5>
                    <p class="text-slate-500 m-0">The course will be published and visible from public</p>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit"
                class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove
                    wire:target="submit">Add new book</span><span wire:loading
                    wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

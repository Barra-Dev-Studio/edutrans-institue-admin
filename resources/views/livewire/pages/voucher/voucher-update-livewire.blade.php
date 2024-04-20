<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit" class="prose">
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live="name" id="name" class="block mt-1 w-full" type="text" name="name"
                placeholder="Name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input wire:model.live="description" id="description" class="block mt-1 w-full" type="text"
                name="description" placeholder="Description" required />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="flex items-center gap-2 mb-4">
            <div class="w-full">
                <x-input-label for="code" :value="__('Code')" />
                <x-text-input wire:model.live="code" id="code" class="block mt-1 w-full" type="text" name="code"
                    placeholder="Code" required />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="qty" :value="__('Quota')" />
                <x-text-input wire:model.live="qty" id="qty" class="block mt-1 w-full" type="number" name="qty"
                    placeholder="Quota" required />
                <x-input-error :messages="$errors->get('qty')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center gap-2 mb-4">
            <div class="w-full">
                <x-input-label for="validStart" :value="__('Valid start')" />
                <x-text-input wire:model.live="validStart" id="validStart" class="block mt-1 w-full" type="date"
                    name="validStart" placeholder="Valid start" required />
                <x-input-error :messages="$errors->get('validStart')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="validEnd" :value="__('Valid end')" />
                <x-text-input wire:model.live="validEnd" id="validEnd" class="block mt-1 w-full" type="date"
                    name="validEnd" placeholder="Quota" required />
                <x-input-error :messages="$errors->get('validEnd')" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center gap-2 mb-4">
            <div class="w-full">
                <x-input-label for="discOffPrice" :value="__('Disc off price (IDR)')" />
                <x-text-input wire:model.live="discOffPrice" id="discOffPrice" class="block mt-1 w-full" type="number"
                    name="discOffPrice" placeholder="Disc off price (IDR)" required />
                <x-input-error :messages="$errors->get('discOffPrice')" class="mt-2" />
            </div>
            <div class="w-full">
                <x-input-label for="discOffPercent" :value="__('Disc off percent (%)')" />
                <x-text-input wire:model.live="discOffPercent" id="discOffPercent" class="block mt-1 w-full"
                    type="number" name="discOffPercent" placeholder="Disc off percent (%)" required />
                <x-input-error :messages="$errors->get('discOffPercent')" class="mt-2" />
            </div>
        </div>
        <h6>Rules</h6>
        <div class="mb-4">
            <x-input-label for="minimumOrder" :value="__('Minimum order')" />
            <x-text-input wire:model.live="minimumOrder" id="minimumOrder" class="block mt-1 w-full" type="number"
                name="minimumOrder" placeholder="Minimum order" required />
            <span class="text-xs">Minimum order. For example 1 product</span>
            <x-input-error :messages="$errors->get('minimumOrder')" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-input-label for="minimumTransaction" :value="__('Minimum transaction')" />
            <x-text-input wire:model.live="minimumTransaction" id="minimumTransaction" class="block mt-1 w-full"
                type="number" name="minimumTransaction" placeholder="Minimum transaction" required />
            <span class="text-xs">Minimum transaction. For example 100.000 IDR.</span>
            <x-input-error :messages="$errors->get('minimumTransaction')" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-input-label for="selectedCourse" :value="__('Courses')" />
            <x-select-input :options="$courses" value="id" label="title" name="selectedCourse"
                wire:model.live="selectedCourse" wire:change="setSelectedCourse"></x-select-input>
            <x-input-error :messages="$errors->get('minimumOrder')" class="mt-2" />
            <div class="flex flex-wrap gap-2 @if(count($ruleCourses) > 0) mt-2 @endif">
                @foreach($ruleCourses as $selected)
                <span class="text-xs border rounded border-slate-400 p-1 flex items-center gap-2">{{ $selected->name }}
                    <i class="cursor-pointer bx bx-trash-alt text-red-500"
                        wire:click="deleteSelectedCourse('{{ $selected->id }}')"></i>
                </span>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <x-input-label for="selectedMember" :value="__('Members')" />
            <x-select-input :options="$members" value="id" label="name" name="selectedMember"
                wire:model.live="selectedMember" wire:change="setSelectedMember"></x-select-input>
            <x-input-error :messages="$errors->get('minimumOrder')" class="mt-2" />
            <div class="flex flex-wrap gap-2 @if(count($ruleMembers) > 0) mt-2 @endif">
                @foreach($ruleMembers as $selected)
                <span class="text-xs border rounded border-slate-400 p-1 flex items-center gap-2">{{ $selected->name }}
                    <i class="cursor-pointer bx bx-trash-alt text-red-500"
                        wire:click="deleteSelectedMember('{{ $selected->id }}')"></i>
                </span>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <button wire:loading.attr="disabled" wire:target="submit"
                class="bg-emerald-500 px-6 py-3 text-sm text-white rounded hover:bg-emerald-600" type="submit"><span
                    wire:loading.remove wire:target="submit">Simpan voucher</span><span wire:loading
                    wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

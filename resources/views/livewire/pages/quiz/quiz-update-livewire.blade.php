<div>
    <x-flash-notification></x-flash-notification>
    <form wire:submit.prevent="submit" class="prose">
        <div>
            <x-input-label for="question" :value="__('Question')" />
            <livewire:plugin.c-k-editor-livewire :value="$question"></livewire:plugin.c-k-editor-livewire>
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>
        <div class="mt-4 flex flex-col gap-4">
            @foreach($answers as $answer)
                <div class="flex w-full gap-4 justify-between items-end">
                    <div class="flex-1">
                        <x-input-label for="answers.{{ $loop->index }}" :value="__('Answer ' . $loop->iteration)" />
                        <x-text-input wire:model.live="answers.{{ $loop->index }}" id="answers.{{ $loop->index }}" class="block mt-1 w-full" type="text" name="answers.{{ $loop->index }}"
                                      placeholder="Answer {{ $loop->iteration }}" required />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="isCorrects.{{ $loop->index }}" :value="__('Is Correct?')" />
                        <x-select-input :options="$isCorrectValues" :label="'name'" :value="'id'" wire:model.live="isCorrects.{{ $loop->index }}" id="isCorrects.{{ $loop->index }}" class="block mt-1 w-full"  name="isCorrects.{{ $loop->index }}"
                                        placeholder="Is Correct?" required />
                    </div>
                    @if(!$loop->first)
                        <div class="flex-1">
                            <button class="bg-red-500 px-4 py-2 text-white rounded w-full hover:bg-red-600" wire:click.prevent="removeAnswer({{ $loop->index }})">Delete</button>
                        </div>
                    @endif
                </div>
            @endforeach
            <button class="bg-slate-200 w-full py-2 rounded hover:bg-slate-300" wire:click.prevent="addAnswer">Add another answer</button>
        </div>
        <div class="mt-4">
            <x-input-label for="score" :value="__('Score')" />
            <x-text-input wire:model.live="score" id="score" class="block mt-1 w-full" type="number" min="0" name="score"
                          placeholder="Score" required />
            <x-input-error :messages="$errors->get('score')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="duration" :value="__('Duration (s)')" />
            <x-text-input wire:model.live="duration" id="duration" class="block mt-1 w-full" type="number" min="5" name="duration"
                          placeholder="Duration (s)" required />
            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input :options="$statusValues" :label="'name'" :value="'id'" wire:model.live="status" id="status" class="block mt-1 w-full" name="status"
                            placeholder="Status" required />
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
        <div class="mt-4">
            <button wire:loading.attr="disabled" wire:target="submit" class="bg-emerald-500 px-6 py-3 text-white rounded" type="submit"><span wire:loading.remove wire:target="submit">Save question</span><span wire:loading wire:target="submit"><x-spinner></x-spinner></span></button>
        </div>
    </form>
</div>

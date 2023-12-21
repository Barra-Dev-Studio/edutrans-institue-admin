<?php

namespace App\Livewire\Plugin;

use Livewire\Component;

class CKEditorLivewire extends Component
{
    const EVENT_VALUE_UPDATED = 'c_k_editor_livewire_value_updated';

    public $value;
    public function render()
    {
        return view('livewire.plugin.c-k-editor-livewire');
    }
}

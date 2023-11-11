<?php

namespace App\Livewire\Plugin;

use Livewire\Component;

class TrixLivewire extends Component
{
    const EVENT_VALUE_UPDATED = 'trix_livewire_value_updated';

    public $value;
    public $trixId;

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updated($value)
    {
        $this->dispatch(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function render()
    {
        return view('livewire.plugin.trix-livewire');
    }
}

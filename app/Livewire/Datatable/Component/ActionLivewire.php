<?php

namespace App\Livewire\Datatable\Component;

use Livewire\Component;

class ActionLivewire extends Component
{
    public $routeShow;
    public $routeEdit;
    public $routeDestroy;
    public $uniqueId;
    public $deleteModalIsShow = false;

    public function showModal()
    {
        $this->deleteModalIsShow = !$this->deleteModalIsShow;
    }

    public function render()
    {
        return view('livewire.datatable.component.action-livewire');
    }
}

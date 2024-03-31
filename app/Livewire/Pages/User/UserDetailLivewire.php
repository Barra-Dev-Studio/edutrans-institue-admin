<?php

namespace App\Livewire\Pages\User;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserDetailLivewire extends Component
{
    public mixed $user;
    public string $activeTab = 'courses';

    public function changeTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render(): View
    {
        return view('livewire.pages.user.user-detail-livewire');
    }
}

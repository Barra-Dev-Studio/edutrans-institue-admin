<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;

class UserUpdateLivewire extends Component
{
    public $id;
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $user = User::find($this->id);
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            User::where('id', $this->id)->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            return redirect()->route('dashboard.user.index')->with('success', 'User updated successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update new user');
        }
    }

    public function render()
    {
        return view('livewire.pages.user.user-update-livewire');
    }
}

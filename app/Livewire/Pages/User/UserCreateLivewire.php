<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Hash;
use Livewire\Component;

class UserCreateLivewire extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            User::create([
                'name'=> $this->name,
                'email'=> $this->email,
                'password'=> Hash::make($this->password),
            ]);
            return redirect()->route('dashboard.user.index')->with('success','User created successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new user');
        }
    }

    public function render()
    {
        return view('livewire.pages.user.user-create-livewire');
    }
}

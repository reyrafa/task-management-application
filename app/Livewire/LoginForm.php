<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
    #[Validate('required', 'email')]
    public $email;

    #[Validate('required')]
    public $password;

    public $remember = false;

    public function login()
    {
        $this->validate();
        $credentials = ['email' => $this->email, 'password' => $this->password];
        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            $this->password = '';
            session()->flash('error', 'The provided credentials do not match our records.');
        }
    }

    public function render()
    {
        return view('livewire.login-form')
            ->layout('layouts.app',
                ['title' => 'Login',
                    'page_title' => '']
            );
    }
}

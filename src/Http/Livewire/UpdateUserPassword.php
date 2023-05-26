<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Queenshera\AdminPanel\Rules\Password;

class UpdateUserPassword extends Component
{
    public $passwords = [
        'currentPassword' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function render()
    {
        return view('livewire.update-user-password');
    }

    public function updatePassword()
    {
        $this->resetErrorBag();
        $this->validatePasswords();

        User::where('id', auth()->user()->id)->update(['password' => Hash::make($this->passwords['password'])]);
        Auth::logoutOtherDevices($this->passwords['currentPassword']);

        $this->emit('passwordUpdated');

        $this->passwords = [
            'currentPassword' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
    }

    protected function validatePasswords()
    {
        $user = auth()->user();
        return Validator::make($this->passwords, [
            'currentPassword' => ['required', 'string', 'currentPassword:web'],
            'password' => ['required', 'string', new Password, 'confirmed', function ($attribute, $value, $fail) use ($user) {
                if (Hash::check($value, $user->password)) {
                    return $fail(__('The new password should not match current password.'));
                }
            }],
        ],[
            'currentPassword.required' => 'The current password field is required.',
            'currentPassword.current_password' => 'The provided password does not match your current password.',

        ])->validateWithBag('updateUserProfile');
    }
}

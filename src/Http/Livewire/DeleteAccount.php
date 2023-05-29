<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class DeleteAccount extends Component
{
    public $password = '';
    public $alert = '';

    public function render()
    {
        return view('livewire.delete-account');
    }

    public function confirmAccountDelete()
    {
        $this->password = '';
        $this->alert = '';
        $this->emit('confirmingDeletion');
    }

    public function deleteAccountPermanently(Request $request)
    {
        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->alert = 'This password does not match our records.';
            return;
        }

        User::find(auth()->user()->id)->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('/');
    }
}

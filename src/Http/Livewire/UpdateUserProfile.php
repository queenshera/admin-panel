<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Queenshera\AdminPanel\Helpers\AppHelper;

class UpdateUserProfile extends Component
{
    use WithFileUploads;

    public $user = [];
    public $photo;

    public function render()
    {
        return view('livewire.update-user-profile');
    }

    public function mount()
    {
        $this->user = auth()->user()->toArray();
    }

    public function saveProfile()
    {
        $this->resetErrorBag();
        $validated = $this->validateProfileData();

        User::find(auth()->user()->id)->update($validated);

        $this->emit('profileUpdated');
    }

    public function deleteProfilePhoto()
    {
        $this->user['photo'] = null;
        User::find(auth()->user()->id)->update($this->user);
    }

    public function updatedPhoto()
    {
        $this->resetErrorBag();
        $this->validateProfilePhoto();

        $name = 'photo_' . date('ymdHis') . '.' . $this->photo->getClientOriginalExtension();
        $storagePath = 'profile/' . $name;

        $helper = new AppHelper();
        $filePath = $helper->livewireFileUpload($this->photo, $storagePath);

        $this->user['photo'] = $filePath;
        User::find(auth()->user()->id)->update($this->user);

        $this->emit('profileUpdated');
    }

    protected function validateProfileData()
    {
        return Validator::make($this->user, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user['id'])],
            'mobile' => ['required', 'string'],
        ])->validateWithBag('updateProfile');
    }

    protected function validateProfilePhoto()
    {
        $data['photo'] = $this->photo;
        return Validator::make($data, [
            'photo' => ['required','max:256']
        ])->validateWithBag('updateProfile');
    }

}

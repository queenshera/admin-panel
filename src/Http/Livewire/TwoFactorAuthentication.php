<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class TwoFactorAuthentication extends Component
{
    public $password = '';
    public $alert = '';
    public $twoFaQr = '';
    public $user;
    public $showingQrCode = false;
    public $showingConfirmation = false;
    public $showingRecoveryCodes = false;
    public $code;

    public function render()
    {
        return view('livewire.two-factor-authentication');
    }

    public function mount()
    {
        if (is_null(auth()->user()->two_factor_confirmed_at)) {
            $this->twoFactorAuthenticationDisableConfirmed();
        }
    }

    public function getEnabledProperty()
    {
        return !empty(auth()->user()->two_factor_secret);
    }

    public function confirmPasswordForTwoFactorAuthentication()
    {
        $this->password = '';
        $this->alert = '';
        $this->emit('confirmingTwoFactorAuthentication');
    }

    public function twoFactorAuthenticationPasswordConfirmed()
    {
        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->alert = 'This password does not match our records.';
            return;
        }

        $google2fa = app('pragmarx.google2fa');
        $this->user = auth()->user();

        $setupKey = $google2fa->generateSecretKey();

        $this->user->forceFill([
            'two_factor_secret' => encrypt($setupKey),
            'two_factor_recovery_codes' => $this->recoveryCodes(),
        ])->save();

        $this->twoFaQr = $google2fa->getQRCodeInline(
            config('app.name'),
            $this->user->email,
            $setupKey
        );

        $this->showingQrCode = true;
        $this->showingConfirmation = true;

        $this->emit('twoFactorAuthenticationPasswordConfirmed');
    }

    public function confirmTwoFactorAuthentication()
    {
        $google2fa = app('pragmarx.google2fa');
        if (empty($this->user->two_factor_secret) ||
            empty($this->code) ||
            !$google2fa->verifyKey(decrypt($this->user->two_factor_secret), $this->code)) {
            throw ValidationException::withMessages([
                'code' => [__('The provided two factor authentication code was invalid.')],
            ])->errorBag('confirmTwoFactorAuthentication');
        }

        $this->user->forceFill([
            'two_factor_confirmed_at' => now(),
        ])->save();

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = true;
    }

    public function showRecoveryCodes()
    {
        $this->user = auth()->user();
        $this->showingRecoveryCodes = true;
    }

    public function regenerateRecoveryCodes()
    {
        $recoveryCodes = $this->recoveryCodes();
        $this->user->forceFill([
            'two_factor_recovery_codes' => $recoveryCodes
        ])->save();

        $this->user['two_factor_recovery_codes'] = $recoveryCodes;
    }

    public function twoFactorAuthenticationDisableConfirmed()
    {
        $user = auth()->user();

        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = false;
    }

    protected function recoveryCodes()
    {
        return encrypt(json_encode(Collection::times(8, function () {
            return Str::random(10) . '-' . Str::random(10);
        })->all()));
    }
}

<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card-body box-profile">
                    <h4>Two Factor Authentication</h4>
                    <p>
                        Add additional security to your account using two factor authentication.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box-body">
                    <h5>
                        @if ($this->enabled)
                            @if ($showingConfirmation)
                                {{ __('Finish enabling two factor authentication.') }}
                            @else
                                {{ __('You have enabled two factor authentication.') }}
                            @endif
                        @else
                            {{ __('You have not enabled two factor authentication.') }}
                        @endif
                    </h5>
                    <div>
                        <p>
                            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
                        </p>
                    </div>

                    @if ($this->enabled)
                        @if ($showingQrCode)
                            <div>
                                <p>
                                    @if ($showingConfirmation)
                                        {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                                    @else
                                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                                    @endif
                                </p>
                            </div>

                            <div>
                                {!! $twoFaQr !!}
                            </div>
                            <div>
                                <p>
                                    {{ __('Setup Key') }}: {{ decrypt($user->two_factor_secret) }}
                                </p>
                            </div>

                            @if($showingConfirmation)
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control col-md-8" id="code" wire:model="code">
                                </div>
                                @error('code')<p style="color: red">{{$message}}</p>@enderror
                            @endif
                        @endif

                        @if ($showingRecoveryCodes)
                            <div>
                                <p style="font-weight: 600">
                                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                                </p>
                            </div>

                            <div style="font-family: monospace; background-color: rgb(243 244 246);padding: 1rem;">
                                @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                    <div>{{ $code }}</div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
                <div class="box-footer mt-2">
                    @if ($this->enabled)
                        @if ($showingConfirmation)
                            <button class="btn btn-secondary" wire:click="confirmTwoFactorAuthentication">Confirm</button>
                        @elseif($showingRecoveryCodes)
                            <button class="btn btn-default" wire:click="regenerateRecoveryCodes">Regenerate Recovery Codes</button>
                        @else
                            <button class="btn btn-default" wire:click="showRecoveryCodes">Show Recovery Codes</button>
                        @endif

                        @if($showingConfirmation)
                            <button class="btn btn-default" wire:click="twoFactorAuthenticationDisableConfirmed">Cancel</button>
                        @else
                            <button class="btn btn-danger" wire:click="twoFactorAuthenticationDisableConfirmed">Disable</button>
                        @endif
                    @else
                        <button class="btn btn-secondary" wire:click="confirmPasswordForTwoFactorAuthentication">Enable</button>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal" id="modal-two-fa-confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Password</h4>
                </div>
                <div class="modal-body">
                    <p>
                        For your security, please confirm your password to continue.
                    </p>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" wire:model.defer="password" wire:keydown.enter="twoFactorAuthenticationPasswordConfirmed">
                    <p style="color: red">
                        {{$alert}}
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="twoFactorAuthenticationPasswordConfirmed">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

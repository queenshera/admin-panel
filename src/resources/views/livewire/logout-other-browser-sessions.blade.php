<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card-body box-profile">
                    <h4>Browser Sessions</h4>
                    <p>
                        Manage and log out your active sessions on other browsers and devices.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <p>
                    If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
                </p>
                <div class="box-body">
                    @if (count($sessions) > 0)
                        <div class="mt-5 space-y-6">
                            <!-- Other Browser Sessions -->
                            @foreach ($sessions as $session)
                                <div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
                                    <div>
                                        @if ($session->agent->isDesktop())
                                            <i class="far fa-desktop"></i>
                                        @else
                                            <i class="far fa-mobile"></i>
                                        @endif
                                    </div>

                                    <div class="ml-3">
                                        <div style="font-size: .875rem; line-height: 1.25rem;">
                                            {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                                        </div>

                                        <div>
                                            <div style="font-size: .75rem; line-height: 1rem;">
                                                {{ $session->ip_address }},

                                                @if ($session->is_current_device)
                                                    <span style="color: rgb(34 197 94)" class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                                @else
                                                    {{ __('Last active') }} {{ $session->last_active }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="box-footer">
                    <button class="btn btn-secondary" wire:click="confirmSessionLogout">Logout other browser sessions</button>
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Log Out Other Browser Sessions</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.
                    </p>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions">
                    <p style="color: red">
                        {{$alert}}
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="logoutOtherBrowserSessions">Logout Other Sessions</button>
                </div>
            </div>
        </div>
    </div>
</div>

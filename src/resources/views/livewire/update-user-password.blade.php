<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card-body box-profile">
                    <h4>Update Password</h4>
                    <p>
                        Ensure your account is using a long, random password to stay secure.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box-body">
                    <div class="form-group mb-0">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control col-md-8" id="currentPassword" wire:model="passwords.currentPassword">
                    </div>
                    @error('currentPassword')<p style="color: red">{{$message}}</p>@enderror

                    <div class="form-group mb-0">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control col-md-8" id="password" wire:model="passwords.password">
                    </div>
                    @error('password')<p style="color: red">{{$message}}</p>@enderror

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control col-md-8" id="password_confirmation" wire:model="passwords.password_confirmation">
                    </div>

                </div>
                <div class="box-footer">
                    <button class="btn btn-secondary float-right" wire:click="updatePassword">Save</button>
                </div>

            </div>
        </div>
    </div>
</div>

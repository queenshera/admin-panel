<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card-body box-profile">
                    <h4>Profile Information</h4>
                    <p>
                        Update your account's profile information and email address.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box-body">
                    <div class="form-group mb-0">
                        <label for="photo">Photo</label>
                        <br>
                        <img class="profile-user-img img-fluid img-circle" id="userPhoto"
                             src="{{$user['photo']??\Illuminate\Support\Facades\Session::get('photo')}}"
                             alt="User profile picture">
                        @error('photo')<p style="color: red">{{$message}}</p>@enderror
                        <div class="mt-2 mb-2">
                            <input type="file" class="form-control col-md-8" id="photo" accept="image/*" style="display: none" wire:model="photo" />
                            <button id="selectNewPhoto" class="btn btn-default">Select a new photo</button>
                            @if($user['photo'])
                                <button class="btn btn-default" wire:click="deleteProfilePhoto">Remove photo</button>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="name">Name</label>
                        <input type="text" class="form-control col-md-8" id="name" wire:model="user.name">
                    </div>
                    @error('name')<p style="color: red">{{$message}}</p>@enderror

                    <div class="form-group mb-0">
                        <label for="email">Email</label>
                        <input type="email" class="form-control col-md-8" id="email" wire:model="user.email">
                    </div>
                    @error('email')<p style="color: red">{{$message}}</p>@enderror

                    <div class="form-group mb-0">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control col-md-8" id="mobile" wire:model="user.mobile">
                    </div>
                    @error('mobile')<p style="color: red">{{$message}}</p>@enderror

                </div>
                <div class="box-footer">
                    <button class="btn btn-secondary float-right" wire:click="saveProfile">Save</button>
                </div>

            </div>
        </div>
    </div>
</div>

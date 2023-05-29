<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card-body box-profile">
                    <h4>Delete Account</h4>
                    <p>
                        Permanently delete your account.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <p>
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                </p>
                <div class="box-footer">
                    <button class="btn btn-danger" wire:click="confirmAccountDelete">Delete Account</button>
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal" id="modal-account-deletion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Account</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                    </p>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" wire:model.defer="password" wire:keydown.enter="deleteAccountPermanently">
                    <p style="color: red">
                        {{$alert}}
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="deleteAccountPermanently">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('custom-styles')
    @livewireStyles
@endsection

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>
@endsection

@section('content-body')
    @include('layouts.alerts')

    @livewire('update-user-profile')

    @livewire('update-user-password')

    @livewire('logout-other-browser-sessions')
@endsection

@section('custom-scripts')
    @livewireScripts
    <script type="text/javascript">
        $('#selectNewPhoto').click(function () {
            $('#photo').trigger('click');
        });

        $('#photo').change(function () {
            const file = this.files[0];
            console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    console.log(event.target.result);
                    $('#userPhoto').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        window.livewire.on('confirmingLogout', () => {
            $('#modal-default').modal('show');
        });

        window.livewire.on('otherBrowserSessionsRemoved', () => {
            $('#modal-default').modal('hide');
        });

        window.livewire.on('passwordUpdated', () => {
            toastr.success('Your password has been updated successfully');
        });

        window.livewire.on('profileUpdated', () => {
            toastr.success('Your profile has been updated successfully');
        });
    </script>
@endsection

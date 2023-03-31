@extends('layouts.app')

@section('custom-styles')

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
    <div class="card card-default">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" id="userphoto"
                                 src="{{auth()->user()->photo}}"
                                 alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="post" action="{{route('profile.update')}}" id="profileUpdateForm" enctype="multipart/form-data">
                        @include('layouts.alerts')
                        <div class="box-body">
                            <input type="text" name="redirect" value="@if(isset($redirect)){{$redirect}}@endif" hidden>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email ID" value="{{auth()->user()->email}}" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile" value="{{auth()->user()->mobile}}" required >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{auth()->user()->name}}" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter if you want to change">
                            </div>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                    <input type="file" class="custom-file-input" accept="image/*" id="photo" name="photo">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            @csrf
                            <input type="submit" class="btn bg-maroon" value="Update profile"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

@endsection


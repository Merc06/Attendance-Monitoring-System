@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')

    <h1 class="text-center">Account Settings</h1>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <form>
            <div class="form-group">
                <h4 class="text-center">Change E-mail</h4>
                <input type="text" class="form-control" value="{{$user->email}}" placeholder="Current Username">
                <input type="text" class="form-control" id="newUser" placeholder="New Username">
            </div>
            <div class="form-group">
                <h4 class="text-center">Change Password</h4>
                <input type="password" class="form-control" id="currentPass" placeholder="Current Password">
                <input type="password" class="form-control" id="newPass" placeholder="New Password">
            </div>
            <div class="form-group ">
                <input type="submit" name="confirm" value="Confirm" class="btn btn-outline-light btn-block">
            </div>
        </form>
        </div>
        <div class="col-md-4"></div>
    </div>

@endsection
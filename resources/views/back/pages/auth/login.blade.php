@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : "Page Title Here")
@section('content')

<div class="bg-white login-box box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Login </h2>
    </div>
    <form action="{{ route('adminlogin_handler') }}" method="POST">

        <x-form-alerts></x-form-alerts>
        @csrf
        <div class="mb-1 input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Username /Email" name="login_id" value="{{ old('login_id') }}">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        @error('login_id')
        <span class="ml-1 text-danger">{{ $message }}</span>
        @enderror
        <div class="mt-2 mb-1 input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('password')
        <span class="ml-1 text-danger">{{ $message }}</span>
        @enderror
        <div class="row pb-30">
            <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember</label>
                </div>
            </div>
            <div class="col-6">
                <div class="forgot-password">
                    <a href="{{ route('adminforgot') }}">Forgot Password</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-0 input-group">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                </div>

            </div>
        </div>
    </form>
</div>

@endsection

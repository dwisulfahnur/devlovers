@extends('layouts.app')

@section('title', 'Register')

    @section('content')

        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <strong>!!! </strong>{{ $error }}
                </div>
            @endforeach
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Change your password</h1>
        {!! Form::open(['url' => 'change_password', 'method' => 'put', 'enctype' => 'multipart/form-data', 'class' => 'smart-form']) !!}
            <div class="form-group">
                <label for="pwd">Old Password</label>
                <input type="password" class="form-control" id="pwd" name="password">
            </div>

            <div class="form-group">
                <label for="pwd">New Password</label>
                <input type="password" class="form-control" id="pwd" name="new_password">
            </div>

            <div class="form-group">
                <label for="re-pwd">Repeat your new password</label>
                <input type="password" class="form-control" id="re-pwd" name="new_password_confirmation">
            </div>

            {!! Form::submit('Register', ["class"=>"btn btn-default"]) !!}
        {{ Form::close() }}
    @endsection

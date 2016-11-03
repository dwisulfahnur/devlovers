@extends('user.layouts.app')

@section('title', 'Register')

    @section('content')

        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <strong>!!! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        <h1>Register</h1>
        {!! Form::open(['url' => '/register', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label for="image">Profile Picture</label>
                <input name="image" type="file" class="form-control" value="{{ old('image') }}">
            </div>

            <div class="form-group">
                <label for="full_name">Fullname</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old("email") }}">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old("username") }}">
            </div>

            <div class="form-group">
                <label for="pwd">Password</label>
                <input type="password" class="form-control" id="pwd" name="password">
            </div>

            <div class="form-group">
                <label for="re-pwd">Repeat your password</label>
                <input type="password" class="form-control" id="re-pwd" name="password_confirmation">
            </div>

            <div class="form-group">
                <label for="dob">Date of Birthday</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ old("dob") }}">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" id="gender">
                    <option value=1>Male</option>
                    <option value=0>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="roles">Roles:</label>
                <select name="roles" class="form-control" id="roles">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <select name="city" id="city" class="form-control">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            {!! Form::submit('Register', ["class"=>"btn btn-default"]) !!}
        {!! Form::close() !!}
    @endsection
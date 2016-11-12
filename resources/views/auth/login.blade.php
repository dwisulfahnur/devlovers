@extends('layouts.app')

@section('title', 'Login')

    @section('content')
        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <strong>!!! </strong>{{ $error }}
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Login:</h1>
        {!! Form::open(['url' => '/login', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password">
            </div>
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!} Don't have account? <a href="/register">Register</a>
    @endsection

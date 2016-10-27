@extends('user.layouts.app')

@section('title', 'Login')

    @section('content')
        @if ($errors)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1>Browse User</h1>
        <hr/>
        <a href=""><button type="submit" class="btn btn-default">BROWSE</button></a><hr/>

        {!! Form::open(['url' => '/browse_user', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

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
            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    @endsection

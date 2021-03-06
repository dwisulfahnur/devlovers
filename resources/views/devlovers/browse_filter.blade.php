@extends('layouts.app')

@section('title', 'Set Filter Browse')

    @section('content')
        @if ($errors)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Filter</h1>

        {!! Form::open(['url' => 'browse_user', 'method' => 'get', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" id="gender">
                    <option value="">-----SELECT ALL-----</option>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="roles">Roles:</label>
                <select name="roles" class="form-control" id="roles">
                    <option value="">-----SELECT ALL-----</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <select name="city" id="city" class="form-control">
                    <option value="">-----SELECT ALL-----</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        {!! Form::close() !!}
    @endsection

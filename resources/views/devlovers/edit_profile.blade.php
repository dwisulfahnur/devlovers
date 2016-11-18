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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!--div class="col-md-12" style="margin: 0 15px; text-align:center; margin-top:20px;">
        </div-->

        {!! Form::open(['url' => route('edit_profile'), 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">

                <label for="image">Profile Picture </label><br/>
                <img src="{{ route('image', ['profile_picture'=>$user_self->profile_picture ]) }}" width="200px" height="200px"><br/><br/>
                <input name="image" type="file" class="form-control" value="{{ old('image') }}">
                <p class="help-block"><i>(* Keep blank if you will not change)</i></p>
            </div>

            <div class="form-group">
                <label for="full_name">Fullname</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user_self->full_name }}">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user_self->email }}">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user_self->username }}">
            </div>

            <div class="form-group">
                <label for="dob">Date of Birthday</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ $user_self->dob }}">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" id="gender">
                    @if ($user_self-> gender === 1)
                        <option value=1 seected>Male</option>
                        <option value=0>Female</option>
                    @else
                        <option value=1>Male</option>
                        <option value=0 selected>Female</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="roles">Roles:</label>
                <select name="roles" class="form-control" id="roles">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            @if ($user_self->roles_id===$role->id)
                             selected
                            @endif>{{ $role->name }}</option>>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="prog_languages">Programming Languages:</label>
                <select name="programming_languages[]" class="form-control margin" id="prog_languages" multiple="multiple" multiselect="multiselect">
                    @foreach ($programming_languages as $language)
                        <option value="{{ $language->id }}"
                        @if ( in_array($language->id, $user_self->programming_languages) )
                         selected
                        @endif>{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <select name="city" id="city" class="form-control">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"
                            @if ($user_self->city_id===$city->id)
                             selected
                            @endif>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            {!! Form::submit('SAVE', ["class"=>"btn btn-default"]) !!}
        {!! Form::close() !!}
    @endsection

<!DOCTYPE html>
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        @if ($errors)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1>Register:</h1>
        {!! Form::open(['url' => '/register', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            <label>Profile Picture</label>
            {!! Form::file('image') !!}<br/>

            <label>Fullname</label>
            {!! Form::text('full_name'); !!}<br/>
            <label>Email</label>
            {!! Form::text('email'); !!}<br/>
            <label>Username</label>
            {!! Form::text('username'); !!}<br/>
            <label>Password</label>
            {!! Form::password('password'); !!}<br/>
            <label>Date of Birth</label>
            {!! Form::date('dob', \Carbon\Carbon::now()); !!}<br/>
            <label>Gender</label>
            {!! Form::select('gender',[1 => 'Male', 0 => 'Female',]); !!}<br/>

            <label>Roles</label>
            <select name="roles">
                @foreach ($roles as $role)
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
            </select>
            <br/>

            <label>City</label>
            <select name="city">
                @foreach ($cities as $city)
                    <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                @endforeach
            </select>
            <br/>


            {!! Form::submit('Register') !!}

        {!! Form::close() !!}
    </body>
</html>

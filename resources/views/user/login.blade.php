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
        <h1>Login:</h1>
        {!! Form::open(['url' => '/login', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            <label>Email</label>
            {!! Form::text('email'); !!}<br/>

            <label>Password</label>
            {!! Form::password('password'); !!}<br/>

            {!! Form::submit('Login') !!}

        {!! Form::close() !!}
    </body>
</html>

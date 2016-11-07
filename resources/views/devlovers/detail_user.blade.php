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
        <div class="col-md-12" style="margin: 0 15px; text-align:center; margin-top:5px;">
            <img src="{{ route('image', ['profile_picture'=>$user->profile_picture ]) }}" width="250px" height="250px" style="border-radius:50%">
            <div class="card-block" style="size:15">
                <h2>{{ $user->full_name }}</h2>
                <span style="font-size:18">Work as <span style="background-color:rgb(182, 182, 182); border-radius:3px;">"{{ $user->role }}"</span></span><br>
                <h4>Programming Languages:</h4>
                <div class="list-group" style="width: 250px; margin: 0 auto;">
                    @foreach ($user->programming_languages as $language)
                        <span class="list-group-item" style="padding: 4px;">{{ $language->name }}</span>
                    @endforeach
                </div>
                <hr/>
                @if ( $user->username === session('username') )
                    <a href="{{ route('edit_profile') }}" class="btn btn-primary">EDIT PROFILE</a>
                    <a href="{{ route('change_password') }}" class="btn btn-primary">CHANGE PASSWORD</a>
                @else
                    <a href="{{ route('like', ['like'=>'1', 'target'=>$user->id])}}" class="btn btn-primary disable">Like</a>
                    <a href="{{ route('like', ['like'=>'0', 'target'=>$user->id])}}" class="btn btn-primary">Dislike</a>
                @endif
            </div>
            <br>
        </div>
    @endsection

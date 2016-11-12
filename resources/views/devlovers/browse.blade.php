@extends('layouts.app')
@section('title', 'Browse User')

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
        <a href="{{ route('filter_user') }}"><button type="submit" class="btn btn-default">FILTER</button></a><hr/>
        <div class="col-md-12" style="text-align:center;">
        @if ($users)
            @foreach ($users as $user)
                <div class="col-md-2" style="margin: 0 15px">
                    <img class="card-img-top" src="{{ route('image', ['profile_picture'=>$user->profile_picture ]) }}" alt="Card image cap" width="155px" height="155px">
                    <div class="card-block">
                        <a href="{{ route('detail_user', $user->username) }}/"><h4>{{ $user->full_name }}</h4></a>
                        <a href="{{ route('like', ['like'=>'1', 'target'=>$user->id])}}" class="btn btn-primary disable">Like</a>
                        <a href="{{ route('like', ['like'=>'0', 'target'=>$user->id])}}" class="btn btn-primary">Dislike</a>
                    </div>
                    <br>
                </div>
            @endforeach
        @else
            <h1 style="float:center">User Not Found</h1>
        @endif
        </div>
        <div class="col-md-12" style="text-align:center">
            {{ $users->render() }}
        </div>
    @endsection

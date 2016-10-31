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
        <a href="/filter_user"><button type="submit" class="btn btn-default">FILTER</button></a><hr/>
        <div class="col-md-12">
        @if ($users)
            @foreach ($users as $user)
                <div class="col-md-6">
                    <img class="card-img-top" src="{{ $user->profile_picture }}" alt="Card image cap" width="300px" height="300px">
                    <div class="card-block">
                        <h4>{{ $user->full_name }}</h4>
                        <a href="{{ $url }}like=1&target={{ $user->id }}" class="btn btn-primary disable">Like</a>
                        <a href="{{ $url }}like=0&target={{ $user->id }}" class="btn btn-primary">Dislike</a>
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

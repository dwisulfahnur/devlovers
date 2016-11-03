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
        <div class="col-md-12" style="margin: 0 15px; text-align:center; margin-top:20px;">
            <img src="/{{ $user->profile_picture }}" width="300px" height="300px" style="border-radius:50%">
            <div class="card-block" style="size:15">
                <h3>{{ $user->full_name }}</h3>
                <role>{{ $user->role }}</role>,
                <gender>{{ $user->gender }}</gender>,
                <age>{{ $user->age }} Years</age>,
                <city>{{ $user->city }}</city><br/>
                <span>Programming Languages:</span>
                @foreach ($user->programming_languages as $language)
                    {{ $language->name }},
                @endforeach
            <hr/>
                <a href="/like?like=1&target={{ $user->id }}" class="btn btn-primary disable">Like</a>
                <a href="/like?like=0&target={{ $user->id }}" class="btn btn-primary">Dislike</a>
            </div>
            <br>
        </div>



    @endsection

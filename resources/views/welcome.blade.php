@extends('layouts.app')

@section('content')
<header class="header_wrapper" style="background-image:url({{ asset('assets/img/bg-welcome.jpg') }})">
    <div class="container text-center">
        <div class="row h-full">
            <div class="col-12 col-lg-8 offset-lg-2 align-self-center">
                @if(session()->has('success'))
                {{session()->get('success')}}
                @endif
                @if(session()->has('error'))
                {{session()->get('error')}}
                @endif
                <h1 class="display-4 title">BAHDCASTS</h1>
                <h4 class="description">THE BEST WEB DEVELOPMENT SCREENCASTS ON THE INTERNET</h4>
                <br>
                <p><span class="fw-400">bahdcasts</span></p>
                <br>
                <br>
                <br>
                <a href="" class="btn btn-lg btn-primary text-white rounded-full px-4">See button</a>
                <a href="" class="btn btn-lg btn-round w-200 btn-outline rounded-full btn-white text-white px-4">See button</a>
            </div>
        </div>
    </div>
</header>
@endsection

@extends('layouts.app')

@section('header')
<header class="header_titler bg-info text-white py-4">
    <div class="text-center py-4">
        <h1>Create a laracasts series</h1>
        <p>Let's make the world a better place for coders</p>
    </div>
</header>
@endsection

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-6 col-12 offset-md-3 offset-0">
            <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="my-3">
                    <input type="text" name="title" class="form-control" placeholder="Your series title">
                </div>
                <div class="my-3">
                    <input class="form-control" name="image" type="file">
                </div>
                <div class="my-3">
                    <textarea class="form-control" name="description" rows="5"></textarea>
                </div>
                <div class="my-3">
                    <button class="btn btn-primary w-100">CREATE SERIES</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
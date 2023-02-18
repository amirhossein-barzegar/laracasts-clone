@extends('layouts.app')

@section('header')
<header class="header_titler bg-info text-white py-4">
    <div class="text-center py-4">
        <h1>{{ $series->title }}</h1>
        <p>Customize your series lessons</p>
    </div>
</header>
@endsection

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-12">
            <lessons-component series_id="{{ $series->id }}" default_lessons="{{ $series->lessons }}"></lessons-component>
        </div>
    </div>
</div>
@endsection
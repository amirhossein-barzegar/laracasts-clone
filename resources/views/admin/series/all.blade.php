@extends('layouts.app')

@section('header')
<header class="header_titler bg-info text-white py-4">
    <div class="text-center py-4">
        <h1>All series</h1>
        <p>Let's make the world a better place for coders</p>
    </div>
</header>
@endsection

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-6 col-12 offset-md-3 offset-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($series as $s)
                    <tr>
                        <td>{{ $s->title }}</td>
                        <td>
                            <a href="" class="btn btn-info text-white">Edit</a>
                        </td>
                        <td>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                        <td></td>
                    </tr>
                    @empty
                        <p class="text-center">No series yet</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.master')
@section('content')

    <div class="container">
        <h2>edit article</h2>

        <form method="post" action="{{route('profile_update')}}">

            @csrf

            <div class="mb-3">
                <input type="text" class="form-control" id="id" name="id" value="{{$user->id}}" hidden>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">

            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="email" name="email" rows="3">{{$user->email}}</textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>
        </form>
    </div>

@endsection

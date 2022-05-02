@extends('layouts.master')
@include('sections.nav')
@section('content')

    <div class="container">
        <h2>Edit category</h2>
        <form action="{{ route("category_update") }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>
        </form>
    </div>

@endsection

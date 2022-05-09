@extends('layouts.master')
@include('sections.mainnav')
@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class=" card col-md-8 mt-3 bg-grey">
            <h2 class="text-center mb-3">Make comment</h2>
            <form action="{{ route("comment_create") }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="content" class="form-label">Content</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="content" name="content">
                        <input type="text" class="form-control" id="article_id" name="article_id" value="{{$article->id}}" hidden>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection

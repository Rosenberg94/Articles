@extends('layouts.master')
@include('sections.mainnav')
@section('content')

    <div class="class row">
        <div class="col-md-2"></div>
        <div class="card row col-md-8 mt-3 bg-grey">
            <h2 class="text-center mt-3 mb-3">Edit comment</h2>
            <form action="{{ route("comment_update") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="content" class="form-label">Content</label>
                    </div>
                    <div class="mb-3 col-md-8">
                        <input type="text" class="form-control" id="content" name="content" value="{{$comment->content}}">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="id" value="{{$comment->id}}" hidden>
                </div>

                <div class="mb-3 row">
                    <div class=" mb-3 col-md-4">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                    </div>
                    <div class=" mb-3 col-md-8">
                        <input id="image" name="image" type="file" class="form-control" value="{{asset('storage/' . $comment->image)}}">
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection


@extends('layouts.master')
@include('sections.nav')
@section('content')

    <div class="container">
        <h2 class="text-center">{{$article->title}}</h2>
        <div class="row">
            <div class="col-md-2"></div>
            <div class=" card col-md-8">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        @if($article->image)
                            <img src="{{asset($article->image)}}" class="img-fluid rounded-start img-article1" alt="...">
                        @else
                            <img src="{{asset('storage/articles/images/default.jpg')}}" class="img-fluid rounded-start img-article1 w3-image" alt="...">
                        @endif
                    </div>
                    <p class="card-text">{{$article->content}}</p>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <span class="card-text date">{{$article->created_at->format('d-m-Y')}}</span>
                        </div>
                        @if (Route::has('login'))
                        @auth
                        <div class="col-md-3">
                            <a href="{{route('article_edit', ["id" => $article->id])}}" class="btn btn-warning">edit_article</a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('article_delete') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" class="form-control" name="id" value="{{$article->id}}" hidden>
                                <button type="submit" id="delete-task-{{ $article->id }}" class="btn btn-danger" onclick="if( ! confirm('fdsfdsf')){return false;}">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </form>
                        </div>
                        @else
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection


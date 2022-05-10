@extends('layouts.master')
@include('sections.mainnav')
@section('content')

    <div class="container">
        <h2 class="text-center mt-3 txt-clr">{{$article->title}}</h2>
        <div class="row">
            <div class="col-md-2"></div>
            <div class=" card col-md-8 bg-grey mb-3 crd">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        @if($article->image)
                            <img src="{{asset('storage/' . $article->image)}}" class="img-fluid rounded-start img-article1" alt="...">
                        @else
                            <img src="{{asset('storage/images/default.jpg')}}" class="img-fluid rounded-start img-article1 w3-image" alt="...">
                        @endif
                    </div>
                    <p class="card-text mt-3">{{$article->content}}</p>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="card-text date">{{$article->created_at->format('d-m-Y')}}</span>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('main', ["user_id" => $article->user_id])}}">
                                <h6>{{$article->user['name']}}</h6>
                            </a>
                        </div>
                        <div class="col-md-2">
                            @auth
                                @if(auth()->user()->userHasLike($article->id))
                                    <img height="20px" width="20px" src="{{asset('storage/like2.png')}}" />
                                @else
                                    <a href="{{route('like', ["id" => $article->id])}}" class="disabled">
                                        <img height="20px" width="20px" src="{{asset('storage/like2.png')}}" />
                                    </a>
                                @endif
                            @endauth
                            <span> {{count($article->likes)}}</span> </div>
                        @auth
                            <div class="col-md-2">
                                <a href="{{route('comment_create_form', ["id" => $article->id])}}" class="btn btn-info btn-sm">Comment</a>
                            </div>
                            @if(auth()->user()->id == $article->user_id)
                                <div class="col-md-1">
                                    <a href="{{route('article_edit', ["id" => $article->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                                <div class="col-md-2">
                                    <form action="{{route('article_delete') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" name="id" value="{{$article->id}}" hidden>
                                        <button type="submit" id="delete-task-{{ $article->id }}" class="btn btn-danger btn-sm" onclick="if( ! confirm('fdsfdsf')){return false;}">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 card-body">
                <h5 class="text-center"> Comments: </h5>
                @foreach($article->comments as $comment)
                    <div class="card bg-grey mt-1">
                        <div class="card-body row">
                            <div class="col-md-7">
                                <h6>{{$comment->user->name}}</h6>
                                {{$comment->content}}
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">{{$comment->created_at->format('d-m-Y H:i:s')}} </small>
                            </div>
                            @if(auth()->user()->id == $comment->user_id)
                                <div class="col-md-1">
                                    <a href="{{route('comment_edit', ["id" => $comment->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                                <div class="col-md-1">
                                    <form action="{{route('comment_delete') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" name="id" value="{{$comment->id}}" hidden>
                                        <button type="submit" id="delete-task-{{ $comment->id }}" class="btn btn-danger btn-sm" onclick="if( ! confirm('fdsfdsf')){return false;}">
                                            <i class="fa fa-btn fa-trash">Delete</i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="text-center">
                                @if($comment->image)
                                    <img src="{{asset('storage/' . $comment->image)}}" class="img-fluid rounded-start img-cmn" alt="...">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection


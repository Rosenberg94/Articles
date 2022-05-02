@extends('layouts.master')
@include('sections.mainnav')
@section('content')
    <script src="{{asset('js/script.js')}}" ></script>
    @foreach($articles as $article)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="card mt-3 mb-3 col-md-8">
            <div class="row">
                <div class="col-md-4">
                    @if($article->image)
                        <img src="{{asset($article->image)}}" class="img-fluid rounded-start img-article" alt="...">
                    @else
                        <img src="{{asset('storage/articles/images/default.jpg')}}" class="img-fluid rounded-start img-article" alt="...">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$article->title}}</h5>
                        <h6 align="right" class="text-muted" >{{$article->category['name']}}</h6>
                        <p class="card-text">{{$article->content}}</p>
                        <p align="right">
                            <a href="{{route('article_show', ["id" => $article->id])}}" align="right" class="btn btn-outline text-muted">Read more</a>
                        </p>
                        <div class="row">
                            <div class="col-md-4"> <small class="text-muted">{{$article->created_at->format('d-m-Y')}}</small></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><h6>{{$article->user->name}}</h6></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    @endforeach
{{--    {{$articles->links()}}--}}
@endsection



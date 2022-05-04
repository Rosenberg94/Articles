@extends('layouts.master')
@include('sections.mainnav')
@section('content')
    <script src="{{asset('js/script.js')}}" ></script>
    @foreach($articles as $article)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="card mt-3 mb-3 col-md-8">
            <div class="row">
                <div class="col-md-4 bg-grey text-center">
                    @if($article->image)
                        <img src="{{asset('storage/' . $article->image)}}" class="img-fluid rounded-start img-article" alt="...">
                    @else
                        <img src="{{asset('storage/images/default.jpg')}}" class="img-fluid rounded-start img-article" alt="...">
                    @endif
                </div>
                <div class="col-md-8 bg-grey">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{$article->title}}</h5>
                        <a href="{{route('main', ["category_id" => $article->category_id])}}">
                            <h6 align="right" class="text-muted cat-color" >{{$article->category['name']}}</h6>
                        </a>
                        <a href="{{route('article_show', ["id" => $article->id])}}">
                            <p class="card-text bg-grey mb-3" >{{substr($article->content, 0, 140)}}...</p>
                        </a>
                        <div class="row">
                            <div class="col-md-4"> <small class="text-muted">{{$article->created_at->format('d-m-Y')}}</small></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-6 author"><h6>{{$article->user['name']}}</h6></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    @endforeach
@endsection



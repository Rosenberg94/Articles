@extends('layouts.master')
@include('sections.nav')
@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <h2 class="text-center mb-3">Categories list</h2>
        @foreach($categories as $category)
            <div class="card mb-3 mt-3">
                <div class="row mt-3">
                    <div class="col-md-8">
                        <h5 class="text-center" >{{$category->name}}</h5>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('category_edit', ["id" => $category->id])}}" class="btn btn-warning">Edit</a>
                    </div>
                    <div class="col-md-2">
                        <form action="{{route('category_delete') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="" name="id" value="{{$category->id}}" hidden>
                            <button type="submit" id="delete-task-{{ $category->id }}" class="btn btn-danger" onclick="if( ! confirm('????')){return false;}">
                                <i class="fa fa-btn fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection

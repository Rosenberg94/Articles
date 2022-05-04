@extends('layouts.master')
@include('sections.mainnav')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 mt-2">
        <h2 class="text-center">Categories list</h2>
        @foreach($categories as $category)
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <h4 class="text-center">
                            {{$category->name}}
                        </h4>
                    </button>
                    <ul class="dropdown-menu w-10" aria-labelledby="dropdownMenuButton1" style="width: 70px !important; min-width: 70px; max-width: 70px;">
                        <li>
                            <a href="{{route('category_edit', ["id" => $category->id])}}" class="btn btn-warning btn-sm text-center">Edit</a>
                        </li>
                        <li>
                            <form action="{{route('category_delete') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" class="" name="id" value="{{$category->id}}" hidden>
                                <button type="submit" id="delete-task-{{ $category->id }}" class="btn btn-danger btn-sm" onclick="if( ! confirm('????')){return false;}">
                                    <i class="fa fa-btn fa-trash">Delete</i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <br>
        @endforeach
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection

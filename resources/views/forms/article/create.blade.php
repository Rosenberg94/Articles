@extends('layouts.master')
@include('sections.mainnav')
@section('content')
    <div class="row justify-content-center">
        <div class=" card col-md-7">
            <h2 class="text-center mt-3 mb-3" >Create article</h2>
            <form action="{{ route("article_create") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="category_id" class="form-label">Category</label>
                    </div>
                    <div class="col-md-7">
                        <select class="form-select" name="category_id" aria-label="Category choose">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="title" class="form-label">Title</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="title" name="title" placeholder="title">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="content" class="form-label">Content</label>
                    </div>
                    <div class="col-md-7">
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                    </div>
                    <div class="col-md-7">
                        <input id="image" name="image" type="file" class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button class="btn btn-primary text-center" type="submit">Create</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
        </div>
    </div>

@endsection


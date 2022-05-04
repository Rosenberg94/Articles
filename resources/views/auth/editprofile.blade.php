@extends('layouts.master')
@section('content')





    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header" align="center">
                        <h3>Edit profile</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('profile_update')}}">
                            @csrf
                            <input type="text" class="form-control" id="id" name="id" value="{{$user->id}}" hidden>
                            <div class="form-group row mt-3">
                                <label for="name"  class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-7">
                                    <input id="ename" class="form-control" type="text" name="name" placeholder="name" value="{{$user->name}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="email"  class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="email" name="email" rows="3">{{$user->email}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-7">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>










@endsection

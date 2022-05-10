@extends('layouts.master')
@extends('sections.mainnav')
@section('content')

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-dark-grey" align="center">
                        <h3>Profile</h3>
                    </div>
                    @php($user = auth()->user())
                    <div class="card-body bg-grey">
                            <div class="form-group row mt-3">
                                <label for="name"  class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-7">
                                    <h4>{{$user->name}}</h4>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="email"  class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-7">
                                    <h4>{{$user->email}}</h4>
                                </div>
                            </div>
                        <div class="form-group row mt-3">
                            <div class="text-center">
                                <a class="btn btn-success" href="{{ route( 'profile_edit', ['id' => auth()->user()->id])}}" role="button">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@extends('layouts.master')
@extends('sections.mainnav')
@section('content')

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    @if($weather_data['status'])
                    <div class="card-header bg-dark-grey" align="center">
                        <h4>Weather in Bucharest</h4>
                    </div>
                    <div class="card-body bg-grey">
                        <div class="form-group row mt-1">
                            <label for="name"  class="col-md-7 col-form-label text-md-right">Current weather:</label>
                            <div class="col-md-5">
                                <h4>{{$weather_data['weather']}}</h4>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="name"  class="col-md-7 col-form-label text-md-right">Temperature:</label>
                            <div class="col-md-5">
                                <h4>{{$weather_data['temp']}} C</h4>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="name"  class="col-md-7 col-form-label text-md-right">Humidity:</label>
                            <div class="col-md-5">
                                <h4>{{$weather_data['humidity']}} %</h4>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="name"  class="col-md-7 col-form-label text-md-right">Windspeed:</label>
                            <div class="col-md-5">
                                <h4>{{$weather_data['wind']}} m/s</h4>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="form-group row mt-3">
                            <label for="name"  class="col-md-12 col-form-label text-md-right">{{$weather_data['error']}}</label>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-dark-grey" align="center">
                        <h4>Profile</h4>
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


@extends('layouts.master')
@include('sections.mainnav')
@section('content')

    <div class="cotainer mt-3">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-dark-grey" align="center">
                        <h3>Registration</h3>
                    </div>
                    <div class="card-body bg-grey">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mt-3">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-7">
                                    <input id="name" class="form-control" type="text" pattern="^[a-zA-Z\s]+$"  name="name" placeholder="name" :value="old('name')" required autofocus />
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-7">
                                    <input id="email" class="form-control" type="email" name="email" placeholder="email" :value="old('email')" required />
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Create password</label>
                                <div class="col-md-7">
                                    <input id="password" class="form-control"
                                           type="password"
                                           name="password"
                                           required autocomplete="new-password" />
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Confirm password</label>
                                <div class="col-md-7">
                                    <input id="password_confirmation" class="form-control"
                                           type="password"
                                           name="password_confirmation" required />
                                </div>
                            </div>
                            <div class="cotainer mt-3">
                                <div class="md-4" align="center">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered?   ') }}
                                    </a>
                                    <button class="md-4">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>





























@endsection

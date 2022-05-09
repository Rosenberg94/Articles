@extends('layouts.master')
@include('sections.mainnav')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header" align="center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row mt-3">
                                <label for="email"  class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-7">
                                    <input id="email" class="form-control" type="email" name="email" placeholder="email" :value="old('email')" required />
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="password"  class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-7">
                                    <input id="password" class="form-control"
                                           type="password"
                                           name="password"
                                           required autocomplete="current-password" />
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-7">
                                    <button class="btn btn-outline-primary mb-3">
                                        {{ __('Log in') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


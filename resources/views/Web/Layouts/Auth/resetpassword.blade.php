@extends('Web.Layouts.app')
@section('title', 'New Password')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    <div class="container">
        <div class="col-md-12 col-md-offset-4">
            <div class="panel panel-default"
                style="position: relative;margin-top:15%;border:1px solid grey;box-shadow: 7px 7px 10px;">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fas fa-lock-open fa-4x"></i></h3>
                        <h2 class="text-center">New Password</h2>
                        <p>Please Enter Your New Password Now</p>
                        <div class="panel-body">
                            <form class="form" method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <fieldset>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-envelope color-blue"></i>
                                            </span>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                                readonly>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-envelope color-blue"></i>
                                            </span>
                                            <input id="passwordInput" placeholder="Password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password" type="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-envelope color-blue"></i>
                                            </span>
                                            <input id="passwordInput" placeholder="Password Confirm" class="form-control"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-lg btn-primary btn-block" value="Reset Password"
                                            type="submit">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('Web.Layouts.app')
@section('title', 'Forget Password')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    <div class="container">
        <div class="col-md-12 col-md-offset-4">
            <div class="panel panel-default"
                style="position: relative;margin-top:15%;border:1px solid grey;box-shadow: 7px 7px 10px;">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="emailInput" placeholder="email address" class="form-control"
                                                type="email" name="email"
                                                oninvalid="setCustomValidity('Please enter a valid email address!')"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-lg btn-primary btn-block" value="Send My Password"
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

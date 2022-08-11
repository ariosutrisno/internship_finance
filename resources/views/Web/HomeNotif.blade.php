@extends('Web.Layouts.app')
@section('title', 'Good Luck!')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    <div class="container">
        <div class="row justify-content-center" style="position: relative;margin-top:15%;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: blue;color:black;font-weight:bold">{{ __('Dashboard') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('Change Password Has Successfully Returned Home') }} <br>
                    </div>
                    <button class="btn btn-primary btn-lg btn-radius go"><i class="fa fa-angle-double-left"
                            style="color:red"></i> To Home</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.go').click(function() {
            window.location.href = '{{ route('index_dashboard') }}'
        })
    </script>
@endsection

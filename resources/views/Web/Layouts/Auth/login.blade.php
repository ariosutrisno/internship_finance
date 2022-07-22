@extends('Web.Layouts.app')
@section('title', 'Login')
@section('container')
    @include('Web.Layouts.css&js.csslog')
    <div class="sidenav">
        <div class="login-main-text">
            <div class="text-center">
                <img src="frontend/img/Group 442.png" alt="#">

                <h2 class="pt-5">First Login</h2>

                <p class="center" style="font-size: 20px">Login Terlebih Dahulu Sebelum Masuk ke Alan Finance</p>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="col-md-8  ml-auto mr-auto">
            <div class=" login-form " style="padding-top: 30px !important;">
                <form id="form-login">
                    @csrf
                    <div class="form-group">
                        <label>E-Mail</label>
                        <input type="text" id="email" class="form-control" placeholder="User Name" name="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password"
                            required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck" style="font-size:12px">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <button type="button" class="float-lg-right tombol btn">{{ __('Login') }}</button>
                </form>

            </div>

        </div>
        <p class="text-center " style="padding-top: 80px;">Don't have an account? <a href="{{ url('/register') }}"
                class="font-weight-bold">Free
                Register</a></p>

        <div class=" justify-content-center" style="bottom:0 ;margin-top:120px">
            <ul class="list-inline text-center text-dark" style="font-size:12px">
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark"
                        href="{{ url('home') }}">Home</a>
                </li>
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" href="#">About</a></li>
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" href="#">Terms of Service
                </li>
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" href="#">Privacy Policy
                </li>
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" href="#">FAQ
                </li>

                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" href="#">Feedback
                </li>

                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" href="#">Blog
                </li>
            </ul>
            <ul class="list-inline text-center" style="font-size:12px">
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" target="_blank"
                        href="#">Downloads App</a></li>
                <li class="list-inline-item"><a class="social-icon text-xs-center text-dark" target="_blank"
                        href="#">Downloads ios</a></li>

            </ul>
            <p class="text-center" style="font-size:12px">Alan Finance © 2020 PT. Alan
                Creative
                - All Rights Reserved</p>

        </div>
    </div>
    <script>
        $('.tombol').on('click', function() {
            // console.log($(this).data('id'))
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var token = $("meta[name='csrf-token']").attr("content");
            let FormData = $('#form-login').serialize()
            if (email == '' || password == '') {
                Swal.fire({
                    title: '<strong>Login Failed</u></strong>',
                    icon: 'error',
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: ' Oke',
                })
            } else {
                // AJAX
                $.ajax({
                    url: '{{ route('login') }}',
                    method: "POST",
                    data: FormData,
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                    title: '<strong>Login Succes</strong>',
                                    icon: 'success',
                                    timer: 3000,
                                    focusConfirm: false,
                                    showConfirmButton: false,
                                })
                                .then(function() {
                                    window.location.href = "{{ route('index_dashboard') }}";
                                });

                        } else {
                            Swal.fire({
                                title: '<strong>Login Failed</u></strong>',
                                icon: 'error',
                                showCloseButton: true,
                                focusConfirm: false,
                                confirmButtonText: ' Oke',
                            })
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            timer: 3000,
                            showConfirmButton: false,
                            text: 'Email Dan Password error, Tolong Check Kembali!'
                        });
                    }
                })
            }
        })
    </script>

@endsection

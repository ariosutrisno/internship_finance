@extends('Web.Layouts.app')
@section('title', 'Akun')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full">
        <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
            @include('Web.Dashboard.sidedashboard')
            <div class="page-wrapper">
                <div class="container-fluid">
                    <!-- *************************************************************** -->
                    <!-- Start First Cards -->
                    <!-- *************************************************************** -->
                    <div class="container-fluid">
                        <!-- *************************************************************** -->
                        <!-- Start First Cards -->
                        <!-- *************************************************************** -->
                        <div class="container">
                            <form id="formUpdate" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-1 mt-1" style="z-index:1">
                                                        <img src="{{ asset('frontend/img/man-1.png') }}" width="75px"
                                                            height="75px" class="rounded-circle" alt="profile"
                                                            id="profile">
                                                    </div>
                                                    <div style="z-index:2">
                                                        <img src="{{ asset('frontend/imgNew/pensil.png') }}" width="30px"
                                                            height="30px" alt="pensil"
                                                            style="position: absolute; bottom:0.5px" id="pencil">
                                                        <input type="file" id="FileUpload1" style="display: none" />
                                                    </div>
                                                    <div class="col-sm-10 ml-4">
                                                        <span class="h1 text-cyan"><strong> Akun </strong></span>
                                                        <br><span>{{ ucwords($id->name) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <li style="list-style-type: none;">
                                                    <button class="btn float-right"><i
                                                            data-feather="file-text"></i></button><br>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akun Saya -->
                                <div class="container">
                                    <div class="row">
                                        <div class="card col-lg-12 mt-4">
                                            <div class="card-body">
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="Input_nama_lengkap"
                                                                class="text-dark col-sm-5 col-form-label">Nama
                                                                Lengkap</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class=" form-control"
                                                                    id="Input_nama_lengkap" name="nama_asli"
                                                                    value="{{ $id->name }}">
                                                                <span style="color: red;font-size:12px"
                                                                    id="Textnama"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email"
                                                                class="text-dark col-sm-5 col-form-label">Email</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" name="email" class=" form-control"
                                                                    id="email" value="{{ $id->email }}">
                                                                <span class="text-justify " id="Textemail"
                                                                    style="color: red;font-size:12px;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="telp"
                                                                class="col-sm-5 text-dark col-form-label">Telepon</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name="telepon" class="form-control"
                                                                    id="input_telepon" value="{{ $id->phone_users }}">
                                                                <span class="text-justify "
                                                                    style="color: red;font-size:12px;"
                                                                    id="Texttelepon"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="telp"
                                                                class="col-sm-5 text-dark col-form-label">Jenis
                                                                Kelamin</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name="jk_users"
                                                                    value="{{ $id->jk_users }}" class="form-control jk"
                                                                    id="Kelamin">
                                                                <span class="text-justify jk" id="Textjk"
                                                                    style="color: red;font-size:12px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Form Kanan -->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="password"
                                                                class="text-dark col-sm-5 col-form-label">Change
                                                                Password</label>
                                                            <div class="col-sm-7">
                                                                <input type="password" name="pwNew"
                                                                    class=" form-control pwchange" id="password">
                                                                <span class="text-justify Textpwchange" id="Textpwchange"
                                                                    style="color: red;font-size:12px;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="repassword"
                                                                class="text-dark col-sm-5 col-form-label">Ulangi
                                                                Password</label>
                                                            <div class="col-sm-7">
                                                                <input type="password" name="pwNewConfirm"
                                                                    class=" form-control" id="repassword">
                                                                <span class="text-justify " id="TextpwConfirm"
                                                                    style="color: red;font-size:12px;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="company"
                                                                class="text-dark col-sm-5 col-form-label">Tanggal
                                                                Daftar</label>
                                                            <div class="col-sm-7">
                                                                <span class="text-dark">:
                                                                    {{ \Carbon\Carbon::parse($id->created_at)->locale('id')->isoformat('DD MMMM Y') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="company"
                                                                class="text-dark col-sm-5 col-form-label">Aktifitas
                                                                Terakhir</label>
                                                            <div class="col-sm-7">
                                                                <span>:
                                                                    <span class="text-danger" style="font-weight: bold">
                                                                        {{ \Carbon\Carbon::now()->locale('id')->isoformat('DD MMMM Y') }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="btn-group btn-group-toggle col-sm-5">
                                                                <button type="button"
                                                                    class="btn btn-outline-danger cancel">Cancel</button>
                                                                <button type="button"
                                                                    class="btn btn-outline-success update">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Akun Saya -->
                    </div>
                    <script>
                        $('.cancel').click(function() {
                            window.location.href = '{{ route('view_user') }}'
                        })
                        window.onload = function() {
                            var fileupload = document.getElementById("FileUpload1");
                            var coverPreview = document.getElementById("profile");
                            var image = document.getElementById("pencil");
                            image.onclick = function() {
                                fileupload.click();
                            };
                            fileupload.addEventListener("change", _ => {
                                let file = fileupload.files[0];
                                let reader = new FileReader();
                                reader.onload = function() {
                                    coverPreview.src = reader.result;
                                }
                                reader.readAsDataURL(file);
                            });
                        };
                        /* UPDATE AKUN */
                        $('.update').on('click', function() {
                            let formUser = $('#formUpdate').serialize()
                            $.ajax({
                                url: '{{ route('update_user', ['id_user' => $id->id]) }}',
                                method: 'PATCH',
                                data: formUser,
                                success: function(data) {
                                    if (data.success) {
                                        window.location.href = '{{ route('view_user') }}';
                                        Swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 5000
                                            })
                                            .fire({
                                                type: 'success',
                                                title: 'Akun Anda berhasil Di Update'
                                            })
                                    }
                                },
                                error: function(error) {
                                    // NAMA LENGKAP
                                    if ($('#Input_nama_lengkap').val() == '') {
                                        $('#Input_nama_lengkap').css('border-color', 'red')
                                        $('#Textnama').text('Nama Tidak Boleh Kosong').css('display', 'block').css(
                                            'color', 'red')
                                    } else {
                                        $('#Input_nama_lengkap').css('border-color', 'green')
                                        $('#Textnama').text('Data Telah Diisi').css('color', 'green')
                                    }
                                    // EMAIL
                                    if ($('#email').val() == '') {
                                        $('#email').css('border-color', 'red')
                                        $('#Textemail').text('Email Tidak Boleh Kosong').css('display', 'block').css(
                                            'color', 'red')
                                    } else {
                                        $('#email').css('border-color', 'green')
                                        $('#Textemail').text('Data Telah Diisi').css('color', 'green')
                                    }
                                    // TELEPON
                                    if ($('#input_telepon').val() == '') {
                                        $('#input_telepon').css('border-color', 'red')
                                        $('#Texttelepon').text('Telepon Tidak Boleh Kosong').css('display', 'block')
                                            .css(
                                                'color', 'red')
                                    } else {
                                        $('#input_telepon').css('border-color', 'green')
                                        $('#Texttelepon').text('Data Telah Diisi').css('color', 'green')
                                    }
                                    // JENIS KELAMIN
                                    if ($('#Kelamin').val() == '') {
                                        $('#Kelamin').css('border-color', 'red')
                                        $('#Textjk').text('Jenis Kelamin Tidak Boleh Kosong').css('display', 'block')
                                            .css(
                                                'color', 'red')
                                    } else {
                                        $('#Kelamin').css('border-color', 'green')
                                        $('#Textjk').text('Data Telah Diisi').css('color', 'green')
                                    }
                                    // CHANGE PASSWORD
                                    if ($('#password').val() == '') {
                                        $('#password').css('border-color', 'red')
                                        $('#Textpwchange').text('Password Tidak Boleh Kosong').css('display', 'block')
                                            .css(
                                                'color', 'red')
                                    } else {
                                        $('#password').css('border-color', 'green')
                                        $('#Textpwchange').text('Data Telah Diisi').css('color', 'green')
                                    }
                                    // ULANGI PASSWORD
                                    if ($('#repassword').val() == '') {
                                        $('#repassword').css('border-color', 'red')
                                        $('#TextpwConfirm').text('Password Confirm Tidak Boleh Kosong').css('display',
                                            'block').css(
                                            'color', 'red')
                                    } else {
                                        $('#repassword').css('border-color', 'green')
                                        $('#TextpwConfirm').text('Data Telah Diisi').css('color', 'green')
                                    }
                                }
                            })
                        })
                        /* UPDATE AKUN END */
                    </script>
                @endsection

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
                            <form method="POST" action="{{ route('update_user', $id->id) }}" enctype="multipart/form-data">
                                {!! method_field('PUT') !!}
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
                                                            <label for="nama_lengkap"
                                                                class="text-dark col-sm-5 col-form-label">Nama
                                                                Lengkap</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class=" form-control"
                                                                    id="nama_lengkap" name="nama_lengkap"
                                                                    value="{{ $id->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email"
                                                                class="text-dark col-sm-5 col-form-label">Email</label>
                                                            <div class="col-sm-7">
                                                                <input type="email" name="email" class=" form-control"
                                                                    id="email" value="{{ $id->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="telp"
                                                                class="col-sm-5 text-dark col-form-label">Telepon</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name="telepon" class="form-control"
                                                                    id="Telpon">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="telp"
                                                                class="col-sm-5 text-dark col-form-label">Jenis
                                                                Kelamin</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name="jk" class="form-control"
                                                                    id="Kelamin">
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
                                                                <input type="password" name="pwNew" class=" form-control"
                                                                    id="password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="repassword"
                                                                class="text-dark col-sm-5 col-form-label">Ulangi
                                                                Password</label>
                                                            <div class="col-sm-7">
                                                                <input type="password" name="pwNewConfirm"
                                                                    class=" form-control" id="repassword">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </script>
@endsection

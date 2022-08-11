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
                            <form id="formUpdate" enctype='multipart/form-data'>
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-sm-1 mt-1" style="z-index:1">
                                                        @if (!$id->img_users)
                                                            <img src="{{ asset('frontend/imgNew/blank_profile.png') }}"
                                                                alt="user" class="rounded-circle" width="75px"
                                                                id="profile" height="75px" />
                                                        @else
                                                            <img src="{{ asset('storage/storage/' . $id->img_users) }}"
                                                                class="rounded-circle" alt="profile" width="75px"
                                                                id="profile" height="75px">
                                                        @endif
                                                    </div>
                                                    <div style="z-index:2">
                                                        <img src="{{ asset('frontend/imgNew/pensil.png') }}" width="30px"
                                                            height="30px" alt="pensil"
                                                            style="position: absolute; bottom:0.5px" id="pencil">
                                                        <input type="file" id="FileUpload" style="display: none"
                                                            name="img" />
                                                    </div>
                                                    <div class="col-sm-10 ml-4">
                                                        <span class="h1 text-cyan"><strong> Akun </strong></span>
                                                        <br><span>{{ ucwords($id->name) }}</span>
                                                        {{-- <br><input type="file" name="newIMG" id="foto1"> --}}

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
                        /* UNGGAH FOTO */
                        var image = document.getElementById("pencil");
                        var File = document.getElementById("FileUpload");
                        image.onclick = function() {
                            File.click()
                        };
                        File.onchange = evt => {
                            const [file] = FileUpload.files
                            if (file) {
                                profile.src = URL.createObjectURL(file)
                            }
                        }
                        /* UPDATE AKUN */
                        // Open connection
                        $('.update').on('click', function() {
                            var form = $('#formUpdate')[0];
                            var formdata = new FormData(form);
                            $.ajax({
                                url: '{{ route('update_user', ['id_user' => $id->id]) }}',
                                method: 'POST',
                                data: formdata,
                                dataType: 'json',
                                contentType: false,
                                processData: false,
                                async: false,
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                },
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
                                    toastr.error('Tolong Periksa Kembali Akun anda atau referesh halaman tersebut')
                                }
                            })
                        })
                        /* UPDATE AKUN END */
                    </script>
                @endsection

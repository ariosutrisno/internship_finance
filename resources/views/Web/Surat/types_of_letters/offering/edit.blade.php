@extends('Web.Layouts.app')
@section('title', 'View Offeing Letter')
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
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-sm-1 mt-1">
                                                <img src="{{ asset('frontend/img/Page-1.png') }}" alt="Hutang">
                                            </div>
                                            <div class="col-sm-10 ml-3">
                                                <span class="h1 text-cyan"><strong> Offering Letter </strong></span>
                                                <br><span>buat surat dan berikan kepada orang lain</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('update_OfferingLetter', $id_offering->id_letter) }}"
                                    method="POST">
                                    @csrf
                                    @if ($id_offering->letter_peruntukan == 'Internship')
                                        <div class="form-row" id="hiddenNosurat">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">No Surat</label>
                                                <input id="txt1" type="text" class="form-control"
                                                    id="inputAddress"name="nomor_surat"
                                                    value="{{ $id_offering->nomor_surat }}" readonly>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nama">Nama</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('letter_nama') ? ' is-invalid' : '' }}"
                                                id="nama" placeholder="Nama" name="letter_nama"
                                                value="{{ $id_offering->letter_nama }}">
                                            @if ($errors->has('letter_nama'))
                                                <span class="text-danger">{{ $errors->first('letter_nama') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control {{ $errors->has('letter_nama') ? ' is-invalid' : '' }}"
                                                id="email" placeholder="email" name="letter_email"
                                                value="{{ $id_offering->letter_email }}">
                                            @if ($errors->has('letter_email'))
                                                <span class="text-danger">{{ $errors->first('letter_email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Telepon</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('letter_telepon') ? ' is-invalid' : '' }}"
                                                id="inputAddress" placeholder="Telepon" name="letter_telepon"
                                                value="{{ $id_offering->letter_telepon }}">
                                            @if ($errors->has('letter_telepon'))
                                                <span class="text-danger">{{ $errors->first('letter_telepon') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Address</label>
                                            <textarea type="text" class="form-control {{ $errors->has('letter_alamat') ? ' is-invalid' : '' }}"
                                                id="inputAddress" placeholder="1234 Main St" name="letter_alamat">{{ $id_offering->letter_alamat }}</textarea>
                                            @if ($errors->has('letter_alamat'))
                                                <span class="text-danger">{{ $errors->first('letter_alamat') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputAddress">Peruntukan</label>
                                            @if ($id_offering->letter_peruntukan == 'Intership')
                                                <input type="text" class="form-control" id="inputAddress"
                                                    name="letter_peruntukan" placeholder=""
                                                    value="{{ $id_offering->letter_peruntukan }}" readonly>
                                            @else
                                                <input type="text" class="form-control" id="inputAddress"
                                                    name="letter_peruntukan" placeholder=""
                                                    value="{{ $id_offering->letter_peruntukan }}" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div id="mol" class="form-group col-md-12">
                                            <label for="inputAddress">Tanggal Lamar</label>
                                            <input type="date"
                                                class="form-control {{ $errors->has('tgl_lamar') ? ' is-invalid' : '' }}"
                                                id="inputAddress" placeholder="" name="tgl_lamar"
                                                value="{{ Carbon\Carbon::parse($id_offering->created_at)->format('Y-m-d') }}">
                                            @if ($errors->has('tgl_lamar'))
                                                <span class="text-danger">{{ $errors->first('tgl_lamar') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        @if ($id_offering->letter_peruntukan == 'Internship')
                                            <div id="mol" class="form-group col-md-6">
                                                <label for="inputAddress">Tanggal Mulai</label>
                                                <input type="date" class="form-control"
                                                    id="inputAddress"name="tgl_mulai"
                                                    value="{{ Carbon\Carbon::parse($id_offering->letter_date_mulai)->format('Y-m-d') }}">
                                                @if ($errors->has('tgl_mulai'))
                                                    <span class="text-danger">{{ $errors->first('tgl_mulai') }}</span>
                                                @endif
                                            </div>

                                            <div id="tanggal_selesai" class="form-group col-md-6">
                                                <label for="inputAddress">Tanggal Selesai</label>
                                                <input type="date" class="form-control" id="inputAddress"
                                                    placeholder="" name="tgl_selesai"
                                                    value="{{ Carbon\Carbon::parse($id_offering->letter_date_selesai)->format('Y-m-d') }}">
                                                @if ($errors->has('tgl_selesai'))
                                                    <span class="text-danger">{{ $errors->first('tgl_selesai') }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <div id="mol" class="form-group col-md-12">
                                                <label for="inputAddress">Tanggal Mulai</label>
                                                <input type="date" class="form-control" id="inputAddress"
                                                    name="tgl_mulai"
                                                    value="{{ Carbon\Carbon::parse($id_offering->letter_date_mulai)->format('Y-m-d') }}">
                                                @if ($errors->has('tgl_mulai'))
                                                    <span class="text-danger">{{ $errors->first('tgl_mulai') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Jam Mulai</label>
                                            <input type="time" class="form-control" id="inputAddress" placeholder=""
                                                name="jam_mulai_kerja"
                                                value="{{ Carbon\Carbon::parse($id_offering->letter_date_mulai)->format('H:i') }}">
                                            @if ($errors->has('jam_mulai_kerja'))
                                                <span class="text-danger">{{ $errors->first('jam_mulai_kerja') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Jam Selesai</label>
                                            <input type="time" class="form-control" id="inputAddress" placeholder=""
                                                name="jam_selesai_kerja"
                                                value="{{ Carbon\Carbon::parse($id_offering->letter_date_selesai)->format('H:i') }}">
                                            @if ($errors->has('jam_selesai_kerja'))
                                                <span
                                                    class="text-danger">{{ $errors->first('jam_selesai_kerja') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            @if ($id_offering->letter_peruntukan == 'Internship')
                                                <label id="narahubung" for="inputAddress">Nama Pembimbing</label>
                                            @else
                                                <label id="narahubung" for="inputAddress">Narahubung</label>
                                            @endif
                                            <input type="text"
                                                class="form-control {{ $errors->has('letter_narahubung') ? ' is-invalid' : '' }}"
                                                id="inputAddress" name="letter_narahubung"
                                                value="{{ $id_offering->letter_pembimbing }}">
                                            @if ($errors->has('letter_narahubung'))
                                                <span
                                                    class="text-danger">{{ $errors->first('letter_narahubung') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Telepon</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('telepon_pembimbing') ? ' is-invalid' : '' }}"
                                                id="inputAddress" placeholder="Telepon Pembimbing/Narahubung"
                                                name="telepon_pembimbing"
                                                value="{{ $id_offering->letter_telepon_pembimbing }}">
                                            @if ($errors->has('telepon_pembimbing'))
                                                <span
                                                    class="text-danger">{{ $errors->first('telepon_pembimbing') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="float-md-right">
                                        <a href="{{ route('index_OfferingLetter') }}"
                                            class="btn btn-danger  ml-5">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@extends('Web.Layouts.app')
@section('title', 'Buat data pelanggan')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" <div
        id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
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
                                            <img src="{{ asset('frontend/img/Page-1.png') }}" alt="images">
                                        </div>
                                        <div class="col-sm-10 ml-3">
                                            <span class="h1 text-cyan"><strong> Daftar Pelanggan </strong></span>
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

                            <form action="{{ route('save_Customer') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama"
                                            name="name_customer">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="email"
                                            name="email_customer">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tlp">Telepon</label>
                                        <input type="text" class="form-control" id="tlp" placeholder=""
                                            name="phone_customer"></input>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="perusahaana">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="perusahaana" placeholder=""
                                            name="company_customer"></input>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="perusahaan">Alamat Perusahaan</label>
                                        <textarea type="text" id="perusahaan" class="form-control" name="address_company_customer"></textarea>
                                    </div>
                                </div>
                                <div class="float-md-right">
                                    <a href="{{ route('index_Customer') }}" class="btn btn-danger  ml-5">Cancel</a>
                                    <button type="submit" class="btn btn-primary ">Data Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div> <!-- Script JS -->
    </div>
@endsection

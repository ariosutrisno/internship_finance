@extends('Web.Layouts.app')
@section('title', 'Buku Kas')
@section('container')
    @include('Web.Layouts.css&js.cssdashboard')
    @include('Web.Layouts.css&js.css')
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-la yout="full">

        @include('Web.Dashboard.sidedashboard')

        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-1 mt-1">
                                        <img src="{{ asset('frontend/img/Page-1.png') }}" alt="Buku">
                                    </div>
                                    <div class="col-sm-10 ml-4">
                                        <span class="h1 text-cyan"><strong> Buku Kas </strong></span>
                                        <br><span>Semua Buku Kas yang dimiliki</span>
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
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-10 ml-4">
                                        <a href="{{ route('create_BukuKas') }}"
                                            class=" btn btn-sm bg-success nav-link text-white tombol" style="width: 200px;">
                                            <i class="fa fa-plus pr-3" aria-hidden="true"></i> Tambah Buku Kas
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card " style="heigh=100% !important">
                    <div class="card-body">
                        <div class="row">
                            @if (count($all_cash_book) != 0)
                                @foreach ($all_cash_book as $sidebar)
                                    <div class="col-md-3">
                                        <div class="card  "
                                            style="min-height: 50px  !important; max-height:150px !important; min-width:50px !important">
                                            <div class="card-body text-center">
                                                <a href="{{ url('/book', [$sidebar->id_kas]) }}">
                                                    <img class="card-img-top mt-1 mb-1"
                                                        src="{{ asset('frontend/img/Page-1.png') }}"
                                                        style="max-height: 75px !important; max-width: 75px !important;"
                                                        alt="Card image cap">
                                                    <p class="font-weigth-bold">
                                                        <strong>{{ ucwords($sidebar->nama_buku_kas) }}
                                                        </strong>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak Ada Aktifitas</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

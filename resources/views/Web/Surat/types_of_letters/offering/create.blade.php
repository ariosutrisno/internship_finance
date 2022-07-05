@extends('Web.Layouts.app')
@section('title', 'Offering Letter')
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
                                            <img src="{{ asset('frontend/img/bill.png') }}" alt="Offering">
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
                            <form action="{{ route('post_OfferingLetter') }}" method="POST">
                                @csrf
                                <div class="form-row" id="hiddenNosurat" style="display:none;">
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">No Surat</label>
                                        <input id="txt1" type="text" class="form-control" id="inputAddress"
                                            name="nomor_surat" value="{{ $nomor_surat }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('letter_nama') ? ' is-invalid' : '' }}"
                                            id="nama" placeholder="Nama" name="letter_nama"
                                            value="{{ old('letter_nama') }}">
                                        @if ($errors->has('letter_nama'))
                                            <span class="text-danger">{{ $errors->first('letter_nama') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email"
                                            class="form-control {{ $errors->has('letter_email') ? ' is-invalid' : '' }}"
                                            id="email" placeholder="email" name="letter_email"
                                            value="{{ old('letter_email') }}">
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
                                            value="{{ old('letter_telepon') }}">
                                        @if ($errors->has('letter_telepon'))
                                            <span class="text-danger">{{ $errors->first('letter_telepon') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">Address</label>
                                        <textarea type="text" class="form-control {{ $errors->has('letter_alamat') ? ' is-invalid' : '' }}"
                                            id="inputAddress" placeholder="Address" name="letter_alamat" value="{{ old('letter_alamat') }}"></textarea>
                                        @if ($errors->has('letter_alamat'))
                                            <span class="text-danger">{{ $errors->first('letter_alamat') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="peruntukan">Peruntukan</label>
                                    <select class="form-control {{ $errors->has('selectFungsi') ? ' is-invalid' : '' }}"
                                        style="color: black" id="selectON" onchange="onSelect();" name="selectFungsi">
                                        <option selected value="">Silakan Pilih</option>
                                        <option value="Internship">
                                            Penerimaan Internship</option>
                                        <option value="Karyawan">
                                            Penerimaan Karyawan</option>
                                    </select>
                                    @if ($errors->has('selectFungsi'))
                                        <span class="text-danger">{{ $errors->first('selectFungsi') }}</span>
                                    @endif
                                </div>
                                <div class="ShowOptionHidden" id="hiddenItems" style="display:none;">
                                    @include('Web.Surat.types_of_letters.offering.form')
                                </div>
                                <div class="float-md-right">
                                    <a href="{{ route('index_OfferingLetter') }}" class="btn btn-danger  ml-5">Cancel</a>
                                    <button type="submit" class="btn btn-primary ">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div> <!-- Script JS -->
        <script>
            function onSelect() {
                var kategori = document.getElementById("selectON");
                var option_data = kategori.options[kategori.selectedIndex].value;
                if (option_data == 'Internship') {
                    var label = document.getElementById("hiddenItems").setAttribute("style", "display: block;");
                    var label1 = document.getElementById("tanggal_selesai").setAttribute("style", "display: block;");
                    var label11 = document.getElementById("mol").setAttribute("class", "form-group col-md-6");
                    var label = document.getElementById("hiddenNosurat").setAttribute("style", "display: block;");
                    var label2 = document.getElementById("narahubung").innerHTML = "Nama Pembimbing";
                } else if (option_data == 'Karyawan') {
                    var label = document.getElementById("hiddenItems").setAttribute("style", "display: block;");
                    var label1 = document.getElementById("tanggal_selesai").setAttribute("style", "display: none;");
                    var label11 = document.getElementById("mol").setAttribute("class", "form-group col-md-12");
                    var label = document.getElementById("hiddenNosurat").setAttribute("style", "display: none;");
                    var label2 = document.getElementById("narahubung").innerHTML = "Narahubung";
                    var label2 = document.getElementById("txt1").value;
                } else {
                    var label1 = document.getElementById("hiddenItems").setAttribute("style", "display: none;");
                    var label = document.getElementById("hiddenNosurat").setAttribute("style", "display: none;");
                }
            }
        </script>
    </div>
@endsection

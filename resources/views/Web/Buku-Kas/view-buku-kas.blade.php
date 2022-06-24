@extends('Web.Layouts.app')
@section('title', ucwords($cash_book_id->nama_buku_kas))
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

                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-sm-1 mt-1">
                                            <img src="{{ asset('frontend/img/Page-1.png') }}" alt="buku">
                                        </div>
                                        <div class="col-sm-10 ml-3">
                                            <span class="h1 text-cyan"><strong>
                                                    {{ ucwords($cash_book_id->nama_buku_kas) }}
                                                </strong></span>
                                            <br><span>
                                                {{ ucfirst($cash_book_id->deskripsi_buku_kas) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <li style="list-style-type: none;">
                                        <span>Saldo </span>
                                    </li>

                                    <li style="list-style-type: none;">
                                        <span class="h2">
                                            <strong>
                                                @currency($cash_book_id_total)
                                            </strong>
                                        </span>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card overflow-hidden">
                        <div class="card-body border-bottom  shadow-sm p-3 bg-white rounded">
                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->
                            <nav class="navbar top-navbar float navbar-expand-md">
                                <ul class="navbar-nav float-left navbar-left">
                                    <li class="nav-item d-none d-md-block mr-1 mt-2">
                                        <button class=" btn btn-sm bg-danger nav-link text-white tombol"
                                            style="width: 150px;" data-toggle="modal" data-target="#pengeluaran"> Catat
                                            pengeluaran </button>
                                    </li>
                                    <li class=" nav-item d-none d-md-block mr-1 mt-2">
                                        <button class="nav-link bth btn-sm tombol text-white bg-alan" style="width: 150px;"
                                            data-toggle="modal" data-target="#pemasukan"> Catat
                                            Pemasukan
                                        </button>
                                    </li>
                                </ul>
                                <ul class="navbar-nav float-right navbar-right ml-auto">
                                    <!-- ============================================================== -->
                                    <!-- Search -->
                                    <!-- ============================================================== -->
                                    <li class=" d-none d-md-block">
                                        <a class="nav-link">
                                            {{-- SEARCH DATA --}}
                                            <form id="form-pencarian">
                                                <div class="customize-input">
                                                    <input
                                                        class="form-control custom-shadow custom-radius border-0 bg-white"
                                                        type="search" placeholder="Search" aria-label="Search"
                                                        id="searchdompet" name="cari" />
                                                </div>
                                            </form>
                                            {{-- END SEARCH DATA --}}
                                        </a>
                                    </li>
                                    {{-- SEARCH DATE RANGE --}}
                                    <form>
                                        <div class="input-daterange">
                                            <li class="nav-item d-none d-md-block mr-1 mt-2" id="datepiker">
                                                <input type="date" name="startDate" id="startDate"
                                                    value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class=" form-control custom-shadow custom-radius border-0 bg-white" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </li>
                                        </div>
                                    </form>
                                    {{-- END SEARCH DATE RANGE --}}
                                    {{-- ====================================== --}}
                                    {{-- PAGINATE DATA TABLE --}}
                                    <li class="nav-item d-none d-md-block mr-1 mt-2">
                                        <select
                                            class="custom-select form-control bg-white custom-radius custom-shadow border-0"
                                            id="list" name="list_data">
                                            <option value="semua">semua</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                            <option value="50">50</option>
                                        </select>
                                    </li>
                                    {{-- END PAGINATE DATA TABLE --}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="container bg-white p-3 mb-5" style="height: 100%;" id="search">
                        <div class="table-responsive mt-4 mb-5 ">
                            @if (count($noted_cash_book_id) !== 0)
                                <table class="table  table-bordered table-sm" id="data_users_reguler">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Tipe</th>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Nominal</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="search1">
                                        @foreach ($noted_cash_book_id as $buku)
                                            @if ($buku->catatan_keterangan == 'Pengeluaran')
                                                <tr class="table-danger">
                                                    <th scope="row" class="text-center "><i data-feather="arrow-up"></i>
                                                    </th>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($buku->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                                        <span
                                                            hidden>{{ \Carbon\Carbon::parse($buku->created_at)->format('Y-m-d') }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ ucwords($buku->nama_kategori) }}
                                                    </td>
                                                    <td class="text-center">{{ ucfirst($buku->deskripsi) }}
                                                    </td>
                                                    <td class="text-right">@currency($buku->catatan_saldo_kas) </td>
                                                    <td class="text-center">
                                                        @if (Auth::check())
                                                            <a href="{{ url('/book/' . $buku->id_catatan . '/delete') }}"
                                                                class="btn btn-danger btn-sm">Hapus</a>
                                                            {{-- EDIT --}}
                                                            <a href="#" data-id="{{ $buku->id_catatan }}"
                                                                class="btn btn-warning btn-sm btn-editpengeluaran">Edit</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="table-primary">
                                                    <th scope="row" class="text-center"><i
                                                            data-feather="arrow-down"></i>
                                                    </th>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($buku->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                                        <span
                                                            hidden>{{ \Carbon\Carbon::parse($buku->created_at)->format('Y-m-d') }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ ucwords($buku->nama_kategori) }}
                                                    </td>
                                                    <td class="text-center">{{ ucfirst($buku->deskripsi) }}
                                                    </td>
                                                    <td class="text-right">@currency($buku->catatan_saldo_kas) </td>
                                                    <td class="text-center">
                                                        @if (Auth::check())
                                                            <a href="{{ url('/book/' . $buku->id_catatan . '/delete') }}"
                                                                class="btn btn-danger btn-sm">Hapus</a>
                                                            <a href="#" data-id="{{ $buku->id_catatan }}"
                                                                class="btn btn-warning btn-sm btn-editpemasukan">
                                                                Edit</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Tidak Ada Aktifitas</p>
                            @endif
                            {{ $noted_cash_book_id->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pengeluaran -->
        <div class="modal fade" id="pengeluaran" tabindex="-1" role="dialog" aria-labelledby="pengeluaran"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengeluaran">Catatan Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-pengeluaran">
                            @csrf
                            <input type="text" name="Pengeluaran" value="Pengeluaran" hidden>
                            <div class="form-group">
                                <label for="jam" class="col-form-label">Jam :</label>
                                <input type="time" class="form-control" id="jam" name="catatan_jam"
                                    value="{{ old(
                                        'catatan_jam',
                                        Carbon\Carbon::now('Asia/Jakarta')->locale('id')->format('H:i'),
                                    ) }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="col-form-label">Tanggal :</label>
                                <input type="date" class="form-control" id="tanggal" name="catatan_tgl"
                                    value="{{ old('catatan_tgl', Carbon\Carbon::now()->format('Y-m-d')) }}"></input>
                            </div>

                            <div class="form-group">
                                <label for="rupiah" class="col-form-label">Nominal :</label>
                                <input type="text" min="0" onkeyup="changevalue()" placeholder="0"
                                    class="form-control" id="rupiahpengeluaran" value="{{ old('catatan_jumlah') }}">
                                <span style="color: red;font-size:12px" id="nominalError"></span>
                                <input type="text" min="0" placeholder="0" class="form-control"
                                    id="rupiahpengeluaran1" name="catatan_jumlah" value="{{ old('catatan_jumlah') }}"
                                    readonly hidden>
                            </div>

                            <div class="form-group">
                                <label for="kategori" class="col-form-label">Kategori :</label>
                                <Select class="form-control" name="id_kategori" id="kategori">
                                    <option value="{{ old('id_kategori') }}">---</option>
                                    @foreach ($kategori as $kat)
                                        @if ($kat->keterangan_kategori == 'Pengeluaran')
                                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}
                                            </option>
                                        @endif
                                    @endforeach
                                </Select>
                                <span style="color: red;font-size:12px" id="kategoriError"></span>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-form-label">Keterangan :</label>
                                <textarea class="form-control" id="keterangan" name="catatan_keterangan" value="{{ old('catatan_keterangan') }}"></textarea>
                                <span style="color: red; font-size:12px" id="keteranganError"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-1 back"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-success send">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- END -->
        <!-- Modal Pemasukan -->
        <div class="modal fade" id="pemasukan" tabindex="-1" role="dialog" aria-labelledby="pemasukan"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pemasukan">Catatan Pemasukan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-pemasukan">
                            @csrf
                            <input type="text" name="Pemasukan" value="Pemasukan" hidden>
                            <div class="form-group">
                                <label for="jam" class="col-form-label">Jam :</label>
                                <input type="time" class="form-control" id="jam" name="catatan_jam"
                                    value="{{ old(
                                        'catatan_jam',
                                        Carbon\Carbon::now('Asia/Jakarta')->locale('id')->format('H:i'),
                                    ) }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="col-form-label">Tanggal :</label>
                                <input type="date" class="form-control" id="tanggal" name="catatan_tgl"
                                    value="{{ old('catatan_tgl', Carbon\Carbon::now()->format('Y-m-d')) }}"></input>
                            </div>

                            <div class="form-group">
                                <label for="rupiah2" class="col-form-label">Nominal :</label>
                                <input type="text" min="0" onkeyup="changevaluepemasukan()" placeholder="0"
                                    class="form-control" id="rupiahpemasukan" value="{{ old('catatan_jumlah') }}">
                                <span style="color: red;font-size:12px" id="nominalPemasukanError1"></span>
                                <input type=" text" min="0" placeholder="0" class="form-control"
                                    id="rupiahpemasukan1" name="catatan_jumlah" value="{{ old('catatan_jumlah') }}"
                                    readonly hidden>
                            </div>
                            <div class="form-group">
                                <label for="kategori" class="col-form-label">Kategori :</label>
                                <Select class="form-control" name="id_kategori" id="id_kategori">
                                    <option value="{{ old('value') }}">---</option>
                                    @foreach ($kategori as $kat)
                                        @if ($kat->keterangan_kategori == 'Pemasukan')
                                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}
                                            </option>
                                        @endif
                                    @endforeach
                                </Select>
                                <span style="color: red;font-size:12px" id="id_kategoriError1"></span>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-form-label">Keterangan :</label>
                                <textarea class="form-control" id="keterangan1" name="catatan_keterangan"
                                    value="{{ old('catatan_keterangan') }}"></textarea>
                                <span style="color: red;font-size:12px" id="keteranganError1"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-1 cancelEntry"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-success sendEntry">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal  Edit -->
        <!-- END PEMASUKAN EDIT -->

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="pemasukan" aria-hidden="true"
            id="modal-editpemasukan">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengeluaran">Catatan Pemasukan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-editpemasukan">
                        @csrf
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success btn-updatepemasukan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--  PENGELUARAN EDIT -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="pengeluaran" aria-hidden="true"
            id="modal-editpengeluaran">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengeluaran">Catatan Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-editpengeluaran">
                        @csrf
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success btn-updatepengeluaran">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ENd -->
    </div>

    </div>

    <!-- Script JS -->
    <script src="{{ asset('frontend/moment/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript">
        /*================================ NOMINAL ====================================*/
        var rupiahpengeluaran = document.getElementById('rupiahpengeluaran');
        rupiahpengeluaran.addEventListener('keyup', function(e) {
            rupiahpengeluaran.value = formatRupiah(this.value, ' ');
        });
        var rupiahpengeluaran1 = document.getElementById('rupiahpengeluaran1');
        rupiahpengeluaran1.addEventListener('keyup', function(e) {
            rupiahpengeluaran1.value = formatRupiah(this.value, ' ');
        });

        var rupiahpemasukan = document.getElementById('rupiahpemasukan');
        rupiahpemasukan.addEventListener('keyup', function(e) {
            rupiahpemasukan.value = formatRupiah(this.value, ' ');
        });
        var rupiahpemasukan1 = document.getElementById('rupiahpemasukan1');
        rupiahpemasukan1.addEventListener('keyup', function(e) {
            rupiahpemasukan1.value = formatRupiah(this.value, ' ');
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
        }

        function changevalue() {
            var rupiah = document.getElementById('rupiahpengeluaran').value;
            var rupiahchange = rupiah.split(".").join("").split(" ").join("");
            document.getElementById('rupiahpengeluaran1').value = rupiahchange;


        }

        function changevaluepemasukan() {
            var rupiahpemasukan = document.getElementById('rupiahpemasukan').value;
            var rupiahchangepemasukan = rupiahpemasukan.split(".").join("").split(" ").join("");
            document.getElementById('rupiahpemasukan1').value = rupiahchangepemasukan;
        }
        /*================================ END NOMINAL ====================================*/

        /* ============================================ SEND CASH BOOK ========================================= */
        /* PENGELUARAN */
        $('.back').on('click', function() {
            document.getElementById('form-pengeluaran').reset();
            $('#keteranganError').text('')
            $('#kategoriError').text('')
            $('#nominalError').text('')
            $('#keterangan').css('border-color', '')
            $('#kategori').css('border-color', '')
            $('#rupiah').css('border-color', '')

        })
        $('.send').on('click', function() {
            let form_pengeluaran = $('#form-pengeluaran').serialize()
            // validasi form
            $.ajax({
                url: '{{ route('save_Noted_BukuKas', ['id_kas' => $cash_book_id->id_kas]) }}',
                method: "POST",
                data: form_pengeluaran,
                success: function(data) {
                    if (data.success) {
                        window.location.href =
                            '{{ route('show_BukuKas', ['id_kas' => $cash_book_id->id_kas]) }}';
                        Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            .fire({
                                type: 'success',
                                title: 'Data berhasil Di Tambah'
                            })
                    }
                },
                error: function(error) {
                    console.log(error)
                    // keterangan
                    if ($('#keterangan').val() == '') {
                        $('#keteranganError').text(error.responseJSON.errors.catatan_keterangan)
                        $('#keterangan').css('border-color', 'red')
                    } else {
                        $('#keterangan').css('border-color', 'green')
                        $('#keteranganError').text('data telah diisi').css('color', 'green')
                    }
                    // kategori
                    if ($('#kategori').val() == '') {
                        $('#kategoriError').text(error.responseJSON.errors.id_kategori)
                        $('#kategori').css('border-color', 'red')
                    } else {
                        $('#kategori').css('border-color', 'green')
                        $('#kategoriError').text('data telah diisi').css('color', 'green')
                    }
                    // nominal
                    if ($('#rupiahpengeluaran').val() == '') {
                        $('#nominalError').text(error.responseJSON.errors.catatan_jumlah)
                        $('#rupiahpengeluaran').css('border-color', 'red')
                    } else {
                        $('#rupiahpengeluaran').css('border-color', 'green')
                        $('#nominalError').text('data telah diisi').css('color', 'green')
                    }

                }
            });

        })

        /* Send Entry */
        $('.cancelEntry').on('click', function() {
            document.getElementById('form-pemasukan').reset();
            $('#keteranganError1').text('')
            $('#id_kategoriError1').text('')
            $('#nominalPemasukanError1').text('')
            $('#keterangan1').css('border-color', '')
            $('#id_kategori').css('border-color', '')
            $('#rupiahpemasukan').css('border-color', '')

        })
        $('.sendEntry').on('click', function() {
            let form_pemasukan = $('#form-pemasukan').serialize()
            // validasi form
            $.ajax({
                url: '{{ route('save_Noted_BukuKas', ['id_kas' => $cash_book_id->id_kas]) }}',
                method: "POST",
                data: form_pemasukan,
                success: function(data) {
                    if (data.success) {
                        window.location.href =
                            '{{ route('show_BukuKas', ['id_kas' => $cash_book_id->id_kas]) }}';
                        Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            .fire({
                                type: 'success',
                                title: 'Data berhasil Di Tambah'
                            })
                    }
                },
                error: function(error) {
                    console.log(error)
                    // keterangan
                    if ($('#keterangan1').val() == '') {
                        $('#keteranganError1').text(error.responseJSON.errors.catatan_keterangan)
                        $('#keterangan1').css('border-color', 'red')
                    } else {
                        $('#keterangan1').css('border-color', 'green')
                        $('#keteranganError1').text('data telah diisi').css('color', 'green')
                    }
                    // kategori
                    if ($('#id_kategori').val() == '') {
                        $('#id_kategori').css('border-color', 'red')
                        $('#id_kategoriError1').text(error.responseJSON.errors.id_kategori)
                    } else {
                        $('#id_kategori').css('border-color', 'green')
                        $('#id_kategoriError1').text('data telah diisi').css('color', 'green')
                    }
                    // nominal
                    if ($('#rupiahpemasukan').val() == '') {
                        $('#nominalPemasukanError1').text(error.responseJSON.errors.catatan_jumlah)
                        $('#rupiahpemasukan').css('border-color', 'red')
                    } else {
                        $('#rupiahpemasukan').css('border-color', 'green')
                        $('#nominalPemasukanError1').text('data telah diisi').css('color', 'green')
                    }

                }
            });

        })
        /* ============================================ SEND CASH BOOK END ========================================= */
        /*========================================= EDIT & UPDATE NOTES BOOK ID ===============================*/
        $('.btn-editpengeluaran').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/book/${id}/notes`,
                method: "GET",
                success: function(data) {
                    $('#modal-editpengeluaran').find('.modal-body').html(data)
                    $('#modal-editpengeluaran').modal('show')
                },
                error: function(error) {
                    console.log(error)
                }
            });
        })
        $('.btn-editpemasukan').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/book/${id}/notes`,
                method: "GET",
                success: function(data) {
                    // console.log(id)
                    $('#modal-editpemasukan').find('.modal-body').html(data)
                    $('#modal-editpemasukan').modal('show')
                },
                error: function(error) {
                    console.log(error)
                }
            });
        })


        $('.btn-updatepemasukan').on('click', function() {
            let id = $('#form-editpemasukan').find('#id_catatan').val()
            let id_kas = $('#form-editpemasukan').find('#id_kas').val()
            let FormData = $('#form-editpemasukan').serialize()
            $.ajax({
                url: `/book/${id}/update`,
                method: "PATCH",
                data: FormData,
                success: function(data) {
                    if (data.success) {
                        window.location.assign(`${id_kas}`);
                        Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            .fire({
                                type: 'success',
                                title: 'Data berhasil Di Update'
                            })
                    }
                },
                error: function(error) {
                    if ($('#Keterangan').val() == '') {
                        $('#KeteranganError').text(error.responseJSON.errors.deskripsi)
                        $('#KeteranganError').text(error.responseJSON.errors.deskripsi).css('color',
                            'red')
                        $('#Keterangan').css('border-color', 'red')
                    } else {
                        $('#Keterangan').css('border-color', 'green')
                        $('#KeteranganError').text('data telah diisi').css('color', 'green')
                    }
                    // kategori
                    if ($('#id_kategori').val() == '') {
                        $('#id_kategori').css('border-color', 'red')
                        $('#KategoriError').text(error.responseJSON.errors.id_kategori)
                    } else {
                        $('#id_kategori').css('border-color', 'green')
                        $('#KategoriError').text('data telah diisi').css('color', 'green')
                    }
                    // nominal
                    if ($('#nominalError').val() == '') {
                        $('#rupiahCatatan').text(error.responseJSON.errors.catatan_jumlah)
                        $('#nominalError').css('border-color', 'red')
                    } else {
                        $('#nominalError').css('border-color', 'green')
                        $('#rupiahCatatan').text('data telah diisi').css('color', 'green')
                    }
                }
            });
        })
        $('.btn-updatepengeluaran').on('click', function() {
            let id = $('#form-editpengeluaran').find('#id_catatan').val()
            let id_kas = $('#form-editpengeluaran').find('#id_kas').val()
            let FormData = $('#form-editpengeluaran').serialize()
            $.ajax({
                url: `/book/${id}/update`,
                method: "PATCH",
                data: FormData,
                success: function(data) {
                    if (data.success) {
                        window.location.assign(`${id_kas}`);
                        Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            .fire({
                                type: 'success',
                                title: 'Data berhasil Di Update'
                            })
                    }
                },
                error: function(error) {
                    if ($('#Keterangan').val() == '') {
                        $('#KeteranganError').text(error.responseJSON.errors.deskripsi)
                        $('#KeteranganError').text(error.responseJSON.errors.deskripsi).css('color',
                            'red')
                        $('#Keterangan').css('border-color', 'red')
                    } else {
                        $('#Keterangan').css('border-color', 'green')
                        $('#KeteranganError').text('data telah diisi').css('color', 'green')
                    }
                    // kategori
                    if ($('#id_kategori').val() == '') {
                        $('#id_kategori').css('border-color', 'red')
                        $('#KategoriError').text(error.responseJSON.errors.id_kategori)
                    } else {
                        $('#id_kategori').css('border-color', 'green')
                        $('#KategoriError').text('data telah diisi').css('color', 'green')
                    }
                    // nominal
                    if ($('#nominalError').val() == '') {
                        $('#rupiahCatatan').text(error.responseJSON.errors.catatan_jumlah)
                        $('#nominalError').css('border-color', 'red')
                    } else {
                        $('#nominalError').css('border-color', 'green')
                        $('#rupiahCatatan').text('data telah diisi').css('color', 'green')
                    }
                }
            });
        })
        /*========================================= EDIT & UPDATE NOTES BOOK ID END ===============================*/
        /*========================================= SEARCH ===============================*/
        $(document).ready(function() {
            $("#searchdompet").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#search1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        /*========================================= SEARCH END ===============================*/
        /*========================================= FILTER DATE  ===============================*/
        function filterRows() {
            var dateFrom = $('#startDate').val()
            var dateTo = dateFrom
            $('#search1 tr').each(function(i, tr) {
                var val = $(tr).find("td:nth-child(2)").text();
                var dateVal = moment(val, "YYY-MM-DD", false);
                var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                $(tr).css('display', visible);
            });
        }
        $('#startDate').on("change", filterRows);
        /*========================================= FILTER DATE END ===============================*/

        /*========================================= FILTER OPTION  ===============================*/
        $(document).ready(function($) {
            $('#search1').show();
            $('#list').change(function() {
                $('#search1').hide();
                var selection = $(this).val();
                console.log(selection)
                var dataset = $('#search1 tbody').find('tr');
                // show all rows first
                dataset.show();
                // filter the rows that should be hidden
                dataset.filter(function(index, item) {
                    return $(item).find('td:first-child').text().split(',').indexOf(selection) === -
                        1;
                }).hide();

            });
        });
        /*========================================= FILTER OPTION END ===============================*/
    </script>
@endsection

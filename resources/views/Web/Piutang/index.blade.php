@extends('Web.Layouts.app')
@section('title', 'Piutang')
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-1 mt-1">
                                        <img src="frontend/img/Page-7.png" alt="Hutang">
                                    </div>
                                    <div class="col-sm-10 ml-3">
                                        <span class="h1 text-cyan"><strong> Piutang </strong></span>
                                        <br><span>Piutang yang ada dalam hidup ini</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <li style="list-style-type: none;">
                                    <button class="btn float-right"><i data-feather="file-text"></i></button><br>
                                </li>
                                <li style="list-style-type: none;">
                                    <span>Jumlah </span>
                                </li>
                                <li style="list-style-type: none;">
                                    <span class="h2">
                                        <strong>
                                            @if ($cash_AccountsReceivable !== 0)
                                                @currency($cash_AccountsReceivable)
                                            @else
                                                <p>Tidak Ada Jumlah</p>
                                            @endif
                                        </strong>
                                    </span>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card overflow-hidden">
                    <div class="card-body border-bottom  shadow-lg p-3 bg-white rounded">
                        <nav class="navbar top-navbar float navbar-expand-md">
                            <ul class="navbar-nav float-left navbar-right mr-auto">
                                <li class="nav-item d-none d-sm-block mr-1 mt-2">
                                    <button class=" btn btn-sm bg-alan nav-link text-white tombol" style="width: 150px;"
                                        data-toggle="modal" data-target="#hutang"> Piutang
                                        Baru </button>
                                </li>
                            </ul>
                            <ul class="navbar-nav float-right navbar-right ml-auto">
                                <!-- ============================================================== -->
                                <!-- Search -->
                                <!-- ============================================================== -->
                                <li class=" d-none d-sm-block mr-1 mt-3">
                                    <a class="nav-link">
                                        <div class="customize-input">
                                            <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                                type="search" placeholder="Search" aria-label="Search"
                                                onkeyup="myFunction()" id="Searchpiutang" />
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item d-none d-sm-block mr-1 mt-4" id="datepiker">
                                    <input type="date" name="startDate" id="startDate"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                        class=" form-control custom-shadow custom-radius border-0 bg-white" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </li>
                                <li class="nav-item d-none d-sm-block mr-1 mt-4">
                                    <select class="custom-select form-control bg-white custom-radius custom-shadow border-0"
                                        name="piutang" id="listpiutang">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </li>
                                {{-- <li class="nav-item d-none d-sm-block mr-1 mt-4">
                                    <button class="nav-link bth btn-sm tombol text-white bg-alan" style="width: 125px;"
                                        type="submit" id="buttonpiutang" onclick="myFunction(event);">
                                        Cari
                                    </button>
                                </li> --}}

                            </ul>
                        </nav>
                    </div>
                    <div class="container bg-white p-3 mb-5" style="height: 100%;">
                        <div class="table-responsive mt-4 mb-5 ">
                            @if (count($all_AccountsReceivable) !== 0)
                                <table class="table  table-bordered table-sm">
                                    <thead>
                                        <tr class="text-center" id="tr">
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Client</th>
                                            <th>Deskripsi</th>
                                            <th>Nominal</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Table_piutang">
                                        @foreach ($all_AccountsReceivable as $piutang)
                                            <tr class="table-danger">
                                                <th scope="row" class="text-center "><i data-feather="check"></i></th>
                                                <td class="text-center" id="getTd">
                                                    {{ \Carbon\Carbon::parse($piutang->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                                    <span
                                                        hidden>{{ \Carbon\Carbon::parse($piutang->created_at)->format('Y-m-d') }}</span>
                                                </td>
                                                <td class="text-center"id="getTd">
                                                    {{ ucwords($piutang->piutang_client) }}</td>
                                                <td class="text-center" id="getTd">
                                                    {{ ucfirst($piutang->piutang_deskripsi) }}</td>
                                                <td class="text-right">@currency($piutang->catatan_saldo_piutang) </td>

                                                <td class="text-center" id="getTd">
                                                    @if (Auth::check())
                                                        {{ link_to('/account_receivable/' . $piutang->id_piutang . '/delete', 'Hapus', ['class' => 'btn btn-danger btn-sm']) }}
                                                        <a data-id="{{ $piutang->id_piutang }}"
                                                            class="btn btn-warning btn-sm btn-editpiutang">Edit</a>
                                                        {!! Form::close() !!}
                                                </td>
                                        @endif
                                        </tr>
                            @endforeach
                            </tbody>
                            </table>
                        @else
                            <p>Tidak ada Aktifitas</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hutang" tabindex="-1" role="dialog" aria-labelledby="pengeluaran"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengeluaran">Piutang Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-piutang">
                            @csrf
                            <div class="form-group">
                                <label for="Valclient" class="col-form-label">Client :</label>
                                <input type="txt" class="form-control" id="Valclient" name="piutang_client"
                                    value="{{ old('piutang_client') }}">
                                <span style="color: red;font-size:12px" id="TextClientPiutangError"></span>
                            </div>

                            <div class="form-group">
                                <label for="tgl" class="col-form-label">Tanggal :</label>
                                <input type="date" class="form-control" id="tanggal" name="piutang_tanggal"
                                    value="{{ old('piutang_tanggal', Carbon\Carbon::now()->format('Y-m-d')) }}">
                                <input type='checkbox' class="mt-3" data-toggle='collapse' data-target='#tempo'> Jatuh
                                Tempo

                            </div>
                            <div id='tempo' class='collapse div1'>
                                <div class="form-group">
                                    <label for="tempo" class="col-form-label">Jatuh Tempo :</label>
                                    <input type="date" class="form-control" id="tempo" name="piutang_jatuh"
                                        value="{{ old('piutang_jatuh', Carbon\Carbon::now()->format('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Valdeskripsi" class="col-form-label">Deskripsi :</label>
                                <textarea class="form-control" id="Valdeskripsi" name="piutang_deskripsi" value="{{ old('piutang_deskripsi') }}"></textarea>
                                <span style="color: red;font-size:12px" id="TextDeskripsiError"></span>
                            </div>
                            <div class="form-group">
                                <label for="piutang_nominal" class="col-form-label">Nominal :</label>
                                <input type="text" min="0" placeholder="0" class="form-control"
                                    id="piutang_nominal" value="{{ old('piutang_nominal') }}" onkeyup="changevalue()">
                                <span style="color: red;font-size:12px" id="TextPiutangNominalError"></span>
                                <input type="text" min="0" class="form-control" id="piutang_nominal1"
                                    name="piutang_nominal" hidden readonly>
                            </div>
                            {{-- CATAT SEBAGAI PEMASUKAN --}}
                            <div class="form-group">
                                <label>Catat sebagai Pengeluaran di Buku Kas ?</label>
                                <select class="custom-select col-sm-3" style="color: black" id="ddselect"
                                    name="selectedBuku" onchange="onSelect()">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                            {{-- END PEMASUKAN --}}
                            <div id="kategori" style="display: none;">
                                <div class="form-group">
                                    <label for="ValKas" class="col-form-label">Buku Kas :</label>
                                    <Select class="form-control" id="ValKas" name="id_kas">
                                        <option value="{{ old('book') }}">Pilih Buku Kas</option>
                                        @foreach ($all_cash_book as $buku_kas)
                                            <option value="{{ $buku_kas->id_kas }}">
                                                {{ ucwords($buku_kas->nama_buku_kas) }}</option>
                                        @endforeach
                                    </Select>
                                    <span style="color: red;font-size:12px" id="TextBukuKasError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="ValKategori" class="col-form-label">Kategori :</label>
                                    <Select class="form-control" name="id_kategori" id="ValKategori">
                                        <option value="{{ old('kategori') }}">---</option>
                                        @foreach ($all_category as $kat)
                                            @if ($kat->keterangan_kategori == 'Pengeluaran' && 'pengeluaran')
                                                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </Select>
                                    <span style="color: red;font-size:12px" id="TextKategoriError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-1 back"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-success save">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true"
            id="modal-editpiutang">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_piutang">
                        @csrf
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-1 back" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success btn-updatepiutang">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end -->

        <script>
            /* CLEAR FORM */
            $('.back').on('click', function() {
                document.getElementById('form-piutang').reset();
                $('#client').css('border-color', '')
                $('#TextClientError').text('')
                $('#deskripsi').css('border-color', '')
                $('#TextdeskripsiError').text('')
                $('#hutang_Nominal').css('border-color', '')
                $('#TextNominalError').text('')
                $('#id_kas').css('border-color', '')
                $('#Textid_kasError').text('')
                $('#id_kategori').css('border-color', '')
                $('#Textid_kategoriError').text('')
            })
            /* CLEAR FORM */
            /* SAVE PIUTANG */
            $('.save').on('click', function() {
                let formPiutang = $('#form-piutang').serialize()
                $.ajax({
                    url: `/account_receivable/save`,
                    method: "POST",
                    data: formPiutang,
                    success: function(data) {
                        if (data.success) {
                            window.location.assign('account_receivable')
                            Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                })
                                .fire({
                                    type: 'success',
                                    title: 'Data Piutang berhasil Di Tambah'
                                })
                        }
                    },
                    error: function(error) {
                        // client
                        if ($('#Valclient').val() == '') {
                            $('#TextClientPiutangError').text(error.responseJSON.errors.piutang_client)
                            $('#TextClientPiutangError').text(error.responseJSON.errors.piutang_client).css(
                                'color',
                                'red')
                            $('#Valclient').css('border-color', 'red')
                        } else {
                            $('#Valclient').css('border-color', 'green')
                            $('#TextClientPiutangError').text('data telah diisi').css('color', 'green')
                        }
                        // deskripsi
                        if ($('#Valdeskripsi').val() == '') {
                            $('#TextDeskripsiError').text(error.responseJSON.errors.piutang_deskripsi)
                            $('#TextDeskripsiError').text(error.responseJSON.errors.piutang_deskripsi).css(
                                'color', 'red')
                            $('#Valdeskripsi').css('border-color', 'red')
                        } else {
                            $('#Valdeskripsi').css('border-color', 'green')
                            $('#TextDeskripsiError').text('data telah diisi').css('color', 'green')
                        }
                        // nominal
                        if ($('#piutang_nominal').val() == '') {
                            $('#TextPiutangNominalError').text(error.responseJSON.errors.piutang_nominal)
                            $('#TextPiutangNominalError').text(error.responseJSON.errors.piutang_nominal)
                                .css(
                                    'color', 'red')
                            $('#piutang_nominal').css('border-color', 'red')
                        } else {
                            $('#piutang_nominal').css('border-color', 'green')
                            $('#TextPiutangNominalError').text('data telah diisi').css('color', 'green')
                        }
                        // Buku Kas
                        if ($('#ValKas').val() == '') {
                            $('#TextBukuKasError').text(error.responseJSON.errors.id_kas)
                            $('#TextBukuKasError').text(error.responseJSON.errors.id_kas).css(
                                'color', 'red')
                            $('#ValKas').css('border-color', 'red')
                        } else {
                            $('#ValKas').css('border-color', 'green')
                            $('#TextBukuKasError').text('data telah diisi').css('color', 'green')
                        }
                        // Kategori Kas
                        if ($('#ValKategori').val() == '') {
                            $('#TextKategoriError').text(error.responseJSON.errors.id_kategori)
                            $('#TextKategoriError').text(error.responseJSON.errors.id_kategori).css(
                                'color', 'red')
                            $('#ValKategori').css('border-color', 'red')
                        } else {
                            $('#ValKategori').css('border-color', 'green')
                            $('#TextKategoriError').text('data telah diisi').css('color', 'green')
                        }
                    }
                })
            })

            /*============================ EDIT & UPDATE PIUTANG =============================================*/
            $('.btn-editpiutang').on('click', function() {
                let id = $(this).data('id')
                $.ajax({
                    url: `/account_receivable/${id}/view`,
                    method: 'GET',
                    success: function(data) {
                        $('#modal-editpiutang').find('.modal-body').html(data)
                        $('#modal-editpiutang').modal('show')
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            })
            /*
             * Update Data hutang
             */
            $('.btn-updatepiutang').on('click', function() {
                let id = $('#form_piutang').find('#id_piutang').val()
                let FormData = $('#form_piutang').serialize()
                $.ajax({
                    url: `/account_receivable/${id}/update`,
                    method: "PATCH",
                    data: FormData,
                    success: function(data) {
                        if (data.success) {
                            window.location.assign('/account_receivable');
                            Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                })
                                .fire({
                                    type: 'success',
                                    title: 'Data Piutang berhasil Di Update'
                                })
                        }
                    },
                    error: function(error) {
                        // client
                        if ($('#EditValclient').val() == '') {
                            $('#TextEditClientError').text(error.responseJSON.errors.piutang_client)
                            $('#TextEditClientError').text(error.responseJSON.errors.piutang_client).css(
                                'color',
                                'red')
                            $('#EditValclient').css('border-color', 'red')
                        } else {
                            $('#EditValclient').css('border-color', 'green')
                            $('#TextEditClientError').text('data telah diisi').css('color', 'green')
                        }
                        // deskripsi
                        if ($('#deskripsi').val() == '') {
                            $('#TextEditDeskripsitError').text(error.responseJSON.errors.piutang_deskripsi)
                            $('#TextEditDeskripsitError').text(error.responseJSON.errors.piutang_deskripsi)
                                .css(
                                    'color', 'red')
                            $('#deskripsi').css('border-color', 'red')
                        } else {
                            $('#deskripsi').css('border-color', 'green')
                            $('#TextEditDeskripsitError').text('data telah diisi').css('color', 'green')
                        }
                        // nominal
                        if ($('#piutangEdit').val() == '') {
                            $('#TextEditPiutangtError').text(error.responseJSON.errors.piutang_nominal)
                            $('#TextEditPiutangtError').text(error.responseJSON.errors.piutang_nominal)
                                .css(
                                    'color', 'red')
                            $('#piutangEdit').css('border-color', 'red')
                        } else {
                            $('#piutangEdit').css('border-color', 'green')
                            $('#TextEditPiutangtError').text('data telah diisi').css('color', 'green')
                        }
                        // Buku Kas
                        if ($('#idKasPiutang').val() == '') {
                            $('#TextEditBukuKastError').text(error.responseJSON.errors.id_kas)
                            $('#TextEditBukuKastError').text(error.responseJSON.errors.id_kas).css(
                                'color', 'red')
                            $('#idKasPiutang').css('border-color', 'red')
                        } else {
                            $('#idKasPiutang').css('border-color', 'green')
                            $('#TextEditBukuKastError').text('data telah diisi').css('color', 'green')
                        }
                        // Kategori Kas
                        if ($('#id_kategori').val() == '') {
                            $('#TextEditKategoriPiutangError').text(error.responseJSON.errors.id_kategori)
                            $('#TextEditKategoriPiutangError').text(error.responseJSON.errors.id_kategori).css(
                                'color', 'red')
                            $('#id_kategori').css('border-color', 'red')
                        } else {
                            $('#id_kategori').css('border-color', 'green')
                            $('#TextEditKategoriPiutangError').text('data telah diisi').css('color', 'green')
                        }
                    }
                });
            })
            /*============================ END UPDATE PIUTANG =============================================*/

            var rupiah = document.getElementById('piutang_nominal');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value, ' ');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
            }

            function changevalue() {
                var rupiah = document.getElementById('piutang_nominal').value;
                var rupiahchange = rupiah.split(".").join("").split("Rp").join("");
                document.getElementById('piutang_nominal1').value = rupiahchange;
            }
            /*COLLAPSE SELECT OPTION PIUTANG*/
            function onSelect() {
                var kategori = document.getElementById("ddselect");
                var option_data = kategori.options[kategori.selectedIndex].value;
                if (option_data == '1') {
                    var label = document.getElementById("kategori").setAttribute("style", "display: block;");
                } else {
                    var label = document.getElementById("kategori").setAttribute("style", "display: none;");
                }
            }
            /* END */
        </script>
        <script>
            /*=========================================== SEARCH ======================================*/
            function myFunction() {
                var input, filter, table, tr, td, cell, i, j;
                input = document.getElementById("Searchpiutang");
                filter = input.value.toUpperCase();
                console.log(filter)
                table = document.getElementById("Table_piutang");
                tr_table = document.getElementById("tr");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    // Hide the row initially.
                    tr[i].style.display = "none";
                    tr_table.style.display = "";
                    td = tr[i].getElementsByTagName("td");
                    for (var j = 0; j < td.length; j++) {
                        cell = tr[i].getElementsByTagName("td")[j];
                        if (cell) {
                            if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break;
                            }
                        }
                    }
                }
            }
            /*=========================================== END SEARCH ======================================*/
            /* FILTER DATE DEBT END*/
            function filterRows() {
                var dateFrom = $('#startDate').val()
                var dateTo = dateFrom
                $('#Table_piutang tr').each(function(i, tr) {
                    var val = $(tr).find("td:nth-child(2)").text();
                    var dateVal = moment(val, "YYY-MM-DD", false);
                    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                    $(tr).css('display', visible);
                });
            }
            $('#startDate').on("change", filterRows);
            /* FILTER DATE DEBT END*/
        </script>
    @endsection

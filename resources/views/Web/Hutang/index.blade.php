@extends('Web.Layouts.app')
@section('title', 'Hutang')
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
                                        <img src="frontend/img/Page-2.png" alt="Hutang">
                                    </div>
                                    <div class="col-sm-10 ml-3">
                                        <span class="h1 text-cyan"><strong> Hutang </strong></span>
                                        <br><span>Hutang yang ada dalam hidup ini</span>
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
                                <li style="list-style-type: none;"><span class="h2"><strong>
                                            @if ($result_total_debt !== 0)
                                                @currency($result_total_debt)
                                            @else
                                                <p>Tidak Ada Jumlah</p>
                                            @endif
                                        </strong></span>
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
                                    <button class=" btn btn-sm bg-danger nav-link text-white tombol" style="width: 150px;"
                                        data-toggle="modal" data-target="#hutang"> Hutang
                                        Baru </button>
                                </li>
                            </ul>
                            <ul class="navbar-nav float-right navbar-right ml-auto">
                                <!-- ============================================================== -->
                                <!-- Search -->
                                <!-- ============================================================== -->

                                <li class=" d-none d-md-block mr-1 mt-3">
                                    <a class="nav-link">
                                        {{-- SEARCH DATA --}}
                                        <form>
                                            <div class="customize-input">
                                                <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                                    type="search" placeholder="Search" aria-label="Search"
                                                    onkeyup="OnFunction()" id="SearchHutang" />
                                            </div>
                                        </form>
                                        {{-- END SEARCH DATA --}}
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
                                        name="paginateHutang" id="paginateHutang">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </li>

                                {{-- <li class="nav-item d-none d-sm-block mr-1 mt-4">
                                    <button class="nav-link bth btn-sm tombol text-white bg-alan" style="width: 125px;"
                                        type="submit" id="buttonhutang" onclick="myFunction(event);">
                                        Cari
                                    </button>
                                </li> --}}

                            </ul>
                        </nav>
                    </div>
                    <div class="container bg-white p-3 mb-5" style="height: 100%;">
                        <div class="table-responsive mt-4 mb-5 ">
                            @if (count($all_debt) !== 0)
                                <table class="table table-bordered table-sm">
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
                                    <tbody id="tbl_hutang">
                                        @foreach ($all_debt as $hutang)
                                            <tr class="table-danger">
                                                <th scope="row" class="text-center"><i data-feather="check"></i></th>
                                                <td class="text-center ">
                                                    {{ \Carbon\Carbon::parse($hutang->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                                    <span
                                                        hidden>{{ \Carbon\Carbon::parse($hutang->created_at)->format('Y-m-d') }}</span>
                                                </td>
                                                <td class="text-center ">{{ ucwords($hutang->hutang_client) }}</td>
                                                <td class="text-center ">{{ ucfirst($hutang->hutang_deskripsi) }}</td>
                                                <td class="text-center ">@currency($hutang->catatan_saldo_hutang) </td>

                                                <td class="text-center action">
                                                    @if (Auth::check())
                                                        {{ link_to('debt/' . $hutang->id_hutang . '/delete', 'Hapus', ['class' => 'btn btn-danger btn-sm']) }}
                                                        <a href="javascript:void(0)" data-id="{{ $hutang->id_hutang }}"
                                                            class="btn btn-warning btn-sm btn-edit">
                                                            Edit</a>
                                                        {!! Form::close() !!}
                                                </td>
                                        @endif
                                        </tr>
                            @endforeach
                            </tbody>
                            </table>
                        @else
                            <p>Tidak Ada Aktifitas</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="hutang" tabindex="-1" role="dialog" aria-labelledby="hutang" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hutang">Hutang Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formDebt">
                            @csrf
                            <div class="form-group">
                                <label for="client" class="col-form-label">Client :</label>
                                <input type="txt" class="form-control" id="client" name="hutang_client"
                                    value="{{ old('hutang_client') }}">
                                <span style="color: red;font-size:12px" id="TextClientError"></span>
                            </div>
                            {{-- TANGGAL HUTANG --}}
                            <div class="form-group">
                                <label for="tgl" class="col-form-label">Tanggal :</label>
                                <input type="date" class="form-control" id="tanggal" name="hutang_tanggal"
                                    value="{{ old('hutang_tanggal', Carbon\Carbon::now()->format('Y-m-d')) }}">
                                <input type='checkbox' class="mt-3" data-toggle='collapse' data-target='#tempo'> Jatuh
                                Tempo
                            </div>
                            <div id='tempo' class='collapse div1'>
                                <div class="form-group">
                                    <label for="tempo" class="col-form-label">Jatuh Tempo :</label>
                                    <input type="date" class="form-control" id="tempo" name="hutang_jatuh"
                                        value="{{ old('hutang_jatuh', Carbon\Carbon::now()->format('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                <textarea class="form-control"id="deskripsi" name="hutang_deskripsi" value="{{ old('hutang_deskripsi') }}"></textarea>
                                <span style="color: red;font-size:12px" id="TextdeskripsiError"></span>
                            </div>
                            <div class="form-group">
                                <label for="nominal" class="col-form-label">Nominal :</label>
                                <input type="text" min="0" placeholder="0" onkeyup="changevalue()"
                                    class="form-control" id="hutang_Nominal" value="{{ old('hutang_nominal') }}">
                                <span style="color: red;font-size:12px" id="TextNominalError"></span>
                                <input type="text" min="0" placeholder="0" class="form-control"
                                    id="hutang_Nominal1" name="hutang_nominal" value="{{ old('hutang_nominal') }}"
                                    hidden readonly>
                            </div>


                            {{-- CATAT SEBAGAI PEMASUKAN --}}
                            <div class="form-group">
                                <label>Catat sebagai Pemasukan di Buku Kas ?</label>
                                <select class="custom-select col-sm-3" style="color: black" id="ddselect"
                                    name="selectedBuku" onchange="onSelect()">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                            {{-- END PEMASUKAN --}}

                            <div id="kategori" style="display: none;">
                                <div class="form-group">
                                    <label for="nominal" class="col-form-label">Buku Kas :</label>
                                    <Select class="form-control" id="id_kas" name="id_kas">
                                        <option value="{{ old('id_kas') }}">Pilih Buku Kas</option>
                                        @foreach ($all_cash_book as $buku_kas)
                                            <option value="{{ $buku_kas->id_kas }}">
                                                {{ ucwords($buku_kas->nama_buku_kas) }}
                                        @endforeach
                                    </Select>
                                    <span style="color: red;font-size:12px" id="Textid_kasError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="nominal" class="col-form-label">Kategori</label>
                                    <Select class="form-control" name="id_kategori" id="id_kategori">
                                        <option value="{{ old('id_kategori') }}">---</option>
                                        @foreach ($all_category as $kat)
                                            @if ($kat->keterangan_kategori == 'Pemasukan' && 'pemasukan')
                                                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </Select>
                                    <span style="color: red;font-size:12px" id="Textid_kategoriError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-1 back"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-success submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- Edit -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formatdata">
                        @csrf
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success btn-updatehutang">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            /* RUPIAH INDONESIA */

            var rupiah = document.getElementById('hutang_Nominal');
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
                var rupiah = document.getElementById('hutang_Nominal').value;
                var rupiahchange = rupiah.split(".").join("").split("Rp").join("");
                document.getElementById('hutang_Nominal1').value = rupiahchange;

            }
            /* RUPIAH INDONESIA END */
            /* Clear Cancel DEBT */
            $('.back').on('click', function() {
                document.getElementById('formDebt').reset();
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
            /* Clear Cancel  DEBT */
            /* SAVE DEBT */
            $('.submit').on('click', function() {
                let formDebt = $('#formDebt').serialize()
                console.log(formDebt)
                $.ajax({
                    url: '{{ route('save_Debt') }}',
                    method: 'POST',
                    data: formDebt,
                    success: function(data) {
                        if (data.success) {
                            window.location.href = '{{ route('index_Debt') }}';
                            Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                })
                                .fire({
                                    type: 'success',
                                    title: 'Data Hutang berhasil Di Tambah'
                                })
                        }
                    },
                    error: function(error) {
                        // client
                        if ($('#client').val() == '') {
                            $('#TextClientError').text(error.responseJSON.errors.hutang_client)
                            $('#TextClientError').text(error.responseJSON.errors.hutang_client).css('color',
                                'red')
                            $('#client').css('border-color', 'red')
                        } else {
                            $('#client').css('border-color', 'green')
                            $('#TextClientError').text('data telah diisi').css('color', 'green')
                        }
                        // deskripsi
                        if ($('#deskripsi').val() == '') {
                            $('#TextdeskripsiError').text(error.responseJSON.errors.hutang_deskripsi)
                            $('#TextdeskripsiError').text(error.responseJSON.errors.hutang_deskripsi).css(
                                'color', 'red')
                            $('#deskripsi').css('border-color', 'red')
                        } else {
                            $('#deskripsi').css('border-color', 'green')
                            $('#TextdeskripsiError').text('data telah diisi').css('color', 'green')
                        }
                        // nominal
                        if ($('#hutang_Nominal').val() == '') {
                            $('#TextNominalError').text(error.responseJSON.errors.hutang_nominal)
                            $('#TextNominalError').text(error.responseJSON.errors.hutang_nominal).css(
                                'color', 'red')
                            $('#hutang_Nominal').css('border-color', 'red')
                        } else {
                            $('#hutang_Nominal').css('border-color', 'green')
                            $('#TextNominalError').text('data telah diisi').css('color', 'green')
                        }
                        // Buku Kas
                        if ($('#id_kas').val() == '') {
                            $('#Textid_kasError').text(error.responseJSON.errors.id_kas)
                            $('#Textid_kasError').text(error.responseJSON.errors.id_kas).css(
                                'color', 'red')
                            $('#id_kas').css('border-color', 'red')
                        } else {
                            $('#id_kas').css('border-color', 'green')
                            $('#Textid_kasError').text('data telah diisi').css('color', 'green')
                        }
                        // Kategori Kas
                        if ($('#id_kategori').val() == '') {
                            $('#Textid_kategoriError').text(error.responseJSON.errors.id_kategori)
                            $('#Textid_kategoriError').text(error.responseJSON.errors.id_kategori).css(
                                'color', 'red')
                            $('#id_kategori').css('border-color', 'red')
                        } else {
                            $('#id_kategori').css('border-color', 'green')
                            $('#Textid_kategoriError').text('data telah diisi').css('color', 'green')
                        }
                    }
                })
            })
            /* SAVE DEBT END */
            /* EDIT DEBT */
            $('.btn-edit').on('click', function() {
                console.log($(this).data('id'))
                let id = $(this).data('id')
                $.ajax({
                    url: `/debt/${id}/edit`,
                    method: 'GET',
                    success: function(data) {
                        // console.log(data) 
                        $('#edit').find('.modal-body').html(data)
                        $('#edit').modal('show')
                    },
                    error: function(error) {

                    }
                })
            })
            /* EDIT DEBT END*/
            /* UPDATE DEBT */
            $('.btn-updatehutang').on('click', function() {
                let id = $('#formatdata').find('#id_hutang').val()
                let FormData = $('#formatdata').serialize()
                console.log(FormData)
                $.ajax({
                    url: `/debt/${id}/update`,
                    method: "PATCH",
                    data: FormData,
                    success: function(data) {
                        if (data.success) {
                            window.location.assign('debt');
                            Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000
                                })
                                .fire({
                                    type: 'success',
                                    title: 'Data Hutang berhasil Di Update'
                                })
                        }
                    },
                    error: function(error) {
                        // client
                        if ($('#clientVal').val() == '') {
                            $('#TextClientErrors').text(error.responseJSON.errors.hutang_clientVal)
                            $('#TextClientErrors').text(error.responseJSON.errors.hutang_clientVal).css(
                                'color',
                                'red')
                            $('#clientVal').css('border-color', 'red')
                        } else {
                            $('#clientVal').css('border-color', 'green')
                            $('#TextClientErrors').text('data telah diisi').css('color', 'green')
                        }
                        // deskripsi
                        if ($('#deskripsiVal').val() == '') {
                            $('#TextDeskripsiErrors').text(error.responseJSON.errors.hutang_deskripsi)
                            $('#TextDeskripsiErrors').text(error.responseJSON.errors.hutang_deskripsi).css(
                                'color', 'red')
                            $('#deskripsiVal').css('border-color', 'red')
                        } else {
                            $('#deskripsiVal').css('border-color', 'green')
                            $('#TextDeskripsiErrors').text('data telah diisi').css('color', 'green')
                        }
                        // nominal
                        if ($('#rupiah_hutang').val() == '') {
                            $('#TextNominalErrors').text(error.responseJSON.errors.hutang_nominal)
                            $('#TextNominalErrors').text(error.responseJSON.errors.hutang_nominal).css(
                                'color', 'red')
                            $('#rupiah_hutang').css('border-color', 'red')
                        } else {
                            $('#rupiah_hutang').css('border-color', 'green')
                            $('#TextNominalErrors').text('data telah diisi').css('color', 'green')
                        }
                        // Buku Kas
                        if ($('#id_kasVal').val() == '') {
                            $('#TextIdKasError').text(error.responseJSON.errors.id_kas)
                            $('#TextIdKasError').text(error.responseJSON.errors.id_kas).css(
                                'color', 'red')
                            $('#id_kasVal').css('border-color', 'red')
                        } else {
                            $('#id_kasVal').css('border-color', 'green')
                            $('#TextIdKasError').text('data telah diisi').css('color', 'green')
                        }
                        // Kategori Kas
                        if ($('#idKategori').val() == '') {
                            $('#TextIdKategoriError').text(error.responseJSON.errors.id_kategori)
                            $('#TextIdKategoriError').text(error.responseJSON.errors.id_kategori).css(
                                'color', 'red')
                            $('#idKategori').css('border-color', 'red')
                        } else {
                            $('#idKategori').css('border-color', 'green')
                            $('#TextIdKategoriError').text('data telah diisi').css('color', 'green')
                        }
                    }
                });
            })
            /* UPDATE DEBT END*/
            /* FILTER SEARCH DEBT */
            function OnFunction() {
                var input, filter, table, tr, td, cell, i, j;
                input = document.getElementById("SearchHutang");
                filter = input.value.toUpperCase();
                table = document.getElementById("tbl_hutang");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    // Hide the row initially.
                    tr[i].style.display = "none";
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
            /* FILTER SEARCH DEBT END*/
            /* FILTER DATE DEBT END*/
            function filterRows() {
                var dateFrom = $('#startDate').val()
                var dateTo = dateFrom
                $('#tbl_hutang tr').each(function(i, tr) {
                    var val = $(tr).find("td:nth-child(2)").text();
                    var dateVal = moment(val, "YYY-MM-DD", false);
                    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                    $(tr).css('display', visible);
                });
            }
            $('#startDate').on("change", filterRows);
            /* FILTER DATE DEBT END*/
            /* FILTER LIST DEBT END*/
            /* FILTER LIST DEBT END*/
            /* RUPIAH DEBT */
            /* RUPIAH DEBT END*/
        </script>
        <script>
            /* FUNGSI COLLAPSE CATATAN PEMASUKAN HUTANG */
            function onSelect() {
                var kategori = document.getElementById("ddselect");
                var option_data = kategori.options[kategori.selectedIndex].value;
                if (option_data == '0') {
                    var label = document.getElementById("kategori").setAttribute("style", "display: none;");
                } else {
                    var label = document.getElementById("kategori").setAttribute("style", "display: block;");
                }
            }
            /* END */
        </script>

    @endsection

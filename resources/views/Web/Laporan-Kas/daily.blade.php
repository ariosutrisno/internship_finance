@extends('Web.Layouts.app')
@section('title', 'Laporan Kas Harian')
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
                                            <img src="{{ asset('frontend/img/Page-1.png') }}" alt="Hutang">
                                        </div>
                                        <div class="col-sm-10 ml-3">
                                            <span class="h2 text-danger"><strong> Laporan Kas Harian
                                                </strong></span>
                                            <br><span>uang masuk dan keluar dalam hidup ini</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <li style="list-style-type: none;">
                                        <button class="btn float-right"><i data-feather="edit"></i></button><br>
                                    </li>
                                    <li style="list-style-type: none;">
                                        <span class="text-danger">Saldo </span>
                                    </li>

                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card overflow-hidden">
                        <div class="card-body border-bottom  shadow-lg p-3 bg-white rounded">
                            <nav class="navbar top-navbar float navbar-expand-md">
                                <ul class="navbar-nav float-left navbar-left">
                                    <li class="nav-item d-none d-md-block mr-1 mt-2">
                                        <select
                                            class="custom-select form-control bg-white custom-radius custom-shadow border-0"
                                            id="myselect">
                                            <option value="laporanHarian" data-url="{{ route('daily_CashStatement') }}"
                                                selected>
                                                Laporan Harian</option>
                                            <option value="laporanMingguan"
                                                data-url="{{ route('weekly_CashStatement') }}">
                                                Laporan
                                                Mingguan</option>
                                            <option value="laporanBulanan"
                                                data-url="{{ route('monthly_CashStatement') }}">Laporan
                                                Bulanan</option>
                                            <option value="laporanTahunan" data-url="{{ route('annual_CashStatement') }}">
                                                Laporan
                                                Tahunan</option>
                                        </select>
                                    </li>
                                </ul>
                                <ul class="navbar-nav float-right navbar-right ml-auto">
                                    <!-- ============================================================== -->
                                    <!-- Search -->
                                    <!-- ============================================================== -->

                                    <li class="nav-item d-none d-sm-block mr-1 mt-2">
                                        <input type="date"
                                            class="form-control bg-white custom-radius custom-shadow border-0"
                                            name="tgl" id="tgl"
                                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                    </li>
                                    <li class="nav-item d-none d-sm-block mr-1 mt-2">
                                        <select
                                            class="custom-select form-control bg-white custom-radius custom-shadow border-0"
                                            id="select">
                                            @if (count($all_book) !== 0)
                                                <option>Pilih Kas</option>
                                                <option data-url="/cash-statement/daily">Semua Kas</option>
                                                @foreach ($all_book as $item)
                                                    @if ($item->id_kas)
                                                        <option value="{{ $item->id_kas }}"
                                                            data-url="/cash-statement/{{ $item->id_kas }}/daily">
                                                            {{ $item->nama_buku_kas }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p>tidak ada aktifitas</p>
                                            @endif
                                        </select>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="container bg-white p-3 mb-5" style="height: 100%;">

                            <div class="table-responsive mt-4 mb-5 ">
                                @if (count($all_noted_daily_CashStatement) !== 0)
                                    <table class="table  table-bordered table-sm">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Deskripsi</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_daily">
                                            @foreach ($all_noted_daily_CashStatement as $buku)
                                                @if ($buku->catatan_keterangan == 'Pengeluaran' && 'pengeluaran')
                                                    <tr class="table-danger">
                                                        <th scope="row" class="text-center "><i
                                                                data-feather="arrow-up"></i>
                                                        </th>
                                                        <td class="text-center">
                                                            {{ \Carbon\Carbon::parse($buku->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                                            <span
                                                                hidden>{{ \Carbon\Carbon::parse($buku->created_at)->format('Y-m-d') }}</span>
                                                        </td>
                                                        <td class="text-center">{{ ucfirst($buku->deskripsi) }}
                                                        </td>
                                                        <td class="text-right">@currency($buku->catatan_saldo_kas)
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

                                                        <td class="text-center">{{ ucfirst($buku->deskripsi) }}
                                                        </td>
                                                        <td class="text-right">@currency($buku->catatan_saldo_kas)
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Data Kosong</p>
                                @endif
                                {{ $all_noted_daily_CashStatement->render() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center font-weight-bold">Statistik Grafik Finance Harian</h3>
                            <div class="pl-4 mb-5">
                                <canvas id="myChart" class="position-relative"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /* FILTER DATE */
        function filterRows() {
            var dateFrom = $('#tgl').val()
            var dateTo = dateFrom
            $('#tbl_daily tr').each(function(i, tr) {
                var val = $(tr).find("td:nth-child(2)").text();
                var dateVal = moment(val, "YYY-MM-DD", false);
                var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                $(tr).css('display', visible);
            });
        }
        $('#tgl').on("change", filterRows);
        /* FILTER DATE END */
        const select = document.querySelector("#myselect");
        const options = document.querySelectorAll("#myselect option");
        // 1
        select.addEventListener("change", function() {
            const url = this.options[this.selectedIndex].dataset.url;
            if (url) {
                location.href = url;
            }
        });
        // 2
        for (const option of options) {
            const url = option.dataset.url;
            if (location.href.includes(url)) {
                option.setAttribute("selected", "");
                break;
            }
        }
        $("#select").change(function() {
            var option = $(this).find('option:selected');
            window.location.href = option.data("url");
        });
        var ctx = document.getElementById('myChart').getContext("2d");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= $all_date ?>,
                datasets: [{
                        label: 'Pemasukan',
                        data: <?= $income ?>,
                        backgroundColor: 'rgba(0, 0, 0, 0)',
                        borderColor: 'rgba(0, 0, 255)',
                    },
                    {
                        label: 'pengeluaran',
                        data: <?= $expenditure ?>,
                        backgroundColor: 'rgba(0, 0, 0, 0)',
                        borderColor: 'rgba(155, 0, 0, 1)',

                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

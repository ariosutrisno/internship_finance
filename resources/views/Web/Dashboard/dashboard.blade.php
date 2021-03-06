@extends('Web.Layouts.app')
@section('title', 'Dashboard')
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


                <div class="card-group">
                    <div class="card border-right  mr-2 ml-2">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h3 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                        Saldo
                                    </h3>
                                    <div class="dropdown mt-3">
                                        <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Buku Kas
                                            <i data-feather="chevron-down" class="svg-icon"></i></span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @if (count($all_cash_book) !== 0)
                                                <a class="dropdown-item" href="/dashboard">Semua Kas</a>
                                                @foreach ($all_cash_book as $sidebar)
                                                    @if ($sidebar->id_kas)
                                                        <a class="dropdown-item"
                                                            href="/dashboard/{{ $sidebar->id_kas }}">{{ ucwords($sidebar->nama_buku_kas) }}</a>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p>tidak ada aktifitas</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><sup class="set-doller"></sup>
                                            @currency($total_all_balance)</h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">{{ $data_persen }}%</span>

                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">

                                        {{ $data }} % dari bulan
                                        lalu
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card border-right mr-2 ml-2">
                        <div class="card-body  ">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h3 class=" font-weight-normal text-purple mb-0 w-100 text-truncate">
                                        Pemasukan
                                    </h3>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium" style="margin-top:40px !important">
                                            <sup class="set-doller"></sup>
                                            @currency($total_all_income)
                                        </h2>
                                        <span
                                            class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"
                                            style="margin-top:40px !important">{{ $data_persen_income }}%</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                        {{ $data_income }} % dari bulan lalu
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card border-right mr-2 ml-2">
                        <div class="card-body  ">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h3 class=" font-weight-normal text-danger mb-0 w-100 text-truncate">
                                        Pengeluaran
                                    </h3>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium" style="margin-top:40px !important">
                                            {{-- <sup class="set-doller"></sup> --}}
                                            @currency($total_all_expenses)
                                        </h2>
                                        <span
                                            class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"
                                            style="margin-top:40px !important">{{ $data_persen_expenditure }}%</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                        {{ $data_expenditure }} % dari bulan lalu
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h4 class="card-title mb-0">Earning Statistics</h4>

                                </div>
                                <div class="pl-4 mb-5">

                                    <canvas id="myChart" class="position-relative"></canvas>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card-group">
                    <div class="card border-right mr-2 ml-2">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-left">
                                <h3 class="text-dark font-weight-normal mb-3 w-100 text-truncate">
                                    Income Records
                                </h3>
                            </div>
                            <li style="list-style-type: none;">


                            </li>

                        </div>
                    </div>
                    <div class="card border-right mr-2 ml-2">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-left">
                                <h3 class="text-dark font-weight-normal mb-3 w-100 text-truncate">
                                    Outcome Records
                                </h3>
                            </div>

                            <li style="list-style-type: none;">


                            </li>

                        </div>
                    </div>

                    <div class="card border-right  mr-2 ml-2">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-left">
                                <h3 class="text-dark font-weight-normal mb-3 w-100 text-truncate">
                                    Activity History
                                </h3>

                            </div>

                        </div>
                    </div>

                </div> --}}
            </div>

        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= $bulangrafik ?>,
                datasets: [{
                        label: 'Pemasukan',
                        data: <?= $pemasukangrafik ?>,
                        backgroundColor: 'rgba(0, 0, 0, 0)',
                        borderColor: 'rgba(0, 0, 255)',
                    },
                    {
                        label: 'pengeluaran',
                        data: <?= $pengeluarangrafik ?>,
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

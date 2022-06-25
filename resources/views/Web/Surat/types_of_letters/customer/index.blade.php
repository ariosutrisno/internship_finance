@extends('Web.Layouts.app')
@section('title', 'Daftar Pelanggan')
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
                                            <img src="{{ asset('frontend/img/Page-1.png') }}" alt="Hutang">
                                        </div>
                                        <div class="col-sm-10 ml-3">
                                            <span class="h1 text-cyan"><strong>Daftar Pelanggan</strong></span>
                                            <br><span>buat gambar eksport dan berikan kepada orang lain</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <li style="list-style-type: none;">
                                        <span class="text-danger">Jumlah </span>
                                    </li>
                                    @if ($customer_index !== 0)
                                        <li style="list-style-type: none;"><span class="h2"><strong>
                                                    {{ count($customer_index) }}
                                                    Pelanggan</strong></span></li>
                                    @else
                                        <li style="list-style-type: none;"><span class="h2"><strong> Tidak Ada
                                                    Pelanggan</strong></span></li>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card overflow-hidden">
                        <div class="card-body border-bottom  shadow-sm p-3 bg-white rounded">


                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->


                            <div class="row p-3">
                                <div class="col-md-4">
                                    <a class="btn tombol btn-primary" style="width:50%"
                                        href="{{ route('create_Customer') }}" role="button">Create</a>
                                </div>
                                <div class="col-md-8 ">

                                    <div class="row float-right ">
                                        <form action="" class="float-right">
                                            <div class="form-row float right">
                                                <div id="mol" class="form-group mr-5">
                                                    <input
                                                        class="form-control customize-input custom-shadow custom-radius border-0 bg-white"
                                                        type="text" placeholder="Search" aria-label="Search"
                                                        id="search" />
                                                    <!-- <i class="form-control-icon text-left" data-feather="search"></i> -->
                                                </div>


                                        </form>
                                    </div>

                                </div>
                            </div>



                        </div>
                        <div class="container bg-white p-3 mb-5" style="height: 100%;">

                            <div class="table-responsive mt-4 mb-5 ">
                                @if (count($customer_index) !== 0)
                                    <table class="table  table-bordered table-sm" id="coba">
                                        <thead>
                                            <tr class="text-center" id="tr">
                                                <th>No</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Tanggal</th>
                                                <th>Alamat</th>
                                                <th>Perusahaan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 0; ?>
                                        @foreach ($customer_index as $datas)
                                            <tbody id="tbody">
                                                <tr class="table-primary">
                                                    <th scope="row" class="text-center ">{{ ++$i }}</th>
                                                    <td class="text-center">{{ ucwords($datas->name_customer) }}</td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($datas->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ ucwords($datas->address_company_customer) }}</td>
                                                    <td class="text-center">{{ ucwords($datas->company_customer) }}</td>
                                                    <td class="text-center">

                                                        <a href="{{ url('letter/customer/' . $datas->id_customer . '/view') }}"
                                                            class="ml-auto mr-1"><img
                                                                src="{{ asset('frontend/img/Page-5.png') }}"
                                                                style="max-width: 28px !important; max-height: 28px !important;"></a>
                                                        <a href="{{ url('letter/customer/' . $datas->id_customer . '/delete/') }}"
                                                            class="mr-auto ml-1"><img
                                                                src="{{ asset('frontend/img/quit.png') }}"
                                                                style="max-width: 48px !important; max-height: 48px !important;"></a>
                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                @else
                                    <h4>Tidak Ada Pelanggan</h4>
                                @endif
                            </div>
                            <div class="float-right">

                                {{ $customer_index->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            //search
            $(document).ready(function() {
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#tbody tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endsection

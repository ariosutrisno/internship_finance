<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Offering</title>
    <link rel="stylesheet" href="frontend/Print/print_quotation.css">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/Print/print_quotation.css') }}"> --}}
</head>

<body>
    <header>
        {{-- <img src="{{ asset('frontend/img/Kop-Surat-Alan-2020.png') }}" width="100%" alt="alan-kop"> --}}
        <img src="frontend/img/Kop-Surat-Alan-2020.png" width="100%" alt="alan-kop">
    </header>
    <div class="container-info">
        <table class="nav-info">
            <thead>
                <tr>
                    <th class="th_info" colspan="2">
                        <p style="font-size: 25px">Quotation</p>
                    </th>
                    <th class="th_info" colspan="2">
                        <p>Alamat Tagihan</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td_info">
                        <p>No.Quotation</p>
                    </td>
                    <td class="td_info1">
                        <p>: {{ $print_id_quotation->nomor_surat }}</p>
                    </td>
                    <td class="td_info">
                        <p>Nama</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_quotation->name_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Tanggal Quotation</p>
                    </td>
                    <td class="td_info1">
                        <p>: {{ \Carbon\Carbon::parse($print_id_quotation->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                        </p>
                    </td>
                    <td class="td_info">
                        <p>Instansi</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_quotation->company_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Jatuh Tempo</p>
                    </td>
                    <td class="td_info1">
                        <p>:
                            <span
                                style="font-weight:bold;">{{ \Carbon\Carbon::parse($print_id_quotation->tgl_jatuh_tempo)->locale('id')->isoformat('DD MMMM Y') }}
                            </span>
                        </p>
                    </td>
                    <td class="td_info">
                        <p>Alamat Instansi</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_quotation->address_company_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Perihal</p>
                    </td>
                    <td class="td_info1">
                        <p>: {{ $print_id_quotation->perihal }}</p>
                    </td>
                    <td class="td_info">
                        <p>Kontak</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_quotation->phone_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Status</p>
                    </td>
                    <td class="td_info1" colspan="3">
                        <p>:
                            <span style="color: red;font-weight:bold;">Unpaid</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container-info_project">
        <table class="nav-info_project">
            <thead>
                <tr>
                    <th class="th_info_project_number">
                        <p class="p_info_project_th">NO</p>
                    </th>
                    <th class="th_info_project_nama">
                        <p class="p_info_project_th">NAMA PROJECT</p>
                    </th>
                    <th class="th_info_project_biaya">
                        <p class="p_info_project_th"> BIAYA</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($item_id_quotation as $item)
                    <tr>
                        <td class="td_info_project_item1">
                            <p class="p_info_project_number">{{ ++$i }}</p>
                        </td>
                        <td class="td_info_project_item2">
                            <p class="p_info_project_name">{{ $item->nama_project }}</p>
                        </td>
                        <td class="td_info_project_item3">
                            <p class="p_info_project_biaya">@currency($item->biaya_project)</p>
                        </td>
                    </tr>
                @endforeach
                <?php
                $c = $print_id_quotation->pembayaran;
                $d = $c * 0.1;
                $e = $d + $c;
                ?>
                <tr>
                    <td class="td_info_project_ppn" colspan="2">
                        <p class="p_info_project1">PPN(10%)</p>
                    </td>
                    <td class="td_info_project1">
                        <p class="p_info_project_biaya">@currency($print_id_quotation->pembayaran)</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info_project_ttlBiaya" colspan="2">
                        <p class="p_info_project2">Total Biaya Project</p>
                    </td>
                    <td class="td_info_project2">
                        <p class="p_info_project_biaya"> @currency($e)</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container-keterangan">
        <table class="nav-info_keterangan">
            <thead>
                <tr>
                    <th class="th_info_keterangan">
                        <p class="p_info_keterangan">Catatan :</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td_info_keterangan">
                        <p class="p_info_keterangan1">Pembayaran dilakukan secara transfer ke nomor rekening <b>Bank
                                Mandiri 161-00-03-700-27-0
                                atas nama</b> PT Alan Mediatech Indonesia</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container-ttd">
        <table class="nav-info_ttd">
            <thead>
                <tr>
                    <th class="th_info_ttd">
                        <p class="p_info_ttd">Depok,
                            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td_info_ttd">
                        <p class="p_info_ttd">Chief Executive Officer</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info_ttd">
                        <p class="p_info_ttd_seo">Ahmad Alimuddin, S.Kom</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <footer>
        <img src="frontend/img/Kopsurat_footer_2020.jpg" alt="footer" width='100%'>
        {{-- <img src="{{ asset('frontend/img/Kopsurat_footer_2020.jpg') }}" alt="alan-footer" width='100%'> --}}
    </footer>
    <script>
        window.print();
    </script>
</body>

</html>

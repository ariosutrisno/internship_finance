<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Offering</title>
    {{-- <link rel="stylesheet" href="frontend/Print/print_quotation.css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/Print/print_invoice.css') }}">
</head>

<body>
    <header>
        <img src="{{ asset('frontend/img/Kop-Surat-Alan-2020.png') }}" width="100%" alt="alan-kop">
        {{-- <img src="frontend/img/Kop-Surat-Alan-2020.png" width="100%" alt="alan-kop"> --}}
    </header>
    <div class="container-info">
        <table class="nav-info">
            <thead>
                <tr>
                    <th class="th_info" colspan="2">
                        <p class="p_info">Invoice</p>
                    </th>
                    <th class="th_info" colspan="2">
                        <p class="p_info">Alamat Tagihan</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td_info">
                        <p>No.Invoice</p>
                    </td>
                    <td class="td_info1">
                        <p>: {{ $print_id_invoice->nomor_surat }}</p>
                    </td>
                    <td class="td_info">
                        <p>Nama</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_invoice->name_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Tanggal Invoice</p>
                    </td>
                    <td class="td_info1">
                        <p>: {{ $print_id_invoice->created_at }}</p>
                    </td>
                    <td class="td_info">
                        <p>Instansi</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_invoice->company_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Jatuh Tempo</p>
                    </td>
                    <td class="td_info1">
                        <p>: {{ $print_id_invoice->jatuh_tempo_invoice }}</p>
                    </td>
                    <td class="td_info">
                        <p>Alamat Instansi</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_invoice->address_company_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Perihal</p>
                    </td>
                    <td class="td_info1">
                        <p>:{{ $print_id_invoice->perihal }}</p>
                    </td>
                    <td class="td_info">
                        <p>Kontak</p>
                    </td>
                    <td class="td_info2">
                        <p>: {{ $print_id_invoice->phone_customer }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info">
                        <p>Status</p>
                    </td>
                    <td class="td_info">
                        <p>: Unpaid</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container-info_project">
        <table class="nav-info_project">
            <thead>
                <tr>
                    <th class="th_info_project">
                        <p class="p_info_project_th">NO</p>
                    </th>
                    <th class="th_info_project">
                        <p class="p_info_project_th">NAMA PROJECT</p>
                    </th>
                    <th class="th_info_project">
                        <p class="p_info_project_th"> BIAYA</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($item_project as $item)
                    <tr>
                        <td class="td_info_project">
                            <p class="p_info_project_th">{{ ++$i }}</p>
                        </td>
                        <td class="td_info_project">
                            <p class="p_info_project_name">{{ $item->nama_project }}</p>
                        </td>
                        <td class="td_info_project">
                            <p class="p_info_project_biaya">@currency($item->biaya_project)</p>
                        </td>
                    </tr>
                @endforeach
                <?php
                $c = $print_id_invoice->pembayaran;
                $d = $c * 0.1;
                $e = $d + $c;
                ?>
                <tr>
                    <td class="td_info_project1" colspan="2">
                        <p class="p_info_project1">Sub Total</p>
                    </td>
                    <td class="td_info_project">
                        <p class="p_info_project_biaya">@currency($print_id_invoice->pembayaran)</p>
                    </td>
                </tr>
                <tr>
                    <td class="td_info_project2" colspan="2">
                        <p class="p_info_project2">Total +PPN 10%</p>
                    </td>
                    <td class="td_info_project" colspan="2">
                        <p class="p_info_project_biaya">@currency($e)</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container-info_term">
        <table class="nav-info_term">
            <tbody>
                <tr>
                    <td class="td_info_term" colspan="2">
                        <p class="p_info_term">DP</p>
                    </td>
                    <td class="td_info_term_biaya">
                        <p class="p_info_term_center">@currency($term1->DP)</p>
                    </td>
                </tr>
                @foreach ($term as $item)
                    <tr>
                        <td class="td_info_term" colspan="2">
                            <p class="p_info_term">Term {{ $item->termin }}</p>
                        </td>
                        <td class="td_info_term_biaya">
                            <p class="p_info_term_center">@currency($item->term) </p>
                        </td>
                    </tr>
                @endforeach
                <?php
                $c = $term1->term;
                $d = $c * 0.1;
                $e = $d + $c;
                ?>
                <tr>
                <tr>
                    <td class="td_info_term" colspan="2">
                        <p class="p_info_term">Jumlah Tertagih</p>
                    </td>
                    <td class="td_info_term_biaya" colspan="2">
                        <p class="p_info_term_center">@currency($e)</p>
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
                        <p>Pembayaran dilakukan secara transfer ke nomor rekening <b>Bank Mandiri 161-00-03-700-27-0
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
                        <p class="p_info_ttd">Depok, 08 Juli 2022</p>
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
        {{-- <img src="frontend/img/Kopsurat_footer_2020.jpg" alt="footer" width='100%'> --}}
        <img src="{{ asset('frontend/img/Kopsurat_footer_2020.jpg') }}" alt="alan-footer" width='100%'>
    </footer>
    <script>
        window.print();
    </script>
</body>

</html>

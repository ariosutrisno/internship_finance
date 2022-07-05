<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Offering</title>
    <link rel="stylesheet" href="frontend/Print/print_offering.css">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/Print/print_offering.css') }}"> --}}
</head>

<body>
    <header>
        {{-- <img src="{{ asset('frontend/img/Kop-Surat-Alan-2020.png') }}" width="100%" alt="alan-kop"> --}}
        <img src="frontend/img/Kop-Surat-Alan-2020.png" width="100%" alt="alan-kop">
    </header>
    <nav>
        <div class="container">
            @if ($id_print_offering->letter_peruntukan == 'Internship')
                <table class="tabNav">
                    <thead>
                        <tr>
                            <th class="thOne">
                                <span class="spanOne">Nomor</span>
                            </th>
                            <th class="thTwo">
                                <span class="spanOne">: {{ $id_print_offering->nomor_surat }}</span>
                            </th>
                        </tr>
                        <tr>
                            <th class="thOne">
                                <span class="spanOne">Perihal</span>
                            </th>
                            <th class="thTwo">
                                <span class="spanOne">: Konfirmasi Intership</span>
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="contents">
                    <thead>
                        <tr>
                            <th class="thOneContents">
                                <span class="span_Contents">
                                    Hello,
                                    {{ ucwords($id_print_offering->letter_nama) }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="thTwoContents">
                                <span class="span_Contents">
                                    Berdasarkan lamaran internship anda pada tanggal
                                    {{ \Carbon\Carbon::parse($id_print_offering->created_at)->locale('id')->isoFormat(' D MMMM Y') }}
                                    melalui email <a href="mailto:someone@example.com">karir@alan.co.id</a>. Hasil
                                    interview, dan hasil tugas yang diberikan, maka dengan ini kami ingin mengabarkan
                                    bahwa
                                    anda DITERIMA untuk melaksanakan INTERNSHIP di Alan Creative yang bernaung dibawah
                                    PT.
                                    Alan Mediatech Indonesia.
                                    <br>Adapun jadwal pelaksanaan internship di Alan Creative akan
                                    dilaksanakan dengan rincian sebagai berikut:
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="tbl_waktu">
                    <thead>
                        <tr>
                            <th id="tbl_waktuOne">
                                <span>
                                    Hari dan Tanggal Mulai
                                </span>
                            </th>
                            <th id="tbl_waktuOne1">
                                <span>
                                    :
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_mulai)->locale('id')->isoFormat(' D MMMM Y') }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">
                                <span>Hari dan Tanggal Selesai</span>
                            </th>
                            <th id="tbl_waktuOne1">
                                <span>
                                    :
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_selesai)->locale('id')->isoFormat(' D MMMM Y') }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">
                                <span>Jadwal Masuk</span>
                            </th>
                            <th id="tbl_waktuOne1">
                                <span>: Senin - Jumat</span>
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">
                                <span>Waktu Masuk</span>
                            </th>
                            <th id="tbl_waktuOne1">
                                <span>
                                    :
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_mulai)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_selesai)->format('H:i') }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">
                                <span>
                                    Pembimbing
                                </span>
                            </th>
                            <th id="tbl_waktuOne1">
                                <span>
                                    :
                                    {{ ucwords($id_print_offering->letter_pembimbing) }}
                            </th>
                            </span>
                        </tr>
                    </thead>
                </table>
                <table class="contents2">
                    <thead>
                        <tr>
                            <th class="thOnContents2">
                                <span class="spanContents2">
                                    Demikian informasi penerimaan internship ini kami sampaikan, jika ada yang ingin
                                    ditanyakan dapat langsung menghubungi kami melalui email atau nomor yang tertera.
                                    Atas Perhatian dan kerjasamanya, kami ucapkan terima kasih.
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="tbl_ttd_internship">
                    <thead>
                        <tr>
                            <th class="th_ttd_internship">Depok,
                                {{ \Carbon\Carbon::parse($id_print_offering->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                            </th>
                        </tr>
                        <tr>
                            <th class="th_ttd_internship">Chief Executive Officer</th>
                        </tr>
                        <tr>
                            <th class="th_ttd_internship1">Ahmad Alimuddin, S.Kom</th>
                        </tr>
                    </thead>
                </table>
            @else
                <table class="tbl_karyawan">
                    <thead>
                        <tr>
                            <th class="th_karyawan">
                                <span class="span_karyawan">
                                    Yth. Saudara
                                    <b>
                                        {{ ucwords($id_print_offering->letter_nama) }}
                                    </b>
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_karyawan">
                                <span class="span_karyawan">
                                    Di Tempat
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td_karyawan">
                                <span class="span_karyawan">
                                    <b>Dengan Hormat,</b>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_karyawan">
                                <span class="span_karyawan">
                                    Sehubungan dengan surat lamaran kerja yang Anda kirimkan ke
                                    perusahaan kami beberapa waktu
                                    lalu dan telah melalui proses seleksi berupa wawancara dan tes psikologi, maka
                                    dengan ini kami
                                    memberitahukan bahwa Anda diterima bekerja di perusahaan kami. Mohon kehadirannya
                                    pada:
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="tbl_waktu_karyawan">
                    <thead>
                        <tr>
                            <th class="th_waktu_karyawan" style="width: 20%">
                                <span class="span_waktu1">Hari dan Tanggal</span>
                            </th>
                            <th class="th_waktu_karyawan">
                                <span class="span_waktu2">:
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_mulai)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_waktu_karyawan">
                                <span>Tempat</span>
                            </th>
                            <th class="th_waktu_karyawan">
                                <span>
                                    : PT Alan Mediatech Indonesia
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_waktu_karyawan">
                                <span></span>
                            </th>
                            <th class="th_waktu_karyawan">
                                <span>
                                    Graha Mandiri, Blok B-5, Jl. Tugu Raya, Kelurahan Tugu, Cimanggis,
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_waktu_karyawan">
                                <span></span>
                            </th>
                            <th class="th_waktu_karyawan">
                                <span>
                                    Depok, Jawa Barat
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_waktu_karyawan">
                                <span>Waktu</span>
                            </th>
                            <th class="th_waktu_karyawan">
                                <span> :
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_mulai)->locale('id')->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($id_print_offering->letter_date_selesai)->locale('id')->format('H:i') }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_waktu_karyawan">
                                <span>Narahubung</span>
                            </th>
                            <th class="th_waktu_karyawan">
                                <span> :
                                    {{ $id_print_offering->letter_telepon_pembimbing }} (
                                    {{ $id_print_offering->letter_pembimbing }} )
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="tbl_penutup">
                    <thead>
                        <tr>
                            <th class="th_penutup">
                                <span>
                                    Kami harapkan kedatangan saudari di tempat dan waktu yang telah ditetapkan
                                    tersebut. Apabila ada kendala perihal kehadiran, mohon dapat menginformasikan hal
                                    tersebut kepada
                                    kami.
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_penutup2">
                                <span>
                                    Demikian yang dapat kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan
                                    terima
                                    kasih.
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="tbl_ttd_karyawan">
                    <thead>
                        <tr>
                            <th class="th_ttd_karyawan">
                                <span class="span_ttd_karyawan">
                                    Depok,
                                    {{ \Carbon\Carbon::parse($id_print_offering->created_at)->locale('id')->isoformat('DD MMMM Y') }}
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_ttd_karyawan">
                                <span class="span_ttd_karyawan">
                                    Chief Executive Officer
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th class="th_ttd_karyawan2">
                                <span class="span_ttd_karyawan">
                                    Ahmad Alimuddin, S.Kom
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
            @endif

        </div>
    </nav>
    <footer>
        <img src="frontend/img/Kopsurat_footer_2020.jpg" alt="footer" width='100%'>
        {{-- <img src="{{ asset('frontend/img/Kopsurat_footer_2020.jpg') }}" alt="" width='100%'> --}}
    </footer>
    <script>
        window.print();
    </script>
</body>

</html>

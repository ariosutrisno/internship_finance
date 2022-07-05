<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Offering</title>
    {{-- <link rel="stylesheet" href="frontend/Print/print_offering.css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/Print/print_offering.css') }}">
</head>

<body>
    <header>
        <img src="{{ asset('frontend/img/Kop-Surat-Alan-2020.png') }}" width="100%" alt="alan-kop">
    </header>
    <nav>
        <div class="container">
            @if ($id_print_offering->letter_peruntukan == 'Internship')
                <table class="tabNav">
                    <tr>
                        <th width="10%" id="thOne">
                            <span id="spanOne">Nomor</span>
                        </th>
                        <th width="40%" id="thTwo">
                            <span id="spanTwo">: {{ $id_print_offering->nomor_surat }}</span>
                        </th>
                    </tr>
                    <tr>
                        <th width="10%" id="thOne">
                            <span id="spanOne">Perihal</span>
                        </th>
                        <th width="40%" id="thTwo">
                            <span id="spanTwo">: Konfirmasi Intership</span>
                        </th>
                    </tr>
                </table>
                <table class="contents">
                    <thead>
                        <tr>
                            <th id="thOneContents" width="10%">Hello,
                                {{ ucwords($id_print_offering->letter_nama) }}</th>
                        </tr>
                        <tr>
                            <th id="thTwoContents" width="10%">Berdasarkan lamaran internship anda pada tanggal
                                {{ \Carbon\Carbon::parse($id_print_offering->created_at)->locale('id')->isoFormat(' D MMMM Y') }}
                                melalui email <a href="mailto:someone@example.com">karir@alan.co.id</a>. Hasil
                                interview, dan hasil tugas yang diberikan, maka dengan ini kami ingin mengabarkan bahwa
                                anda DITERIMA untuk melaksanakan INTERNSHIP di Alan Creative yang bernaung dibawah PT.
                                Alan Mediatech Indonesia.
                                <br>Adapun jadwal pelaksanaan internship di Alan Creative akan
                                dilaksanakan dengan rincian sebagai berikut:
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="tbl_waktu">
                    <thead>
                        <tr>
                            <th id="tbl_waktuOne">Hari dan Tanggal Mulai</th>
                            <th id="tbl_waktuOne">:
                                {{ \Carbon\Carbon::parse($id_print_offering->letter_date_mulai)->locale('id')->isoFormat(' D MMMM Y') }}
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">Hari dan Tanggal Selesai</th>
                            <th id="tbl_waktuOne">:
                                {{ \Carbon\Carbon::parse($id_print_offering->letter_date_selesai)->locale('id')->isoFormat(' D MMMM Y') }}
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">Jadwal Masuk</th>
                            <th id="tbl_waktuOne">: Senin - Jumat</th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">Waktu Masuk</th>
                            <th id="tbl_waktuOne">:
                                {{ \Carbon\Carbon::parse($id_print_offering->letter_date_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($id_print_offering->letter_date_selesai)->format('H:i') }}
                            </th>
                        </tr>
                        <tr>
                            <th id="tbl_waktuOne">Pembimbing</th>
                            <th id="tbl_waktuOne">:
                                {{ ucwords($id_print_offering->letter_pembimbing) }}</th>
                        </tr>
                    </thead>
                </table>
                <table class="contents2">
                    <thead>
                        <tr>
                            <th id="thOnContents2" width="10%">
                                Demikian informasi penerimaan internship ini kami sampaikan, jika ada yang ingin
                                ditanyakan dapat langsung menghubungi kami melalui email atau nomor yang tertera. Atas
                                Perhatian dan kerjasamanya,
                                kami ucapkan terima kasih.
                            </th>
                        </tr>
                    </thead>
                </table>
                <table class="tbl_ttd">
                    <thead>
                        <tr>
                            <th class="td_ttd">Chief Executive Officer</th>
                        </tr>
                        <tr>
                            <th class="td_ttd2">Ahmad Alimuddin, S.Kom</th>
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
        <img src="{{ asset('frontend/img/Kopsurat_footer_2020.jpg') }}" alt="" width='100%'
            style="bottom:0">
    </footer>
    <script>
        window.print();
    </script>
</body>

</html>

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class InvoiceLetterController extends Controller
{
    function auth()
    {
        return Auth::id();
    }
    public function index_InvoiceLetter()
    {
        $all_request_invoice = DB::table('tbl_invoice')->where('id_users', '=', $this->auth())->orderByDesc('created_at')->paginate('10');
        return view('Web.Surat.types_of_letters.invoice.index', compact([
            'all_request_invoice',
        ]));
    }
    public function create_InvoiceLetter()
    {
        $bulan_romawi = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        $Awal = 'ALAN-C';
        $noUrutAkhir = DB::table('tbl_invoice')->where('id_users', '=', $this->auth())->max('nomor_surat');
        $nomor_surat = sprintf("%03s", abs($noUrutAkhir) + 1) . '/' . $Awal . '/' . $bulan_romawi[date('n')] . '/' . date('Y');
        if ($noUrutAkhir) {
            $nomor_surat;
        }
        $customer = DB::table('tbl_customer')->get();
        return view('Web.Surat.types_of_letters.invoice.create', compact([
            'nomor_surat',
            'customer'
        ]));
    }
    public function save_InvoiceLetter(Request $request)
    {
        $request->validate(
            [
                'id_customer' => 'required',
                'sp' => 'required',
                'perihal' => 'required',
                'catatan' => 'required',
                'dikirim' => 'required|date_format:Y-m-d',
                'tempo' => 'required|date_format:Y-m-d',
            ],
            [
                'perihal.required' => 'Isi Input Perihal Ini.',
                'catatan.required' => 'Tuliskan Catatan Tersebut',
                'id_customer.required' => 'Silahkan pilih satu nama customer',
                'dikirim.required' => 'Isi Tanggal Dikirim',
                'tempo.required' => 'Isi Tanggal Jatuh Tempo',
                'sp.required' => 'Pilih Salah Satu',
            ]
        );
        DB::table('tbl_invoice')->insert([
            'id_users' => $this->auth(),
            'id_customer' => $request->id_customer,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->dikirim . date('H:i:s'))),
            'jatuh_tempo_invoice' => date('Y-m-d H:i:s', strtotime($request->tempo . date('H:i:s'))),
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'catatan_keterangan' => $request->catatan,
            'pembayaran' => $request->pembayaran,
        ]);
        $id_invoice = DB::getPdo()->lastInsertId();
        if (count($request['np'])) {
            # code...
            foreach ($request['np'] as $key => $value) {
                # code...   
                $request2 = array(
                    'id_invoice' => $id_invoice,
                    'nama_project' => $request['np'][$key],
                    'biaya_project' => $request['cp'][$key],
                );
                DB::table('tbl_item_project')->insert($request2);
            }
        }
        if ($request['sp'] == 'standar') {
            # code...
            foreach ($request['terminstandar'] as $key => $value) {
                # code...
                $request3 = array(
                    'id_invoice' => $id_invoice,
                    'standar_pembayaran' => $request['sp'],
                    'Dp' => $request['dpstandar'],
                    'term' => $request['terminstandar'][$key],
                );
                DB::table('tbl_term')->insert($request3);
            }
        }
        if ($request['sp'] == 'medium') {
            # code...
            foreach ($request['terminmedium'] as $medium => $value) {
                # code...
                $request4 =  array(
                    'id_invoice' => $id_invoice,
                    'standar_pembayaran' => $request['sp'],
                    'Dp' => $request['dpmedium'],
                    'term' => $request['terminmedium'][$medium],
                );
                DB::table('tbl_term')->insert($request4);
            }
        }
        if ($request['sp'] == 'high') {
            # code...
            foreach ($request['terminhigh'] as $high => $value) {
                # code...
                $request5 = array(
                    'id_invoice' => $id_invoice,
                    'standar_pembayaran' => $request['sp'],
                    'Dp' => $request['dphigh'],
                    'term' => $request['terminhigh'][$high],
                );
                DB::table('tbl_term')->insert($request5);
            }
        }
        return redirect()->route('index_InvoiceLetter')->with('success', 'Data Telah Ditambahkan');
    }
    public function view_InvoiceLetter($id_invoice)
    {

        $id_invoice_letter = DB::table('tbl_invoice')->where('tbl_invoice.id_users', '=', $this->auth())->where('tbl_invoice.id_invoice', '=', $id_invoice)
            ->join('tbl_customer', 'tbl_invoice.id_customer', '=', 'tbl_customer.id_customer')
            ->select('tbl_invoice.*', 'tbl_customer.*',)
            ->first();
        $customer = DB::table('tbl_customer')->get();
        $term = DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->first();
        $jtagihan = $id_invoice_letter->pembayaran;
        $ppn = $jtagihan * 0.1;
        $total = $jtagihan + $ppn;
        $termget = DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->get();
        $item_project = DB::table('tbl_item_project')->where('id_invoice', '=', $id_invoice)->get();
        $termin = json_encode($term);
        return view('Web.Surat.types_of_letters.invoice.edit', compact([
            'id_invoice_letter',
            'customer',
            'total',
            'termget',
            'termin',
            'item_project',
            'term'
        ]));
    }
    public function update_InvoiceLetter(Request $request, $id_invoice)
    {
        $request->validate(
            [
                'id_customer' => 'required',
                'sp' => 'required',
                'perihal' => 'required',
                'catatan_keterangan' => 'required',
                'created_at' => 'required|date_format:Y-m-d',
                'jatuh_tempo_invoice' => 'required|date_format:Y-m-d',
            ],
            [
                'perihal.required' => 'Isi Input Perihal Ini.',
                'catatan_keterangan.required' => 'Tuliskan Catatan Tersebut',
                'id_customer.required' => 'Silahkan pilih satu nama customer',
                'created_at.required' => 'Isi Tanggal Dikirim',
                'jatuh_tempo_invoice.required' => 'Isi Tanggal Jatuh Tempo',
                'sp.required' => 'Pilih Salah Satu',
            ]
        );
        DB::table('tbl_invoice')->where('id_invoice', '=', $id_invoice)->update([
            'id_customer' => $request->id_customer,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at . date('H:i:s'))),
            'jatuh_tempo_invoice' => date('Y-m-d H:i:s', strtotime($request->jatuh_tempo_invoice . date('H:i:s'))),
            'perihal' => $request->perihal,
            'catatan_keterangan' => $request->catatan_keterangan,
            'pembayaran' => $request->pembayaran,
        ]);
        if (count($request['np'])) {
            # code...
            DB::table('tbl_item_project')->where('id_invoice', '=', $id_invoice)->delete();
            foreach ($request['np'] as $key => $value) {
                # code...   
                $request2 = array(
                    'id_invoice' => $id_invoice,
                    'nama_project' => $request['np'][$key],
                    'biaya_project' => $request['cp'][$key],
                );
                DB::table('tbl_item_project')->insert($request2);
            }
        }
        if ($request['sp'] == 'standar') {
            # code...
            DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->delete();
            foreach ($request['terminstandar'] as $key => $value) {
                # code...
                $request3 = array(
                    'id_invoice' => $id_invoice,
                    'standar_pembayaran' => $request['sp'],
                    'Dp' => $request['dpstandar'],
                    'term' => $request['terminstandar'][$key],
                );
                DB::table('tbl_term')->insert($request3);
            }
        }
        if ($request['sp'] == 'medium') {
            # code...
            DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->delete();
            foreach ($request['terminmedium'] as $medium => $value) {
                # code...
                $request4 =  array(
                    'id_invoice' => $id_invoice,
                    'standar_pembayaran' => $request['sp'],
                    'Dp' => $request['dpmedium'],
                    'term' => $request['terminmedium'][$medium],
                );
                DB::table('tbl_term')->insert($request4);
            }
        }
        if ($request['sp'] == 'high') {
            # code...
            DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->delete();
            foreach ($request['terminhigh'] as $high => $value) {
                # code...
                $request5 = array(
                    'id_invoice' => $id_invoice,
                    'standar_pembayaran' => $request['sp'],
                    'Dp' => $request['dphigh'],
                    'term' => $request['terminhigh'][$high],
                );
                DB::table('tbl_term')->insert($request5);
            }
        }
        return redirect()->route('index_InvoiceLetter')->with('Success', 'Data Telah Diperbaharui');
    }
    public function delete_InvoiceLetter($id_invoice)
    {
        DB::table('tbl_invoice')->where('id_users', '=', $this->auth())->where('id_invoice', '=', $id_invoice)->delete();
        DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->delete();
        DB::table('tbl_item_project')->where('id_invoice', '=', $id_invoice)->delete();
        return redirect()->route('index_InvoiceLetter');
    }
    public function print_InvoiceLetter($id_invoice)
    {
        $print_id_invoice = DB::table('tbl_invoice')->where('id_invoice', '=', $id_invoice)->where('tbl_invoice.id_users', '=', $this->auth())
            ->join('tbl_customer', 'tbl_invoice.id_customer', '=', 'tbl_customer.id_customer')
            ->select('tbl_invoice.*', 'tbl_customer.*')
            ->first();
        $item_project = DB::table('tbl_item_project')->where('id_invoice', '=', $id_invoice)->get();
        $term = DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->get();
        $term1 = DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->first();
        for ($i = 0; $i < count($term); $i++) {
            # code...
            $termin = $this->KonDecRomawi($i + 1);
            $term[$i]->termin = $termin;
        }
        $pdf = FacadePdf::loadview('Web.Surat.types_of_letters.invoice.print', compact([
            'print_id_invoice',
            'item_project',
            'term',
            'term1'
        ]))->setPaper('A4', 'potrait');
        return $pdf->download('Invoice.pdf');
        // return view('Web.Surat.types_of_letters.invoice.print', compact([
        //     'print_id_invoice',
        //     'item_project',
        //     'term',
        //     'term1'
        // ]));
    }
    function KonDecRomawi($angka)
    {
        $hsl = "";
        if ($angka < 1 || $angka > 5000) {
            // Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
            $hsl = "Batas Angka 1 s/d 5000";
        } else {
            while ($angka >= 1000) {
                // While itu termasuk kedalam statement perulangan
                // Jadi misal variable angka lebih dari sama dengan 1000
                // Kondisi ini akan di jalankan
                $hsl .= "M";
                // jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
                // Varible hsl
                $angka -= 1000;
                // Lalu setelah itu varible angka di kurangi 1000 ,
                // Kenapa di kurangi
                // Karena statment ini mengambil 1000 untuk di konversi menjadi M
            }
        }


        if ($angka >= 500) {
            // statement di atas akan bernilai true / benar
            // Jika var angka lebih dari sama dengan 500
            if ($angka > 500) {
                if ($angka >= 900) {
                    $hsl .= "CM";
                    $angka -= 900;
                } else {
                    $hsl .= "D";
                    $angka -= 500;
                }
            }
        }
        while ($angka >= 100) {
            if ($angka >= 400) {
                $hsl .= "CD";
                $angka -= 400;
            } else {
                $angka -= 100;
            }
        }
        if ($angka >= 50) {
            if ($angka >= 90) {
                $hsl .= "XC";
                $angka -= 90;
            } else {
                $hsl .= "L";
                $angka -= 50;
            }
        }
        while ($angka >= 10) {
            if ($angka >= 40) {
                $hsl .= "XL";
                $angka -= 40;
            } else {
                $hsl .= "X";
                $angka -= 10;
            }
        }
        if ($angka >= 5) {
            if ($angka == 9) {
                $hsl .= "IX";
                $angka -= 9;
            } else {
                $hsl .= "V";
                $angka -= 5;
            }
        }
        while ($angka >= 1) {
            if ($angka == 4) {
                $hsl .= "IV";
                $angka -= 4;
            } else {
                $hsl .= "I";
                $angka -= 1;
            }
        }

        return ($hsl);
    }
    /* JQUERY & JAVASCRIPT */
    public function getAutocompleteData(Request $request)
    {
        if ($request->has('term')) {
            return DB::table('tbl_customer')->where('name_customer', 'like', '%' . $request->input('term') . '%')->get();
        }
    }
    public function jquerycreate($id_quotation)
    {
        $daftar_pelanggan = DB::table('tbl_customer')->where('id_customer', '=', $id_quotation)->first();
        return response()->json($daftar_pelanggan);
    }
    /* JQUERY & JAVASCRIPT */
}

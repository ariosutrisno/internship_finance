<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::table('tbl_invoice')->insert([
            'id_users' => $this->auth(),
            'id_customer' => $request->id_customer,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at . date('H:i:s'))),
            'jatuh_tempo_invoice' => date('Y-m-d H:i:s', strtotime($request->jatuh_tempo_invoice . date('H:i:s'))),
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'catatan_keterangan' => $request->catatan_keterangan,
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
                DB::table('tbl_item_project')->create($request2);
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
                DB::table('tbl_term')->create($request3);
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
                DB::table('tbl_term')->create($request4);
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
                DB::table('tbl_term')->create($request5);
            }
        }
        return redirect()->route('index_InvoiceLetter');
    }
    public function view_InvoiceLetter($id_invoice)
    {

        $id_invoice_letter = DB::table('tbl_invoice')->where('tbl_invoice.id_users', '=', $this->auth())->where('tbl_invoice.id_invoice', '=', $id_invoice)
            ->join('tbl_customer', 'tbl_quotation_letter.id_customer', '=', 'tbl_customer.id_customer')
            ->select('tbl_quotation_letter.*', 'tbl_customer.id_customer', 'tbl_customer.name_customer')
            ->first();
        $customer = DB::table('tbl_customer')->get();
        $term = DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->first();
        $jtagihan = $id_invoice_letter->pembayaran;
        $ppn = $jtagihan * 0.1;
        $total = $jtagihan + $ppn;
        $termget = DB::table('tbl_term')->where('id_invoice', '=', $id_invoice)->get();
        $item_project = DB::table('tbl_item_project')->where('id_invoice', '=', $id_invoice)->first();
        $termin = json_encode($term);
        return view('Web.Surat.types_of_letters.invoice.edit', compact([
            'id_invoice_letter',
            'customer',
            'total',
            'termget',
            'termin',
            'item_project'
        ]));
    }
    public function update_InvoiceLetter(Request $request, $id_invoice)
    {
        DB::table('tbl_invoice')->where('id_invoice', '=', $id_invoice)->update([]);
        return redirect()->route('index_InvoiceLetter');
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
        $print_id_invoice = DB::table('tbl_invoice')->where('id_invoice', '=', $id_invoice)->where('id_users', '=', $this->auth())->first();
        return view('Web.Surat.types_of_letters.invoice.print', compact([
            'print_id_invoice'
        ]));
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationLetterController extends Controller
{
    function auth()
    {
        return Auth::id();
    }
    public function index_QuotationLetter()
    {
        $all_data_quotation = DB::table('tbl_quotation_letter')->where('id_users', '=', $this->auth())->orderByDesc('created_at')->paginate('10');
        return view('Web.Surat.types_of_letters.quotation.index', compact([
            'all_data_quotation',
        ]));
    }
    public function create_QuotationLetter()
    {
        $bulan_romawi = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        $Awal = 'ALAN-C';
        $noUrutAkhir = DB::table('tbl_quotation_letter')->where('id_users', '=', $this->auth())->max('nomor_surat');
        $nomor_surat = sprintf("%03s", abs($noUrutAkhir) + 1) . '/' . $Awal . '/' . $bulan_romawi[date('n')] . '/' . date('Y');
        if ($noUrutAkhir) {
            $nomor_surat;
        }
        $customer = DB::table('tbl_customer')->get();
        return view('Web.Surat.types_of_letters.quotation.create', compact([
            'nomor_surat',
            'customer'
        ]));
    }
    public function save_QuotationLetter(Request $request)
    {
        DB::table('tbl_quotation_letter')->insert([
            'id_users' => $this->auth(),
            'id_customer' => $request->id_customer,
            'nomor_surat' => $request->nomor_surat,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at . date('H:i:s'))),
            'tgl_jatuh_tempo' => date('Y-m-d H:i:s', strtotime($request->tgl_jatuh_tempo . date('H:i:s'))),
            'perihal' => $request->perihal,
            'pembayaran' => $request->pembayaran,
            'catatan_keterangan' => $request->catatan_keterangan,
        ]);
        $id_quotation = DB::getPdo()->lastInsertId();
        if (($request['np'] > 0)) {
            # code...
            foreach ($request['np'] as $key => $value) {
                # code...
                $data2 = array(
                    'id_quotation' => $id_quotation,
                    'nama_project' => $request['np'][$key],
                    'biaya_project' => $request['cp'][$key],
                );
                DB::table('tbl_item_project')->create($data2);
            }
        }
        return redirect()->route('index_QuotationLetter');
    }
    public function view_QuotationLetter($id_quotation)
    {
        $id_quotation_letter = DB::table('tbl_quotation_letter')
            ->where('.tbl_quotation_letter.id_users', '=', $this->auth())->where('tbl_quotation_letter.id_quotation', '=', $id_quotation)
            ->join('tbl_customer', 'tbl_quotation_letter.id_customer', '=', 'tbl_customer.id_customer')
            ->select('tbl_quotation_letter.*', 'tbl_customer.id_customer', 'tbl_customer.name_customer')
            ->first();
        $item_id_quotation = DB::table('tbl_item_project')->where('id_quotation', '=', $id_quotation)->first();
        return view('Web.Surat.types_of_letters.quotation.edit', compact([
            'id_quotation_letter',
            'item_id_quotation'
        ]));
    }
    public function update_QuotationLetter(Request $request, $id_quotation)
    {
        DB::table('tbl_quotation_letter')->where('id_quotation', '=', $id_quotation)->update([
            'id_customer' => $request->id_customer,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at . date('H:i:s'))),
            'tgl_jatuh_tempo' => date('Y-m-d H:i:s', strtotime($request->tgl_jatuh_tempo . date('H:i:s'))),
            'perihal' => $request->perihal,
            'pembayaran' => $request->pembayaran,
            'catatan_keterangan' => $request->catatan_keterangan,
        ]);
        $id_quotation = DB::getPdo()->lastInsertId();
        if (($request['np'] > 0)) {
            # code...
            DB::table('tbl_item_project')->where('id_quotation', '=', $id_quotation)->delete();
            foreach ($request['np'] as $key => $value) {
                # code...
                $data2 = array(
                    'id_quotation' => $id_quotation,
                    'nama_project' => $request['np'][$key],
                    'biaya_project' => $request['cp'][$key],
                );
                DB::table('tbl_item_project')->create($data2);
            }
        }
        return redirect()->route('index_QuotationLetter');
    }
    public function delete_QuotationLetter($id_quotation)
    {
        DB::table('tbl_quotation_letter')->where('id_users', '=', $this->auth())->where('id_quotation', '=', $id_quotation)->delete();
        DB::table('tbl_item_project')->where('id_users', '=', $id_quotation)->delete();
        return redirect()->route('index_QuotationLetter');
    }
    public function print_QuotationLetter($id_quotation)
    {
        $print_id_quotation = DB::table('tbl_quotation_letter')->where('id_quotation', '=', $id_quotation)->where('id_users', '=', $this->auth())->first();
        $item_id_quotation = DB::table('tbl_item_project')->where('id_quotation', '=', $id_quotation)->first();
        return view('Web.Surat.types_of_letters.quotation.print', compact([
            'print_id_quotation',
            'item_id_quotation'
        ]));
    }
}

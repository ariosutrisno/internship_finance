<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class QuotationLetterController extends Controller
{
    function auth()
    {
        return Auth::id();
    }
    public function index_QuotationLetter()
    {
        $id = Auth::user();
        $all_data_quotation = DB::table('tbl_quotation_letter')->where('id_users', '=', $this->auth())->orderByDesc('created_at')->paginate(10);
        return view('Web.Surat.types_of_letters.quotation.index', compact([
            'all_data_quotation',
            'id'
        ]));
    }
    public function create_QuotationLetter()
    {
        $id = Auth::user();
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
            'customer',
            'id'
        ]));
    }
    public function save_QuotationLetter(Request $request)
    {
        $request->validate(
            [
                'name_customer' => 'required',
                'dikirim' => 'required|date_format:Y-m-d',
                'tempo' => 'required|date_format:Y-m-d',
                'perihal' => 'required',
                'catatan' => 'required',
            ],
            [
                'perihal.required' => 'Isi Input Perihal Ini.',
                'catatan.required' => 'Tuliskan Catatan Tersebut',
                'name_customer.required' => 'Silahkan pilih satu nama customer',
                'dikirim.required' => 'Isi Tanggal Dikirim',
                'tempo.required' => 'Isi Tanggal Jatuh Tempo',
            ]
        );
        DB::table('tbl_quotation_letter')->insert([
            'id_users' => $this->auth(),
            'id_customer' => $request->name_customer,
            'nomor_surat' => $request->nomor_surat,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->dikirim . date('H:i:s'))),
            'tgl_jatuh_tempo' => date('Y-m-d H:i:s', strtotime($request->tempo . date('H:i:s'))),
            'perihal' => $request->perihal,
            'pembayaran' => $request->subtotal,
            'catatan_keterangan' => $request->catatan,
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
                DB::table('tbl_item_project')->insert($data2);
            }
        }
        return redirect()->route('index_QuotationLetter')->with(['Data Succes Saved']);
    }
    public function view_QuotationLetter($id_quotation)
    {
        $id_quotation_letter = DB::table('tbl_quotation_letter')
            ->where('.tbl_quotation_letter.id_users', '=', $this->auth())->where('tbl_quotation_letter.id_quotation', '=', $id_quotation)
            ->join('tbl_customer', 'tbl_quotation_letter.id_customer', '=', 'tbl_customer.id_customer')
            ->select('tbl_quotation_letter.*', 'tbl_customer.*',)
            ->first();
        $customer = DB::table('tbl_customer')->get();
        $item_id_quotation = DB::table('tbl_item_project')->where('id_quotation', '=', $id_quotation)->first();
        $item_quotation = DB::table('tbl_item_project')->where('id_quotation', '=', $id_quotation)->get();
        $jpembayaran = $id_quotation_letter->pembayaran;
        $ppn = $jpembayaran * 0.1;
        $total = $jpembayaran + $ppn;
        return view('Web.Surat.types_of_letters.quotation.edit', compact([
            'id_quotation_letter',
            'item_id_quotation',
            'customer',
            'total',
            'item_quotation'
        ]));
    }
    public function update_QuotationLetter(Request $request, $id_quotation)
    {
        $request->validate(
            [
                'name' => 'required',
                'dikirim' => 'required|date_format:Y-m-d',
                'tempo' => 'required|date_format:Y-m-d',
                'perihal' => 'required',
                'catatan' => 'required',
            ],
            [
                'perihal.required' => 'Isi Input Perihal Ini.',
                'catatan.required' => 'Tuliskan Catatan Tersebut',
                'name.required' => 'Silahkan pilih satu nama customer',
                'dikirim.required' => 'Isi Tanggal Dikirim',
                'tempo.required' => 'Isi Tanggal Jatuh Tempo',
            ]
        );
        DB::table('tbl_quotation_letter')->where('id_quotation', '=', $id_quotation)->update([
            'id_customer' => $request->name,
            'created_at' => date('Y-m-d H:i:s', strtotime($request->dikirim . date('H:i:s'))),
            'tgl_jatuh_tempo' => date('Y-m-d H:i:s', strtotime($request->tempo . date('H:i:s'))),
            'perihal' => $request->perihal,
            'pembayaran' => $request->subtotal,
            'catatan_keterangan' => $request->catatan,
        ]);
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
                DB::table('tbl_item_project')->insert($data2);
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
        $print_id_quotation = DB::table('tbl_quotation_letter')->where('id_quotation', '=', $id_quotation)->where('tbl_quotation_letter.id_users', '=', $this->auth())
            ->join('tbl_customer', 'tbl_quotation_letter.id_customer', '=', 'tbl_customer.id_customer')
            ->select('tbl_quotation_letter.*', 'tbl_customer.*')
            ->first();
        $item_id_quotation = DB::table('tbl_item_project')->where('id_quotation', '=', $id_quotation)->get();
        $pdf = FacadePdf::loadview('Web.Surat.types_of_letters.quotation.print', compact([
            'print_id_quotation',
            'item_id_quotation'
        ]))->setPaper('A4', 'potrait');
        return $pdf->download('Quotation Letter.pdf');
        // return view('Web.Surat.types_of_letters.quotation.print', compact([
        //     'print_id_quotation',
        //     'item_id_quotation'
        // ]));
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
    public function jqueryedit($id_quotation)
    {
        $daftar_pelanggan = DB::table('tbl_customer')->where('id_customer', '=', $id_quotation)->first();
        return response()->json($daftar_pelanggan);
    }
    /* JQUERY & JAVASCRIPT */
}

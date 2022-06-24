<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    public function index_Debt()
    {
        $all_debt = DB::table('tbl_hutang')->where('id_users', '=', $this->Auth())
            ->orderByDesc('created_at')
            ->paginate(10);
        $all_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        $all_category = DB::table('tbl_kategori')->get();
        $result_total_debt = DB::table('tbl_hutang')->where('id_users', '=', $this->Auth())->sum('catatan_saldo_hutang');
        return view('Web.Hutang.index', compact([
            'all_debt',
            'all_cash_book',
            'result_total_debt',
            'all_category'
        ]));
    }
    public function save_Debt(Request $request)
    {
        $request->validate(
            [
                'hutang_nominal' => 'required',
                'hutang_deskripsi' => 'required',
                'hutang_client' => 'required',
                'id_kas' => 'required',
                'id_kategori' => 'required'
            ],
            [
                'hutang_nominal.required' => 'isikan dengan nominal.',
                'hutang_deskripsi.required' => 'Jangan Kosong',
                'id_kas.required' => 'Silahkan pilih satu',
                'id_kategori.required' => 'Silahkan pilih satu',
                'hutang_client.required' => 'Tidak boleh kosong',
            ]
        );
        DB::table('tbl_hutang')->insert([
            'id_users' => $this->Auth(),
            'id_buku' => $request->id_kas,
            'hutang_client' => $request->hutang_client,
            'hutang_deskripsi' => $request->hutang_deskripsi,
            'catatan_saldo_hutang' => $request->hutang_nominal,
            'jatuh_tempo_hutang' => date('Y-m-d H:i:s', strtotime($request->hutang_jatuh . date('H:i:s'))),
            'created_at' => date('Y-m-d H:i:s', strtotime($request->hutang_tanggal .  date('H:i:s'))),
        ]);
        $id_hutang = DB::getPdo()->lastInsertId();
        DB::table('tbl_catatan_buku')->insert([
            'id_users' => $this->Auth(),
            'id_buku_kas' => $request->id_kas,
            'id_hutang' => $id_hutang,
            'id_kategori' => $request->id_kategori,
            'catatan_saldo_kas' => $request->hutang_nominal,
            'deskripsi' => $request->hutang_deskripsi,
            'catatan_keterangan' => 'Pemasukan',
            'created_at' => date('Y-m-d H:i:s', strtotime($request->hutang_tanggal . date('H:i:s'))),
        ]);
        $saldo_akhir = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->first();
        DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $request->id_kas)
            ->update(['saldo_buku_akhir' => $saldo_akhir->saldo_buku_akhir += $request->hutang_nominal]);
        return response()->json(['success' => 'Data Saved Success']);
    }
    public function edit_Debt($id_debt)
    {
        /* TAMPILKAN ID FORM DEBT */
        $show_ID_Debt = DB::table('tbl_hutang')->where('id_hutang', '=', $id_debt)
            ->join('tbl_buku_kas', 'tbl_hutang.id_buku', '=', 'tbl_buku_kas.id_kas')
            ->select('tbl_hutang.*', 'tbl_buku_kas.id_kas', 'tbl_buku_kas.nama_buku_kas')
            ->first();
        /* TAMPILKAN ID FORM DEBT END */
        /* TAMPILKAN  ALL CASH BOOK */
        $all_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        /* TAMPILKAN  ALL CASH BOOK END */
        /* TAMPILKAN  NOTED CASH BOOK (ID DEBT)  */
        $IDdebt_noted_cash = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('id_hutang', '=', $id_debt)
            ->join('tbl_kategori', 'tbl_catatan_buku.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_kategori.*', 'tbl_catatan_buku.*')
            ->first();
        /* TAMPILKAN  NOTED CASH BOOK (ID DEBT) END */
        /* TAMPILKAN  CATEGORY */
        $all_category = DB::table('tbl_kategori')->get();
        /* TAMPILKAN  CATEGORY END */
        return view('Web.Hutang.formview', compact([
            'show_ID_Debt',
            'all_cash_book',
            'all_category',
            'IDdebt_noted_cash',
        ]));
    }
    public function update_Debt(Request $request, $id_debt)
    {
        $request->validate(
            [
                'hutang_nominal' => 'required',
                'hutang_deskripsi' => 'required',
                'hutang_clientVal' => 'required',
                'id_kas' => 'required',
                'id_kategori' => 'required'
            ],
            [
                'hutang_nominal.required' => 'isikan dengan nominal.',
                'hutang_deskripsi.required' => 'Jangan Kosong',
                'id_kas.required' => 'Silahkan pilih satu',
                'id_kategori.required' => 'Silahkan pilih satu',
                'hutang_clientVal.required' => 'Tidak boleh kosong',
            ]
        );
        DB::table('tbl_hutang')->where('id_hutang', '=', $id_debt)->update([
            'id_buku' => $request->id_kas,
            'hutang_client' => $request->hutang_clientVal,
            'hutang_deskripsi' => $request->hutang_deskripsi,
            'catatan_saldo_hutang' => $request->hutang_nominal,
            'jatuh_tempo_hutang' => date('Y-m-d H:i:s', strtotime($request->hutang_jatuh . date('H:i:s'))),
            'created_at' => date('Y-m-d H:i:s', strtotime($request->hutang_tanggal . date('H:i:s'))),
        ]);
        DB::table('tbl_catatan_buku')->where('id_hutang', '=', $id_debt)->update([
            'id_buku_kas' => $request->id_kas,
            'id_kategori' => $request->id_kategori,
            'catatan_saldo_kas' => $request->hutang_nominal,
            'deskripsi' => $request->hutang_deskripsi,
            'created_at' => date('Y-m-d', strtotime($request->hutang_tanggal . date('H:i:s'))),
        ]);
        $saldo_akhir = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->first();
        $saldo_lama = DB::table('tbl_hutang')->where('id_hutang', '=', $id_debt)->first();
        DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $request->id_kas)
            ->update(['saldo_buku_akhir' => $saldo_akhir->saldo_buku_akhir + $request->hutang_nominal - $request->hutang_nominal_lama]);
        return response()->json(['success' => 'Data update success saved']);
    }
    public function delete_Debt($id_debt)
    {
        DB::table('tbl_hutang')->where('id_hutang', '=', $id_debt)->delete();
        return redirect()->back();
    }
}

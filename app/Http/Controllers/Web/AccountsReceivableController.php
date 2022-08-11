<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountsReceivableController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    public function index_AccountsReceivable()
    {
        $id = Auth::user();
        $all_AccountsReceivable = DB::table('tbl_piutang')->where('id_users', '=', $this->Auth())->orderByDesc('created_at')->paginate(10);
        $cash_AccountsReceivable = DB::table('tbl_piutang')->where('id_users', '=', $this->Auth())->sum('catatan_saldo_piutang');
        $all_category = DB::table('tbl_kategori')->get();
        $all_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        return view('Web.Piutang.index', compact([
            'all_AccountsReceivable',
            'cash_AccountsReceivable',
            'all_category',
            'all_cash_book',
            'id'
        ]));
    }
    public function save_AccountsReceivable(Request $request)
    {
        $request->validate(
            [
                'piutang_nominal' => 'required',
                'piutang_deskripsi' => 'required',
                'piutang_client' => 'required',
                'id_kas' => 'required',
                'id_kategori' => 'required'
            ],
            [
                'piutang_nominal.required' => 'isikan dengan nominal.',
                'piutang_deskripsi.required' => 'Tidak boleh kosong',
                'id_kas.required' => 'Silahkan pilih satu',
                'id_kategori.required' => 'Silahkan pilih satu',
                'piutang_client.required' => 'Tidak boleh kosong',
            ]
        );
        DB::table('tbl_piutang')->insert([
            'id_users' => $this->Auth(),
            'id_buku_kas' => $request->id_kas,
            'piutang_client' => $request->piutang_client,
            'piutang_deskripsi' => $request->piutang_deskripsi,
            'catatan_saldo_piutang' => $request->piutang_nominal,
            'jatuh_tempo_piutang' => date('Y-m-d', strtotime($request->piutang_jatuh . date('H:i:s'))),
            'created_at' => date('Y-m-d', strtotime($request->piutang_tanggal . date('H:i:s'))),
        ]);
        $id_piutang = DB::getPdo()->lastInsertId();
        DB::table('tbl_catatan_buku')->insert([
            'id_users' => $this->Auth(),
            'id_buku_kas' => $request->id_kas,
            'id_piutang' => $id_piutang,
            'id_kategori' => $request->id_kategori,
            'catatan_saldo_kas' => $request->piutang_nominal,
            'deskripsi' => $request->piutang_deskripsi,
            'catatan_keterangan' => 'Pengeluaran',
            'created_at' => date('Y-m-d', strtotime($request->piutang_tanggal . date('H:i:s'))),
        ]);
        $saldo_akhir = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $request->id_kas)->first();
        DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $request->id_kas)
            ->update(['saldo_buku_akhir' => $saldo_akhir->saldo_buku_akhir -= $request->piutang_nominal]);
        return response()->json(['success' => 'data has been saved']);
    }
    public function show_AccountsReceivable($id_piutang)
    {
        $show_ID_AccountsReceivable = DB::table('tbl_piutang')->where('tbl_piutang.id_users', '=', $this->Auth())->where('tbl_piutang.id_piutang', '=', $id_piutang)
            ->join('tbl_buku_kas', 'tbl_piutang.id_buku_kas', '=', 'tbl_buku_kas.id_kas')
            ->select('tbl_buku_kas.nama_buku_kas', 'tbl_buku_kas.id_kas', 'tbl_piutang.*')
            ->first();
        $id_noted_piutang_book = DB::table('tbl_catatan_buku')->where('tbl_catatan_buku.id_piutang', '=', $id_piutang)
            ->join('tbl_kategori', 'tbl_catatan_buku.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_kategori.nama_kategori', 'tbl_kategori.id_kategori', 'tbl_catatan_buku.*')
            ->first();
        $all_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        $all_category = DB::table('tbl_kategori')->get();
        return view('Web.Piutang.formview', compact([
            'show_ID_AccountsReceivable',
            'all_cash_book',
            'all_category',
            'id_noted_piutang_book'
        ]));
    }
    public function update_AccountsReceivable(Request $request, $id_piutang)
    {
        $request->validate(
            [
                'piutang_nominal' => 'required',
                'piutang_deskripsi' => 'required',
                'piutang_client' => 'required',
                'id_kas' => 'required',
                'id_kategori' => 'required'
            ],
            [
                'piutang_nominal.required' => 'isikan dengan nominal.',
                'piutang_deskripsi.required' => 'Tidak boleh kosong',
                'id_kas.required' => 'Silahkan pilih satu',
                'id_kategori.required' => 'Silahkan pilih satu',
                'piutang_client.required' => 'Tidak boleh kosong',
            ]
        );
        DB::table('tbl_piutang')->where('id_piutang', '=', $id_piutang)->update([
            'id_buku_kas' => $request->id_kas,
            'piutang_deskripsi' => $request->piutang_deskripsi,
            'catatan_saldo_piutang' => $request->piutang_nominal,
            'jatuh_tempo_piutang' => date('Y-m-d', strtotime($request->piutang_jatuh . date('H:i:s'))),
            'created_at' => date('Y-m-d', strtotime($request->piutang_tanggal . date('H:i:s'))),
        ]);
        DB::table('tbl_catatan_buku')->where('id_piutang', '=', $id_piutang)->update([
            'id_buku_kas' => $request->id_kas,
            'id_kategori' => $request->id_kategori,
            'catatan_saldo_kas' => $request->piutang_nominal,
            'deskripsi' => $request->piutang_deskripsi,
            'catatan_keterangan' => 'Pengeluaran',
            'created_at' => date('Y-m-d H:i:s', strtotime($request->piutang_tanggal . date('H:i:s'))),
        ]);
        $saldo_akhir = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $request->id_kas)->first();
        DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $request->id_kas)
            ->update(['saldo_buku_akhir' =>  $saldo_akhir->saldo_buku_akhir += $request->piutang_nominal_lama -= $request->piutang_nominal]);
        return response()->json(['success' => 'data hass been saved update']);
    }
    public function delete_AccountsReceivable($id_piutang)
    {
        DB::table('tbl_piutang')->where('id_users', '=', $this->Auth())->where('id_piutang', '=', $id_piutang)->delete();
        return redirect()->back();
    }
}

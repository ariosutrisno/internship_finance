<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BukuKasController extends Controller
{
    function auth()
    {
        return Auth::id();
    }
    public function index_BukuKas()
    {
        $all_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->orderByDesc('created_at')->get();
        return view('Web.Buku-Kas.index-buku-kas', compact(
            'all_cash_book'
        ));
    }
    public function show_BukuKas(Request $request, $id_kas)
    {
        $cash_book_id = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $id_kas)->first();
        $cash_book_id_total = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $id_kas)->sum('saldo_buku_akhir');
        $noted_cash_book_id = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->auth())->where('id_buku_kas', '=', $id_kas)
            ->join('tbl_kategori', 'tbl_catatan_buku.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_kategori.*', 'tbl_catatan_buku.*')
            ->orderByDesc('tbl_catatan_buku.created_at')
            ->paginate(10);
        $kategori = DB::table('tbl_kategori')->get();
        /* FILTER DATE */

        return view('Web.Buku-Kas.view-buku-kas', compact(
            'cash_book_id',
            'noted_cash_book_id',
            'kategori',
            'cash_book_id_total'
        ));
    }
    public function save_Noted_BukuKas(Request $request, $id_kas)
    {
        $request->validate(
            [
                'catatan_jumlah' => 'required',
                'catatan_keterangan' => 'required',
                'id_kategori' => 'required'
            ],
            [
                'catatan_jumlah.required' => 'isikan dengan nominal.',
                'catatan_keterangan.required' => 'Jangan Kosong',
                'id_kategori.required' => 'Silahkan pilih satu',
            ]
        );
        if ($request->Pengeluaran == 'Pengeluaran') {
            DB::table('tbl_catatan_buku')->insert([
                'id_users' => $this->auth(),
                'id_buku_kas' => $id_kas,
                'id_kategori' => $request->id_kategori,
                'catatan_saldo_kas' => $request->catatan_jumlah,
                'deskripsi' => $request->catatan_keterangan,
                'catatan_keterangan' => $request->Pengeluaran,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->catatan_tgl . $request->catatan_jam)),
            ]);
            $cash_book_id = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $id_kas)->first();
            DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $id_kas)->update([
                'saldo_buku_akhir' => $cash_book_id->saldo_buku_akhir -= $request->catatan_jumlah
            ]);
        } elseif ($request->Pemasukan == 'Pemasukan') {
            DB::table('tbl_catatan_buku')->insert([
                'id_users' => $this->auth(),
                'id_buku_kas' => $id_kas,
                'id_kategori' => $request->id_kategori,
                'catatan_saldo_kas' => $request->catatan_jumlah,
                'deskripsi' => $request->catatan_keterangan,
                'catatan_keterangan' => $request->Pemasukan,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->catatan_tgl . $request->catatan_jam)),
            ]);
            $cash_book_id = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $id_kas)->first();
            DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $id_kas)->update([
                'saldo_buku_akhir' => $cash_book_id->saldo_buku_akhir += $request->catatan_jumlah
            ]);
        }

        return response()->json(['success' => 'Data Saved Success']);
    }
    public function notes_book(Request $request, $id_catatan)
    {
        $id_noted_book = DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)
            ->join('tbl_kategori', 'tbl_catatan_buku.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_kategori.*', 'tbl_catatan_buku.*')
            ->first();
        $kategori = DB::table('tbl_kategori')->get();
        return view('Web.Buku-Kas.Form-Notes-Book', compact(
            'id_noted_book',
            'kategori',
        ));
    }
    public function update_BukuKas(Request $request, $id_catatan)
    {
        $request->validate(
            [
                'catatan_jumlah' => 'required',
                'deskripsi' => 'required',
                'id_kategori' => 'required'
            ],
            [
                'catatan_jumlah.required' => 'isikan dengan nominal.',
                'deskripsi.required' => 'Jangan Kosong',
                'id_kategori.required' => 'Silahkan pilih satu',
            ]
        );
        if ($request->keterangan == 'Pemasukan' && 'pemasukan') {
            DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)->update([
                'id_kategori' => $request->id_kategori,
                'catatan_saldo_kas' => $request->catatan_jumlah,
                'deskripsi' => $request->deskripsi,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->catatan_tgl . $request->catatan_jam))
            ]);
            $cash_book_id = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $request->id_kas)->first();
            DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $request->id_kas)->update([
                'saldo_buku_akhir' => $cash_book_id->saldo_buku_akhir - $request->catatan_jumlah_lama + $request->catatan_jumlah,
            ]);
        }
        if ($request->keterangan == 'Pengeluaran' && 'pengeluaran') {
            # code...
            DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)->update([
                'id_kategori' => $request->id_kategori,
                'catatan_saldo_kas' => $request->catatan_jumlah,
                'deskripsi' => $request->deskripsi,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->catatan_tgl . $request->catatan_jam))
            ]);
            $cash_book_id = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $request->id_kas)->first();
            DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->where('id_kas', '=', $request->id_kas)->update([
                'saldo_buku_akhir' => $cash_book_id->saldo_buku_akhir + $request->catatan_jumlah_lama - $request->catatan_jumlah,
            ]);
        }
        return response()->json(['success' => 'Data Saved Success']);
    }
    public function delete_BukuKas($id_catatan)
    {
        $id_kas = url()->previous();
        $exp = explode('/', $id_kas);
        $dd = $exp[count($exp) - 1];
        $buku_saldo = DB::table('tbl_buku_kas')->where('id_kas', '=', $dd)->first('saldo_buku_akhir');
        $catatan_jumlah = DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)->first('catatan_saldo_kas');
        $keterangan = DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)->first();
        $aa = $buku_saldo->saldo_buku_akhir;
        $bb = $catatan_jumlah->catatan_saldo_kas;
        $hasilpengeluaran = $aa + $bb;
        $hasilpemasukan = $aa - $bb;
        if ($keterangan->catatan_keterangan == 'Pemasukan' && 'pemasukan') {
            # code...
            DB::table('tbl_buku_kas')->where('id_kas', '=', $dd)->update(['saldo_buku_akhir' => $hasilpemasukan]);
            DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)->delete();
        } else {
            # code...
            DB::table('tbl_buku_kas')->where('id_kas', '=', $dd)->update(['saldo_buku_akhir' => $hasilpengeluaran]);
            DB::table('tbl_catatan_buku')->where('id_catatan', '=', $id_catatan)->delete();
        }

        return redirect()->back();
    }
}

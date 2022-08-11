<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormBukuController extends Controller
{
    public function create_BukuKas()
    {
        $id = Auth::user();
        return view('Web.Buku-Kas.Form-Buku-Kas', compact([
            'id'
        ]));
    }
    public function save_BukuKas(Request $request)
    {
        $user = Auth::id();
        $save = DB::table('tbl_buku_kas')->insert([
            'id_users' => $user,
            'nama_buku_kas' => $request->buku_nama,
            'deskripsi_buku_kas' => $request->buku_deskripsi,
            'saldo_buku_awal' => $request->buku_saldo_awal,
            'saldo_buku_akhir' => $request->buku_saldo_akhir,
        ]);
        if ($save) {
            # code...
            return response()->json([
                'success' => true
            ], 200);
        } else {
            # code...
            return response()->json([
                'success' => false,
                'message' => 'Tidak Tersimpan!'
            ], 401);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferingLetterController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    public function index_OfferingLetter()
    {

        $index_offering = DB::table('tbl_offering_letter')->where('id_users', '=', $this->Auth())->paginate(10);
        return view('Web.Surat.types_of_letters.offering.index', compact([
            'index_offering'
        ]));
    }
    public function create_OfferingLetter()
    {
        $bulan_romawi = array('', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        $letter = 'MAGANG';
        $Awal = 'ALAN-MI';
        $noUrutAkhir = DB::table('tbl_offering_letter')->max('nomor_surat');
        $nomor_surat = sprintf("%03s", abs($noUrutAkhir) + 1) . '/' . $Awal . '/' . $bulan_romawi[date('n')] . '/' . date('Y');
        if ($noUrutAkhir) {
            $nomor_surat;
        }
        return view('Web.Surat.types_of_letters.offering.create', compact([
            'nomor_surat'
        ]));
    }

    public function post_OfferingLetter(Request $request)
    {

        DB::table('tbl_offering_letter')->insert([
            'user_id' => $this->Auth(),
            'letter_nama' => $request->name,
            'nomor_surat' => $request->nosurat,
            'letter_email' => $request->email,
            'letter_telepon' => $request->telepon,
            'letter_alamat' => $request->address,
            'letter_peruntukan' => $request->selectFungsi,
            'letter_date_mulai' => date('Y-m-d H:i:s', strtotime($request->letter_date_mulai . $request->letter_jam_mulai)),
            'letter_date_selesai' => date('Y-m-d H:i:s', strtotime($request->letter_date_selesai . $request->letter_jam_selesai)),
            'created_at' => date('Y-m-d H:i:s', strtotime($request->tgl_lamar . date('H:i:s'))),
            'letter_telepon_pembimbing' => $request->telepon_pembimbing,
            'letter_narahubung' => $request->narahubung,
        ]);
        return redirect()->route('index_OfferingLetter');
    }

    public function print_OfferingLetter($id_offering)
    {
        $id_print_offering = DB::table('tbl_offering_letter')->where('id_letter', '=', $id_offering)->first();
        $pdf = PDF::loadview('Web.Surat.types_of_letters.offering.print', compact(['id_print_offering']))->setPaper('A4', 'potrait');
        return $pdf->stream();
        return view('Web.Surat.types_of_letters.offering.print', compact(['id_print_offering']));
    }
    public function view_OfferingLetter($id_offering)
    {
        $id_offering = DB::table('tbl_offering_letter')->where('id_offer', '=', $id_offering)->first();
        return view('dashboard.tipe-surat.OfferingLetter.edit', compact('id_offering'));
    }
    public function updateffering(Request $request, $id_offering)
    {
        DB::table('tbl_offering_letter')->where('id_offering', '=', $id_offering)->update([
            'user_id' => $this->Auth(),
            'letter_nama' => $request->name,
            'nomor_surat' => $request->nosurat,
            'letter_email' => $request->email,
            'letter_telepon' => $request->telepon,
            'letter_alamat' => $request->address,
            'letter_peruntukan' => $request->selectFungsi,
            'letter_date_mulai' => date('Y-m-d H:i:s', strtotime($request->letter_date_mulai . $request->letter_jam_mulai)),
            'letter_date_selesai' => date('Y-m-d H:i:s', strtotime($request->letter_date_selesai . $request->letter_jam_selesai)),
            'created_at' => date('Y-m-d H:i:s', strtotime($request->tgl_lamar . date('H:i:s'))),
            'letter_telepon_pembimbing' => $request->telepon_pembimbing,
            'letter_narahubung' => $request->narahubung,
        ]);
        return redirect()->route('index_OfferingLetter');
    }
    public function destroyoffering($id_offering)
    {
        DB::table('tbl_offering_letter')->where('id_offering', '=', $id_offering)->delete();
        return redirect()->back();
    }
}

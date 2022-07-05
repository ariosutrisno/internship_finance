<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OfferingLetterController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    public function index_OfferingLetter()
    {

        $index_offering = DB::table('tbl_offering_letter')->where('id_users', '=', $this->Auth())->orderByDesc('created_at')->paginate(10);
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

        if ($request->selectFungsi == 'Internship') {
            # code...
            $request->validate(
                [
                    'letter_email' => 'required|email|unique:tbl_offering_letter',
                    'letter_nama' => 'required',
                    'letter_narahubung' => 'required',
                    'letter_telepon' => 'required|max:13',
                    'telepon_pembimbing' => 'required|max:13',
                    'letter_alamat' => 'required',
                    'selectFungsi' => 'required',
                    'tgl_mulai' => 'required|date_format:Y-m-d',
                    'tgl_selesai' => 'required|date_format:Y-m-d',
                    'tgl_lamar' => 'required|date_format:Y-m-d',
                    'jam_mulai_kerja' => 'required|date_format:H:i',
                    'jam_selesai_kerja' => 'required|date_format:H:i',
                ],
                [
                    'letter_email.required' => 'Isikan dengan alamat email.',
                    'letter_nama.required' => 'Isikan Nama Anda',
                    'letter_narahubung.required' => 'Isikan Nama Pembimbing/HR',
                    'letter_telepon.required' => 'Isikan dengan No.telp/No.hp anda',
                    'telepon_pembimbing.required' => 'Isikan dengan no.Hp HR/Pembimbing',
                    'letter_alamat.required' => 'Masukan Alamat anda',
                    'selectFungsi.required' => 'Pilih Salah Satu',
                    'tgl_mulai.required' => 'Isikan Tanggal',
                    'tgl_selesai.required' => 'Isikan Tanggal',
                    'tgl_lamar.required' => 'Isikan Tanggal',
                    'jam_mulai_kerja.required' => 'Isikan Jam',
                    'jam_selesai_kerja.required' => 'Isikan Jam',

                ]
            );
            DB::table('tbl_offering_letter')->insert([
                'id_users' => $this->Auth(),
                'nomor_surat' => $request->nomor_surat,
                'letter_nama' => $request->letter_nama,
                'letter_email' => $request->letter_email,
                'letter_telepon' => $request->letter_telepon,
                'letter_alamat' => $request->letter_alamat,
                'letter_peruntukan' => $request->selectFungsi,
                'letter_date_mulai' => date('Y-m-d H:i:s', strtotime($request->tgl_mulai . $request->jam_mulai_kerja)),
                'letter_date_selesai' => date('Y-m-d H:i:s', strtotime($request->tgl_selesai . $request->jam_selesai_kerja)),
                'created_at' => date('Y-m-d H:i:s', strtotime($request->tgl_lamar . date('H:i:s'))),
                'letter_telepon_pembimbing' => $request->telepon_pembimbing,
                'letter_pembimbing' => $request->letter_narahubung,
            ]);
        } else {
            # code...
            $request->validate(
                [
                    'letter_email' => 'required|email',
                    'letter_nama' => 'required',
                    'letter_narahubung' => 'required',
                    'letter_telepon' => 'required|max:13',
                    'telepon_pembimbing' => 'required|max:13',
                    'letter_alamat' => 'required',
                    'selectFungsi' => 'required',
                    'tgl_mulai' => 'required|date_format:Y-m-d',
                    'tgl_lamar' => 'required|date_format:Y-m-d',
                    'jam_mulai_kerja' => 'required|date_format:H:i',
                    'jam_selesai_kerja' => 'required|date_format:H:i',
                ],
                [
                    'letter_email.required' => 'Isikan dengan alamat email.',
                    'letter_nama.required' => 'Isikan Nama Anda',
                    'letter_narahubung.required' => 'Isikan Nama Pembimbing/HR',
                    'letter_telepon.required' => 'Isikan dengan No.telp/No.hp anda',
                    'telepon_pembimbing.required' => 'Isikan dengan no.Hp HR/Pembimbing',
                    'letter_alamat.required' => 'Masukan Alamat anda',
                    'selectFungsi.required' => 'Pilih Salah Satu',
                    'tgl_mulai.required' => 'Isikan Tanggal',
                    'tgl_lamar.required' => 'Isikan Tanggal',
                    'jam_mulai_kerja.required' => 'Isikan Jam',
                    'jam_selesai_kerja.required' => 'Isikan Jam',

                ]
            );
            DB::table('tbl_offering_letter')->insert([
                'id_users' => $this->Auth(),
                'letter_nama' => $request->letter_nama,
                'letter_email' => $request->letter_email,
                'letter_telepon' => $request->letter_telepon,
                'letter_alamat' => $request->letter_alamat,
                'letter_peruntukan' => $request->selectFungsi,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->tgl_lamar . $request->jam_mulai_kerja)),
                'letter_date_mulai' => date('Y-m-d H:i:s', strtotime($request->tgl_mulai .  $request->jam_selesai_kerja)),
                'letter_date_selesai' => null,
                'letter_telepon_pembimbing' => $request->telepon_pembimbing,
                'letter_pembimbing' => $request->letter_narahubung,
            ]);
        }


        return redirect()->route('index_OfferingLetter')->with('success', 'Data Telah Ditambahkan');
    }

    public function print_OfferingLetter($id_offering)
    {
        $id_print_offering = DB::table('tbl_offering_letter')->where('id_letter', '=', $id_offering)->first();
        // $pdf = FacadePdf::loadview('Web.Surat.types_of_letters.offering.print', compact(['id_print_offering']))->setPaper('A4', 'potrait');
        // return $pdf->stream();
        return view('Web.Surat.types_of_letters.offering.print', compact(['id_print_offering']));
    }
    public function view_OfferingLetter($id_offering)
    {
        $id_offering = DB::table('tbl_offering_letter')->where('id_letter', '=', $id_offering)->first();
        return view('Web.Surat.types_of_letters.offering.edit', compact('id_offering'));
    }

    public function update_OfferingLetter(Request $request, $id_offering)
    {

        if ($request->letter_peruntukan == 'Internship') {
            # code...
            $request->validate(
                [
                    'letter_email' => 'required|email',
                    'letter_nama' => 'required',
                    'letter_narahubung' => 'required',
                    'letter_telepon' => 'required|max:13',
                    'telepon_pembimbing' => 'required|max:13',
                    'letter_alamat' => 'required',
                    'tgl_mulai' => 'required|date_format:Y-m-d',
                    'tgl_selesai' => 'required|date_format:Y-m-d',
                    'tgl_lamar' => 'required|date_format:Y-m-d',
                    'jam_mulai_kerja' => 'required|date_format:H:i',
                    'jam_selesai_kerja' => 'required|date_format:H:i',
                ],
                [
                    'letter_email.required' => 'Isikan dengan alamat email.',
                    'letter_nama.required' => 'Isikan Nama Anda',
                    'letter_narahubung.required' => 'Isikan Nama Pembimbing/HR',
                    'letter_telepon.required' => 'Isikan dengan No.telp/No.hp anda',
                    'telepon_pembimbing.required' => 'Isikan dengan no.Hp HR/Pembimbing',
                    'letter_alamat.required' => 'Masukan Alamat anda',
                    'tgl_mulai.required' => 'Isikan Tanggal',
                    'tgl_selesai.required' => 'Isikan Tanggal',
                    'tgl_lamar.required' => 'Isikan Tanggal',
                    'jam_mulai_kerja.required' => 'Isikan Jam',
                    'jam_selesai_kerja.required' => 'Isikan Jam',

                ]
            );
            DB::table('tbl_offering_letter')->where('id_letter', '=', $id_offering)->where('letter_peruntukan', '=', 'Internship')->update([
                'letter_nama' => $request->letter_nama,
                'letter_email' => $request->letter_email,
                'letter_telepon' => $request->letter_telepon,
                'letter_alamat' => $request->letter_alamat,
                'letter_date_mulai' => date('Y-m-d H:i:s', strtotime($request->tgl_mulai . $request->jam_mulai_kerja)),
                'letter_date_selesai' => date('Y-m-d H:i:s', strtotime($request->tgl_selesai . $request->jam_selesai_kerja)),
                'created_at' => date('Y-m-d H:i:s', strtotime($request->tgl_lamar . date('H:i:s'))),
                'letter_telepon_pembimbing' => $request->telepon_pembimbing,
                'letter_pembimbing' => $request->letter_narahubung,
            ]);
        } else {
            # code...
            $request->validate(
                [
                    'letter_email' => 'required|email',
                    'letter_nama' => 'required',
                    'letter_narahubung' => 'required',
                    'letter_telepon' => 'required|max:13',
                    'telepon_pembimbing' => 'required|max:13',
                    'letter_alamat' => 'required',
                    'tgl_mulai' => 'required|date_format:Y-m-d',
                    'tgl_lamar' => 'required|date_format:Y-m-d',
                    'jam_mulai_kerja' => 'required|date_format:H:i',
                    'jam_selesai_kerja' => 'required|date_format:H:i',
                ],
                [
                    'letter_email.required' => 'Isikan dengan alamat email.',
                    'letter_nama.required' => 'Isikan Nama Anda',
                    'letter_narahubung.required' => 'Isikan Nama Pembimbing/HR',
                    'letter_telepon.required' => 'Isikan dengan No.telp/No.hp anda',
                    'telepon_pembimbing.required' => 'Isikan dengan no.Hp HR/Pembimbing',
                    'letter_alamat.required' => 'Masukan Alamat anda',
                    'tgl_mulai.required' => 'Isikan Tanggal',
                    'tgl_lamar.required' => 'Isikan Tanggal',
                    'jam_mulai_kerja.required' => 'Isikan Jam',
                    'jam_selesai_kerja.required' => 'Isikan Jam',

                ]
            );
            DB::table('tbl_offering_letter')->where('id_letter', '=', $id_offering)->where('letter_peruntukan', '=', 'Karyawan')->update([
                'letter_nama' => $request->letter_nama,
                'letter_email' => $request->letter_email,
                'letter_telepon' => $request->letter_telepon,
                'letter_alamat' => $request->letter_alamat,
                'created_at' => date('Y-m-d H:i:s', strtotime($request->tgl_lamar . $request->jam_mulai_kerja)),
                'letter_date_mulai' => date('Y-m-d H:i:s', strtotime($request->tgl_mulai .  $request->jam_selesai_kerja)),
                'letter_telepon_pembimbing' => $request->telepon_pembimbing,
                'letter_pembimbing' => $request->letter_narahubung,
            ]);
        }

        return redirect()->route('index_OfferingLetter')->with('success', 'Data Telah DiUpdate');
    }
    public function delete_OfferingLetter($id_offering)
    {
        DB::table('tbl_offering_letter')->where('id_letter', '=', $id_offering)->delete();
        return redirect()->back();
    }
}

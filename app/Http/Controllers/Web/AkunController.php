<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{

    function Auth()
    {
        return Auth::user();
    }
    public function view_user()
    {
        $id = $this->Auth();
        return view('Web.Layouts.Auth.akun', compact([
            'id',
        ]));
    }
    public function edit_user()
    {
        $id = $this->Auth();
        return view('Web.Layouts.Auth.editAkun', compact([
            'id'
        ]));
    }
    public function update_user(Request $request, $id_user)
    {
        $fileName = $request->file('img')->getClientOriginalName();
        if ($request->has('img')) {
            # code...
            Storage::putFileAs('public/storage', $request->file('img'), $fileName);
            DB::table('users')->where('id', '=', $id_user)->update([
                'name' => $request->nama_asli,
                'jk_users' => $request->jk_users,
                'phone_users' => $request->telepon,
                'email' => $request->email,
                'password' => Hash::make($request->pwNew),
                'img_users' => $fileName,
            ]);
        }
        return response()->json(['success' => true]);
    }
}

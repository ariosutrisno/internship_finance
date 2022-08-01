<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'id'
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
        $request->validate([]);
        DB::table('users')->where('id', '=', $id_user)->update([
            'name' => $request->nama_lengkap,
            'jk' => $request->jk_users,
            'phone_users' => $request->jk,
            'email' => $request->email,
            'password' => Hash::make($request->pwNew),
        ]);
        return redirect()->route('view_user');
    }
}

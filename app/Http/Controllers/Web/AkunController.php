<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->route('view_user');
    }
}

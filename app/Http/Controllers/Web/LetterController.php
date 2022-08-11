<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    public function index_Letter()
    {
        $id = Auth::user();
        return view('Web.Surat.index', compact(['id']));
    }
}

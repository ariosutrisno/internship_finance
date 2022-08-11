<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    public function index_Customer()
    {
        $id = Auth::user();
        $customer_index = DB::table('tbl_customer')->where('id_users', '=', $this->Auth())->orderByDesc('created_at')->paginate(10);
        return view('Web.Surat.types_of_letters.customer.index', compact([
            'customer_index',
            'id'
        ]));
    }
    public function create_Customer()
    {
        $id = Auth::user();
        $customer_index = DB::table('tbl_customer')->where('id_users', '=', $this->Auth())->paginate(10);
        return view('Web.Surat.types_of_letters.customer.create', compact([
            'customer_index',
            'id'
        ]));
    }
    public function save_Customer(Request $request)
    {
        $request->validate(
            [
                'email_customer' => 'required|email',
                'name_customer' => 'required',
                'phone_customer' => 'required|max:13',
                'company_customer' => 'required',
                'address_company_customer' => 'required',
            ],
            [
                'email_customer.required' => 'Isikan dengan alamat email.',
                'name_customer.required' => 'Isikan Nama Anda',
                'phone_customer.required' => 'Isikan dengan no.telp/hp anda',
                'company_customer.required' => 'Masukan perusahaan anda',
                'address_company_customer.required' => 'Masukan alamat perusahaan anda',
            ]
        );
        DB::table('tbl_customer')->insert([
            'id_users' => $this->Auth(),
            'email_customer' => $request->email_customer,
            'name_customer' => $request->name_customer,
            'phone_customer' => $request->phone_customer,
            'company_customer' => $request->company_customer,
            'address_company_customer' => $request->address_company_customer,

        ]);
        return redirect()->route('index_Customer')->with(['Data Succes Saved']);
    }
    public function show_Customer($id_customer)
    {
        $customer = DB::table('tbl_customer')->where('id_customer', '=', $id_customer)->where('id_users', '=', $this->Auth())->first();
        return view('Web.Surat.types_of_letters.customer.edit', compact([
            'customer',
        ]));
    }
    public function update_Customer(Request $request, $id_customer)
    {
        $request->validate(
            [
                'email_customer' => 'required|email',
                'name_customer' => 'required',
                'phone_customer' => 'required|max:13',
                'company_customer' => 'required',
                'address_company_customer' => 'required',
            ],
            [
                'email_customer.required' => 'Isikan dengan alamat email.',
                'name_customer.required' => 'Isikan Nama Anda',
                'phone_customer.required' => 'Isikan dengan no.telp/hp anda',
                'company_customer.required' => 'Masukan perusahaan anda',
                'address_company_customer.required' => 'Masukan alamat perusahaan anda',
            ]
        );
        DB::table('tbl_customer')->where('id_customer', '=', $id_customer)->update([
            'email_customer' => $request->email_customer,
            'name_customer' => $request->name_customer,
            'phone_customer' => $request->phone_customer,
            'company_customer' => $request->company_customer,
            'address_company_customer' => $request->address_company_customer,
        ]);
        return redirect()->route('index_Customer');
    }
    public function delete_Customer($id_customer)
    {
        DB::table('tbl_customer')->where('id_customer', '=', $id_customer)->where('id_users', '=', $this->Auth())->delete();
        return redirect()->back();
    }
}

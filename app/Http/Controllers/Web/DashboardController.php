<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function auth()
    {
        return Auth::id();
    }
    public function index_dashboard()
    {
        // ALL CASH BOOK
        $all_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->get();
        // ALL CASH BOOK END
        // total all balance
        $total_all_balance = 0;
        if ($total_all_balance == 0) {
            $total_all_balance = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->sum('saldo_buku_akhir');
            # code...
        } else {
            # code...
            $total_all_balance;
        }
        // total all balance end
        // total all income
        $total_all_income = 0;
        $total_all_expenses = 0;
        if ($total_all_income == 0 && $total_all_expenses == 0) {
            $total_all_income = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->auth())->where('catatan_keterangan', '=', 'pemasukan')->sum('catatan_saldo_kas');
            $total_all_expenses = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->auth())->where('catatan_keterangan', '=', 'pengeluaran')->sum('catatan_saldo_kas');
            # code...
        } else {
            # code...
            $total_all_income;
            $total_all_expenses;
        }
        // total all income end
        /* DATA PERSEN */
        $all_persen_book_first = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->sum('saldo_buku_awal');
        $all_persen_book_last = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->sum('saldo_buku_akhir');
        if ($all_persen_book_first == 0 && $all_persen_book_last == 0) {
            # code...
            $count_up = 0;
            $count_down = 0;
        } else {
            # code...
            $count_up = ($all_persen_book_last - $all_persen_book_first) / ($all_persen_book_first);
            $count_down = ($all_persen_book_first - $all_persen_book_last) / ($all_persen_book_first);
        }
        $data_result_up = number_format($count_up, 2);
        $data_result_down = number_format($count_down, 2);
        if ($all_persen_book_first == $all_persen_book_last) {
            # code...
            $data = ' ' . $data_result_up;
            $data = ' ' . $data_result_down;
            $data_persen = ' ' . $data_result_up;
            $data_persen = ' ' . $data_result_down;
        } elseif ($all_persen_book_first >= $all_persen_book_last) {
            # code...
            $data = 'Naik ' . $data_result_up;
            $data = 'Turun ' . $data_result_down;
            $data_persen = '+ ' . $data_result_up;
            $data_persen = '' . $data_result_down;
        } else {
            $data = 'Naik' . $data_result_up;
            $data = 'Turun ' . $data_result_down;
            $data_persen = '+ ' . $data_result_up;
            $data_persen = ' ' . $data_result_down;
        }

        /* DATA PERSEN END */
        /* DATA INCOME */
        $all_income_last = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->auth())->where('catatan_keterangan', '=', 'pemasukan')->sum('catatan_saldo_kas');
        $all_income_book_first = DB::table('tbl_buku_kas')->where('id_users', '=', $this->auth())->sum('saldo_buku_awal');
        if ($all_income_last == 0 && $all_income_book_first == 0) {
            # code...
            $count_up_income = 0;
            $count_down_income = 0;
        } else {
            # code...
            $count_up_income = ($all_income_last - $all_income_book_first) / ($all_income_book_first);
            $count_down_income = ($all_income_book_first - $all_income_last) / ($all_income_book_first);
        }
        $data_resultIncome_up = number_format($count_up_income, 2);
        $data_resultIncome_down = number_format($count_down_income, 2);
        if ($all_income_book_first == $all_income_last) {
            # code...
            $data_income = ' ' . $data_resultIncome_up;
            $data_income = ' ' . $data_resultIncome_down;
            $data_persen_income = ' ' . $data_resultIncome_up;
            $data_persen_income = ' ' . $data_resultIncome_down;
        } elseif ($all_income_book_first >= $all_income_last) {
            # code...
            $data_income = 'Naik ' . $data_resultIncome_up;
            $data_income = 'Turun ' . $data_resultIncome_down;
            $data_persen_income = '+ ' . $data_resultIncome_up;
            $data_persen_income = '' . $data_resultIncome_down;
        } else {
            $data_income = 'Naik' . $data_resultIncome_up;
            $data_income = 'Turun ' . $data_resultIncome_down;
            $data_persen_income = '+ ' . $data_resultIncome_up;
            $data_persen_income = ' ' . $data_resultIncome_down;
        }
        /* DATA INCOME END */
        /* DATA EXPENDITURE */
        /* DATA EXPENDITURE END */
        /* GRAFIK BULANAN */
        /* GRAFIK BULANAN */
        return view('Web.Dashboard.dashboard', compact(
            'all_cash_book',
            'total_all_balance',
            'total_all_income',
            'total_all_expenses',
            'data',
            'data_persen',
            'data_income',
            'data_persen_income'
        ));
    }
    public function show_dashboard($id_kas)
    {
        return view();
    }
}

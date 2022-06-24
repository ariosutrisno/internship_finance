<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashStatementController extends Controller
{
    function Auth()
    {
        return Auth::id();
    }
    function hari_ini($hari)
    {

        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return $hari_ini;
    }
    public function daily_CashStatement()
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        /* STATISTIC MONTHLY CASH STATMENT */
        $month = date('m');
        $year = date('y');
        $day = date('d');
        $calender_condition = CAL_GREGORIAN;
        $new_calender = cal_days_in_month($calender_condition, $month, $year);
        for ($i = 1; $i <= $new_calender; $i++) {
            $days[] = $i;
            $daily = date('Y-m-') . $i;
            $date = date('Y-m-d', strtotime($daily));
            $datefrom = date('Y-m-d', strtotime('-22 days'));
            $dateto = date('Y-m-d', strtotime('+7 days'));
            // dd($datefrom, $dateto);
            $all_noted_daily_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->whereBetween('created_at', [$datefrom, $dateto])->orderBy('created_at', 'asc')->paginate(10);
            $chart = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereDate('created_at', '=', $date)->sum('catatan_saldo_kas');
            $nominal_income[] = $chart;
            $chart2 = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereDate('created_at', '=', $date)->sum('catatan_saldo_kas');
            $nominal_expenditure[] = $chart2;
        }
        $income = json_encode($nominal_income);
        $expenditure = json_encode($nominal_expenditure);
        $all_date = json_encode($days);
        return view('Web.Laporan-Kas.daily', compact([
            'all_book',
            'all_noted_daily_CashStatement',
            'income',
            'expenditure',
            'all_date'
        ]));
    }

    public function weekly_CashStatement()
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        /* ALL BOOK END */
        /* STATICSITC */
        for ($i = 0; $i <= 6; $i++) {
            # code...
            $minggu = date('Y-m-d', strtotime(date('Y-m-d')) - $i);
            $d = date('D', strtotime($i . 'days'));
            $day = $this->hari_ini($d);
            $e[] = $day;
            $datefrom_week = date('Y-m-d', strtotime('-23 days'));
            $dateto_week = date('Y-m-d', strtotime('-29 days'));
            $all_noted_weekly_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'asc')->paginate(10);
            $catatan_jumlahminggu = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereDate('created_at', '=', $minggu)->sum('catatan_saldo_kas');
            $catatan_jumlahminggu12[] = $catatan_jumlahminggu;
            $catatan_jumlahminggu2 = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereDate('created_at', '=', $minggu)->sum('catatan_saldo_kas');
            $catatan_jumlahminggu24[] = $catatan_jumlahminggu2;
        }
        $weekly = json_encode($e);
        $weekly_income = json_encode($catatan_jumlahminggu12);
        $weekly_expenditure = json_encode($catatan_jumlahminggu24);
        /* STATICSITC END */
        return view('Web.Laporan-Kas.weekly', compact([
            'all_book',
            'all_noted_weekly_CashStatement',
            'weekly',
            'weekly_income',
            'weekly_expenditure'
        ]));
    }
    public function monthly_CashStatement()
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        /* STATISTIC MONTHLY CASH STATMENT */
        $data_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for ($bulan = 1; $bulan <= 13; $bulan++) {
            # code...
            $month = date('Y-') . $bulan . date('-d');
            $date = date('m', strtotime($month));
            $all_noted_monthly_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->whereMonth('created_at', '=', date('m'))->orderBy('created_at', 'asc')->paginate(10);
            $catatan_jumlah = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereMonth('created_at', '=', $date)->sum('catatan_saldo_kas');
            $jumlah_catatan[] = $catatan_jumlah;

            $catatan_jumlah2 = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereMonth('created_at', '=', $date)->sum('catatan_saldo_kas');
            $jumlah_catatan2[] = $catatan_jumlah2;
        }
        $all_month = json_encode($data_bulan);
        $month_income = json_encode($jumlah_catatan);
        $month_expenditure = json_encode($jumlah_catatan2);
        /* STATISTIC MONTHLY CASH STATMENT */
        return view('Web.Laporan-Kas.monthly', compact([
            'all_book',
            'all_noted_monthly_CashStatement',
            'month_income',
            'month_expenditure',
            'all_month'
        ]));
    }
    public function annual_CashStatement()
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        /* ALL BOOK END */
        /* ALL NOTED */
        $all_noted_annual_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->whereYear('created_at', '=', date('Y'))->orderBy('created_at', 'asc')->paginate(10);
        /* ALL NOTED */
        /* STATISTIC ANNUAL */
        $year = date('Y');
        $year1 = date('Y', strtotime('5 years'));
        for ($i = $year; $i <= $year1; $i++) {
            # code...
            $array[] = $i;
            $date_year = date('Y', strtotime($i . date('-m-d')));
            $income = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereYear('created_at', '=', $date_year)->sum('catatan_saldo_kas');
            $statistic_income[] = $income;
            $expenditure = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereYear('created_at', '=', $date_year)->sum('catatan_saldo_kas');
            $statistic_expendeture[] = $expenditure;
        }
        $annual = json_encode($array);
        $annual_income = json_encode($statistic_income);
        $annual_expenditure = json_encode($statistic_expendeture);
        /* STATISTIC ANNUAL END */
        return view('Web.Laporan-Kas.annual', compact([
            'all_book',
            'all_noted_annual_CashStatement',
            'annual_income',
            'annual_expenditure',
            'annual'
        ]));
    }
    /* STATEMENT ID BOOK */
    public function dailyID_CashStatement($id_kas)
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        /* ALL BOOK END */
        /* ALL NOTED */

        $name_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $id_kas)->first();
        /* ALL NOTED */
        /* STATISTIC DAILY CASH STATMENT */
        $month = date('m');
        $year = date('y');
        $day = date('d');
        $calender_condition = CAL_GREGORIAN;
        $new_calender = cal_days_in_month($calender_condition, $month, $year);
        for ($i = 1; $i < $new_calender; $i++) {
            $days[] = $i;
            $daily = date('Y-m-') . $i;
            $date = date('Y-m-d', strtotime($daily));
            $datefrom = date('Y-m-d', strtotime('-22 days'));
            $dateto = date('Y-m-d', strtotime('+7days'));
            $all_noted_daily_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('id_buku_kas', '=', $id_kas)->whereBetween('created_at', [$datefrom, $dateto])->orderBy('created_at', 'asc')->paginate(10);
            $chart = DB::table('tbl_catatan_buku')->where('id_buku_kas', '=', $id_kas)->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereDate('created_at', '=', $date)->sum('catatan_saldo_kas');
            $nominal_income[] = $chart;
            $chart2 = DB::table('tbl_catatan_buku')->where('id_buku_kas', '=', $id_kas)->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereDate('created_at', '=', $date)->sum('catatan_saldo_kas');
            $nominal_expenditure[] = $chart2;
            # code...
        }
        $income = json_encode($nominal_income);
        $expenditure = json_encode($nominal_expenditure);
        $all_date = json_encode($days);
        /* STATISTIC DAILY CASH STATMENT */
        return view('Web.Laporan-Kas.ID_lapora_kas.daily', compact([
            'all_book',
            'name_cash_book',
            'all_noted_daily_CashStatement',
            'income',
            'expenditure',
            'all_date'
        ]));
    }
    public function weeklyID_CashStatement($id_kas)
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->get();
        $name_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $id_kas)->first();
        /* ALL BOOK END */
        /* STATISTIK */
        for ($i = 0; $i <= 6; $i++) {
            # code...
            $minggu = date('Y-m-d', strtotime(date('Y-m-d')) - $i);
            $d = date('D', strtotime($i . 'days'));
            $day = $this->hari_ini($d);
            $e[] = $day;
            $datefrom_week = date('Y-m-d', strtotime('-22 days'));
            $dateto_week = date('Y-m-d', strtotime('+7 days'));
            $all_noted_weeklyID_CashStatement  = DB::table('tbl_catatan_buku')->where('id_buku_kas', '=', $id_kas)->where('id_users', '=', $this->Auth())->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'asc')->paginate(10);
            $catatan_jumlahminggu = DB::table('tbl_catatan_buku')->where('id_buku_kas', '=', $id_kas)->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereDate('created_at', '=', $minggu)->sum('catatan_saldo_kas');
            $catatan_jumlahminggu12[] = $catatan_jumlahminggu;
            $catatan_jumlahminggu2 = DB::table('tbl_catatan_buku')->where('id_buku_kas', '=', $id_kas)->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereDate('created_at', '=', $minggu)->sum('catatan_saldo_kas');
            $catatan_jumlahminggu24[] = $catatan_jumlahminggu2;
        }
        $weekly = json_encode($e);
        $weekly_income = json_encode($catatan_jumlahminggu12);
        $weekly_expenditure = json_encode($catatan_jumlahminggu24);
        /* STATISTIK END */
        return view('Web.Laporan-Kas.ID_lapora_kas.weekly', compact([
            'all_book',
            'all_noted_weeklyID_CashStatement',
            'name_cash_book',
            'weekly',
            'weekly_income',
            'weekly_expenditure'
        ]));
    }
    public function monthlyID_CashStatement($id_kas)
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $id_kas);
        $name_cash_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $id_kas)->first();
        /* ALL BOOK END */
        /* ALL NOTED */
        $all_noted_monthlyID_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('id_buku_kas', '=', $id_kas)->get();
        /* ALL NOTED */
        $data_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for ($bulan = 1; $bulan <= 13; $bulan++) {
            # code...
            $month = date('Y-') . $bulan . date('-d');
            $date = date('m', strtotime($month));
            $all_noted_monthly_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->whereMonth('created_at', '=', date('m'))->orderBy('created_at', 'asc')->paginate(10);
            $catatan_jumlah = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pemasukan')->whereMonth('created_at', '=', $date)->sum('catatan_saldo_kas');
            $jumlah_catatan[] = $catatan_jumlah;

            $catatan_jumlah2 = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('catatan_keterangan', '=', 'Pengeluaran')->whereMonth('created_at', '=', $date)->sum('catatan_saldo_kas');
            $jumlah_catatan2[] = $catatan_jumlah2;
        }
        $all_month = json_encode($data_bulan);
        $month_income = json_encode($jumlah_catatan);
        $month_expenditure = json_encode($jumlah_catatan2);
        return view('Web.Laporan-Kas.ID_lapora_kas.monthly', compact([
            'all_book',
            'all_noted_monthlyID_CashStatement',

        ]));
    }
    public function annualID_CashStatement($id_kas)
    {
        /* ALL BOOK */
        $all_book = DB::table('tbl_buku_kas')->where('id_users', '=', $this->Auth())->where('id_kas', '=', $id_kas)->get();
        /* ALL BOOK END */
        /* ALL NOTED */
        $all_noted_annualID_CashStatement = DB::table('tbl_catatan_buku')->where('id_users', '=', $this->Auth())->where('id_buku_kas', '=', $id_kas)->get();
        /* ALL NOTED */
        return view('', compact([
            'all_book',
            'all_noted_annualID_CashStatement'
        ]));
    }
}

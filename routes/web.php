<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/', 'Web\HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function () {
    /* DASHBOARD ALAN */
    Route::get('/dashboard', 'Web\DashboardController@index_dashboard')->name('index_dashboard');
    Route::get('/dashboard/{id_kas}', 'Web\DashboardController@show_dashboard')->name('show_dashboard');
    /* DASHBOARD ALAN END */
    /* CASH BOOK ALAN */
    /* BOOK FORM */
    Route::get('/form-book/create', 'Web\FormBukuController@create_BukuKas')->name('create_BukuKas');
    Route::post('/form-book', 'Web\FormBukuController@save_BukuKas')->name('save_BukuKas');
    /* BOOK FORM END */
    Route::get('/book', 'Web\BukuKasController@index_BukuKas')->name('index_BukuKas');
    Route::get('/book/{id_kas}', 'Web\BukuKasController@show_BukuKas')->name('show_BukuKas');
    Route::get('/book/{id_kas}/date', 'Web\BukuKasController@filterdate')->name('show_BukuKas_date');
    Route::post('/book/{id_kas}/save', 'Web\BukuKasController@save_Noted_BukuKas')->name('save_Noted_BukuKas');
    Route::get('/book/{id_catatan}/notes', 'Web\BukuKasController@notes_book')->name('noted_book');
    Route::patch('/book/{id_catatan}/update', 'Web\BukuKasController@update_BukuKas')->name('update_BukuKas');
    Route::get('/book/{id_catatan}/delete', 'Web\BukuKasController@delete_BukuKas')->name('delete_BukuKas');
    /* CASH BOOK ALAN END */

    /* DEBT */
    Route::get('/debt', 'Web\DebtController@index_Debt')->name('index_Debt');
    Route::get('/debt/{id_debt}', 'Web\DebtController@show_Debt')->name('show_Debt');
    Route::post('/debt/save', 'Web\DebtController@save_Debt')->name('save_Debt');
    Route::get('/debt/{id_debt}/edit', 'Web\DebtController@edit_Debt')->name('edit_Debt');
    Route::patch('/debt/{id_debt}/update', 'Web\DebtController@update_Debt')->name('update_Debt');
    Route::get('/debt/{id_debt}/delete', 'Web\DebtController@delete_Debt')->name('delete_Debt');
    /* DEBT END */

    /* ACCOUNTS RECEIVABLE */
    Route::get('/account_receivable', 'Web\AccountsReceivableController@index_AccountsReceivable')->name('index_AccountsReceivable');
    Route::get('/account_receivable/{id_piutang}/view', 'Web\AccountsReceivableController@show_AccountsReceivable')->name('show_AccountsReceivable');
    Route::post('/account_receivable/save', 'Web\AccountsReceivableController@save_AccountsReceivable')->name('post_AccountsReceivable');
    Route::patch('/account_receivable/{id_piutang}/update', 'Web\AccountsReceivableController@update_AccountsReceivable')->name('update_AccountsReceivable');
    Route::get('/account_receivable/{id_piutang}/delete', 'Web\AccountsReceivableController@delete_AccountsReceivable')->name('delete_AccountsReceivable');
    /* ACCOUNTS RECEIVABLE END */

    /* CASH STATEMENT */
    Route::get('/cash-statement/daily', 'Web\CashStatementController@daily_CashStatement')->name('daily_CashStatement');
    Route::get('/cash-statement/weekly', 'Web\CashStatementController@weekly_CashStatement')->name('weekly_CashStatement');
    Route::get('/cash-statement/monthly', 'Web\CashStatementController@monthly_CashStatement')->name('monthly_CashStatement');
    Route::get('/cash-statement/annual', 'Web\CashStatementController@annual_CashStatement')->name('annual_CashStatement');
    /* CASH STATEMENT ID */
    Route::get('/cash-statement/{id_kas}/daily', 'Web\CashStatementController@dailyID_CashStatement')->name('dailyID_CashStatement');
    Route::get('/cash-statement/{id_kas}/weekly', 'Web\CashStatementController@weeklyID_CashStatement')->name('weeklyID_CashStatement');
    Route::get('/cash-statement/{id_kas}/monthly', 'Web\CashStatementController@monthlyID_CashStatement')->name('monthlyID_CashStatement');
    Route::get('/cash-statement/{id_kas}/annual', 'Web\CashStatementController@annualID_CashStatement')->name('annualID_CashStatement');
    /* CASH STATEMENT END */

    /* ================= LETTER ================= */
    /* LEETER COLLECTION */
    Route::group(['prefix' => 'letter'], function () {
        Route::get('/types_letter', 'Web\LetterController@index_Letter')->name('index_Letter');
        /* LEETER COLLECTION END */
        /* CUSTOMER */
        Route::prefix('customer')->group(function () {
            Route::get('/index', 'Web\CustomerController@index_Customer')->name('index_Customer');
            Route::get('/create', 'Web\CustomerController@create_Customer')->name('create_Customer');
            Route::post('/create/save', 'Web\CustomerController@save_Customer')->name('save_Customer');
            Route::get('/{id_customer}/view', 'Web\CustomerController@show_Customer')->name('show_Customer');
            Route::post('/{id_customer}/update', 'Web\CustomerController@update_Customer')->name('update_Customer');
            Route::get('/{id_customer}/delete', 'Web\CustomerController@delete_Customer')->name('delete_Customer');
        });
        /* CUSTOMER END */

        /* QUOTATION LETTER */
        Route::prefix('quotation-letter')->group(function () {
            Route::get('index', 'Web\QuotationLetterController@index_QuotationLetter')->name('index_QuotationLetter');
            Route::get('create', 'Web\QuotationLetterController@create_QuotationLetter')->name('create_QuotationLetter');
            Route::post('create/save', 'Web\QuotationLetterController@save_QuotationLetter')->name('save_QuotationLetter');
            Route::get('/{id_quotation}', 'Web\QuotationLetterController@jquerycreate')->name('quotationjquerycreate');
            Route::get('{id_quotation}/view', 'Web\QuotationLetterController@view_QuotationLetter')->name('view_QuotationLetter');
            Route::post('{id_quotation}/update', 'Web\QuotationLetterController@update_QuotationLetter')->name('update_QuotationLetter');
            Route::get('{id_quotation}/delete', 'Web\QuotationLetterController@delete_QuotationLetter')->name('delete_QuotationLetter');
            Route::get('{id_quotation}/print', 'Web\QuotationLetterController@print_QuotationLetter')->name('print_QuotationLetter');
        });
        /* QUOTATION LETTER END */
        /* OFFERING LETTER */
        Route::prefix('offering-letter')->group(function () {
            Route::get('index', 'Web\OfferingLetterController@index_OfferingLetter')->name('index_OfferingLetter');
            Route::get('create', 'Web\OfferingLetterController@create_OfferingLetter')->name('create_OfferingLetter');
            Route::post('store', 'Web\OfferingLetterController@post_OfferingLetter')->name('post_OfferingLetter');
            Route::get('{id_offering}/view', 'Web\OfferingLetterController@view_OfferingLetter')->name('show_OfferingLetter');
            Route::post('{id_offering}/update', 'Web\OfferingLetterController@update_OfferingLetter')->name('update_OfferingLetter');
            Route::get('{id_offering}/delete', 'Web\OfferingLetterController@delete_OfferingLetter')->name('delete_OfferingLetter');
            Route::get('{id_offering}/print', 'Web\OfferingLetterController@print_OfferingLetter')->name('print_OfferingLetter');
        });
        /* OFFERING LETTER END */
        /* INVOICE LETTER END */
        Route::prefix('invoice-letter')->group(function () {
            Route::get('index', 'Web\InvoiceLetterController@index_InvoiceLetter')->name('index_InvoiceLetter');
            Route::get('create', 'Web\InvoiceLetterController@create_InvoiceLetter')->name('create_InvoiceLetter');
            Route::post('create/save', 'Web\InvoiceLetterController@save_InvoiceLetter')->name('save_InvoiceLetter');
            Route::get('/{id_invoice}', 'Web\InvoiceLetterController@jquerycreate')->name('invoicejquerycreate');
            Route::get('{id_invoice}/view', 'Web\InvoiceLetterController@view_InvoiceLetter')->name('view_InvoiceLetter');
            Route::post('{id_invoice}/update', 'Web\InvoiceLetterController@update_InvoiceLetter')->name('update_InvoiceLetter');
            Route::get('{id_invoice}/delete', 'Web\InvoiceLetterController@delete_InvoiceLetter')->name('delete_InvoiceLetter');
            Route::get('{id_invoice}/print', 'Web\InvoiceLetterController@print_InvoiceLetter')->name('print_InvoiceLetter');
        });
        /* INVOICE LETTER END */

        /* ================= LETTER END ================= */
    });
    Route::group(['prefix' => 'user'], function () {
        /* AKUN */
        Route::prefix('akun')->group(function () {
            Route::get('/user', 'Web\AkunController@view_user')->name('view_user');
            Route::get('/{id_user}/edit', 'Web\AkunController@edit_user')->name('edit_user');
            Route::post('/{id_user}/update', 'Web\AkunController@update_user')->name('update_user');
        });
        /* AKUN END */
    });
});

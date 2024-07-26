<?php

use Illuminate\Support\Facades\Route;
use Modules\Sales\Http\Controllers\OrdersController;
use Modules\Sales\Http\Controllers\CustomerController;
use Modules\Sales\Http\Controllers\QuotationController;
use Modules\Sales\Http\Controllers\EnquiryController;
use Modules\Sales\Http\Controllers\ExpensesController;
use Modules\Sales\Http\Controllers\InvoiceController;
use Modules\Sales\Http\Controllers\SettingController;
use Modules\Sales\Http\Controllers\IncomeController;
use Modules\Sales\Http\Controllers\TransactionController;
use Modules\Sales\Http\Controllers\ReportsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your aaplication. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ['as' => 'sales.', 'prefix' => 'sales'],
    function () {
        // Route::group(['middleware' => 'auth'], function () {
        // Route::get('category', [PcApiController::class, 'index'])->name('category');
        Route::post('customer-status', [CustomerController::class, 'changeStatus'])->name('change-status');
        Route::resource('customer', CustomerController::class);
        Route::get('customer-filter', [CustomerController::class, 'customerfilter'])->name('customer-filter');

         Route::post('get-customerDetails', [CustomerController::class, 'customerDetails'])->name('customerDetails');

         Route::post('customer-create', [CustomerController::class, 'customerCreate'])->name('customer-create');

         

        Route::resource('orders', OrdersController::class);

        Route::get('/orders/details/{id}', [OrdersController::class, 'details']);

        Route::get('/orders/order-timelines/{order_number}', [OrdersController::class, 'orderStatus'])->name('OrderStatus');
        Route::post('/orders/update-order-status', [OrdersController::class, 'updateOrdStatus'])->name('UpdateOrdStatus');

        Route::get('/orders-details-pdf/{id}', [OrdersController::class, 'orderDetailspdf'])->name('order-download-pdf');


        // quotation raute
        Route::resource('quotation', QuotationController::class);
        Route::post('quote-filter', [QuotationController::class, 'quoteFilter'])->name('quote-filter');
        Route::get('quotation/details/{id}', [QuotationController::class, 'details']);
        Route::get('/quotation-details-pdf/{id}', [QuotationController::class, 'quotationDetailspdf'])->name('quote-download-pdf');


        //  Custome Quotaton Routes

        Route::get('/custom-quote',[QuotationController::class, 'custQuoteIndex'])->name('custom-quote');
        Route::get('/create/custom-quote',[QuotationController::class, 'createCustomeQuote'])->name('create-custome-quote');
        Route::get('edit/{id}/custom-quote', [QuotationController::class, 'edit'])->name('editCustomeQuote');
        Route::post('update/{id}/custom-quote', [QuotationController::class, 'update'])->name('updateCustomeQuote');
        // Route::post('quote-filter', [QuotationController::class, 'quoteFilter'])->name('quote-filter');
        Route::get('custom-quote/details/{id}', [QuotationController::class, 'details']);
        // Route::get('/quotation-details-pdf/{id}', [QuotationController::class, 'quotationDetailspdf'])->name('quote-download-pdf');
        

        Route::post('SearchSuggestion', [QuotationController::class, 'SearchSuggestion'])->name('SearchSuggestion');
        Route::post('search-item-detail', [QuotationController::class, 'SearchItemDetail'])->name('SearchItemDetail');
        Route::post('services-service', [QuotationController::class, 'SearchServices'])->name('SearchServices');
        Route::post('search-service-detail', [QuotationController::class,
        'SearchServiceDetail'])->name('SearcServiceDetail');

        Route::post('quotation-delete', [QuotationController::class, 'DeleteQuotation'])->name('quotation-delete');
        Route::post('quotation-changeStatus', [QuotationController::class, 'changeStatus'])->name('quotation-changeStatus');
        Route::get('/filter/', [OrdersController::class, 'filter'])->name('orderfilter');

        Route::resource('enquiry', EnquiryController::class);
        Route::post('enquiry-status', [EnquiryController::class, 'changeStatus'])->name('enquiry-status');
        Route::get('enquiry-filter', [EnquiryController::class, 'enquiryFilter'])->name('enquiry-filter');

        Route::resource('expenses', ExpensesController::class);
       
        Route::resource('income', IncomeController::class);
        
        Route::get('income-calendar', [IncomeController::class,
        'calendar'])->name('income.income_calendar');

    
        //sales invoice
        Route::resource('invoice', InvoiceController::class);
        Route::get('invoice/details/{id}', [InvoiceController::class, 'details']); 
        Route::post('invo-filter', [InvoiceController::class, 'invoFilter'])->name('invo-filter');
        Route::get('/invoice-details-pdf/{id}', [InvoiceController::class,
        'invoiceDetailspdf'])->name('invoice-download-pdf');

        Route::get('/invoice-dublicate', [InvoiceController::class,
        'dublicate'])->name('invoice.dublicate');

        

        Route::post('invoice-changeStatus', [InvoiceController::class,
        'changeStatus'])->name('invoice-changeStatus');

        Route::post('dueChange', [InvoiceController::class,
        'changeDate'])->name('due-date-change');

        Route::post('services-add', [InvoiceController::class, 'servicesAdd'])->name('servicesAdd');

        Route::get('/download-invoice/{id}', [InvoiceController::class, 'invoiceDownload'])->name('download-invoice');
        
    }
);

Route::group(
['as' => 'accounts.', 'prefix' => 'accounts'],
function () {
    //accounts reports
    Route::resource('report', ReportsController::class);
    Route::post('generate-annual-report', [ReportsController::class, 'AnualReport'])->name('annual-report.generate');

    
    //sales transaction
    Route::resource('transaction', TransactionController::class);
    Route::post('delete', [TransactionController::class, 'destroy'])->name('destroy');
    Route::get('transaction-calendar', [TransactionController::class,
    'calendar']);
    Route::post('txn-filter', [TransactionController::class, 'txnFilter'])->name('txn-filter');

 
    
    Route::get('txn/export/{txnhead}/{txncategory}/{accounts}/{startDate}/{endDate}',
    [TransactionController::class, 'export'])->name('txn-export');

    Route::resource('setting', SettingController::class);
    Route::get('sales-setting-edit/{id}', [SettingController::class,'edit'])->name('sales-setting--edit');
    Route::get('sales-account-edit/{id}', [SettingController::class,'accountEdit'])->name('sales-account-edit');
    Route::post('expese-setting-update', [SettingController::class, 'updateExpense'])->name('expese-setting-update');
    Route::post('Expense-setting-delete', [SettingController::class,
    'deleteExpenseSetting'])->name('deleteExpenseSetting');
    Route::post('Account-setting-delete', [SettingController::class, 'deleteExpenseAcc'])->name('deleteExpenseAcc');
    Route::post('account-store', [SettingController::class, 'accountStore'])->name('accountStore');
    Route::post('expese-account-update', [SettingController::class,
    'updateAccount'])->name('expese-account-update');
    
    Route::post('txn-category-status', [SettingController::class, 'changeCateStatus'])->name('txn-category-status');
    Route::post('txn-account-status', [SettingController::class, 'changeAccStatus'])->name('txn-account-status');


 
    Route::post('txn-head-store', [SettingController::class, 'txnHeadStore'])->name('txn-head-store');
    Route::post('txn-head-create', [SettingController::class, 'headResultCreate'])->name('txn-head-create');
    Route::get('txn-head-edit/{id}', [SettingController::class, 'HeadEdit'])->name('txn-head-edit');
    Route::post('txn-head-update', [SettingController::class, 'headUpdate'])->name('txn-head-update');
    Route::post('txn-head-delete/{id}', [SettingController::class, 'HeadDestroy'])->name('txn-head-delete');
    Route::post('txn-head-status', [SettingController::class, 'changeHeadStatus'])->name('changeHeadStatus');
    Route::post('sort-order', [SettingController::class, 'changeSortOrder'])->name('change_short_order');
    Route::post('category-sort-order', [SettingController::class, 'changeCategorySortOrder'])->name('change_category_short_order');
    

});
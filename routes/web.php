<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use Yajra\DataTables\DataTables;
use App\Models\Customer;
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
    $customers = App\Models\Customer::all();
    return view('home', compact('customers'));
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/serverSide', [
    'as'   => 'serverSide',
    'uses' => function () {
        $users = App\Models\Customer::all();
        return Datatables::of($users)->make();
    }
]);

Route::get('/customer-list', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/service', [CustomerController::class, 'service'])->name('customer.service');
Route::get('/service_order', [CustomerController::class, 'service_order'])->name('customer.service_order');
Route::get('admin/order_today', [CustomerController::class, 'order_today'])->name('customer.order_today');
Route::get('admin/service_today', [CustomerController::class, 'service_today'])->name('customer.service_today');
Route::get('admin/bill_today', [CustomerController::class, 'bill_today'])->name('customer.bill_today');
Route::get('admin/bills/{from?}/{to?}', [CustomerController::class, 'bills'])->name('customer.bills');
Route::get('admin/not_bills/{from?}/{to?}', [CustomerController::class, 'not_bills'])->name('customer.not_bills');


Route::get('invoice', [CustomerController::class, 'invoice'])->name('customer.invoice');
Route::get('generatePDF_not_bills/{from?}/{to?}', [CustomerController::class, 'generatePDF_not_bills'])->name('customer.generatePDF_not_bills');
Route::get('generatePDF_bills/{from?}/{to?}/{total?}', [CustomerController::class, 'generatePDF_bills'])->name('customer.generatePDF_bills');
Route::get('generatePDF_service_today', [CustomerController::class, 'generatePDF_service_today'])->name('customer.generatePDF_service_today');
Route::get('generatePDF_order_today', [CustomerController::class, 'generatePDF_order_today'])->name('customer.generatePDF_order_today');
Route::get('generatePDF_order_today_all', [CustomerController::class, 'generatePDF_order_today_all'])->name('customer.generatePDF_order_today_all');

Route::get('customers/edit/{customer?}',[CustomerController::class, 'edit'])->name('customer.edit');
Route::get('customers/isdone/{customer?}',[CustomerController::class, 'isdone'])->name('customer.isdone'); 
Route::get('customers/print_order/{customer?}',[CustomerController::class, 'print_order'])->name('customer.print_order'); 

Route::get('customers/is_service/{customer?}',[CustomerController::class, 'is_service'])->name('customer.is_service');
Route::post('customers/addorder',[CustomerController::class, 'addorder'])->name('customer.addorder');  

Route::get('customer/{id}/edit', 'CustomerController@edit');
Route::post('customer-list/store', 'CustomerController@store');
Route::get('customer-list/delete/{id}', 'CustomerController@destroy');

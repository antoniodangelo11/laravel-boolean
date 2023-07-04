<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\InvoiceController;
use App\Http\Controllers\Guest\PageController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/invoices/trashed', [InvoiceController::class, 'trashed'])->name('invoices.trashed');
Route::post('/invoices/{invoice}/restore', [InvoiceController::class, 'restore'])->name('invoices.restore');
Route::delete('/invoices/{invoice}/harddelete', [InvoiceController::class, 'harddelete'])->name('invoices.harddelete');
Route::resource('invoices', InvoiceController::class);

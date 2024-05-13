<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\FilterController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('index');
Route::get('/', [App\Http\Controllers\InvoiceController::class, 'index'])->name('index');
Route::get('/{status?}', [App\Http\Controllers\FilterController::class, 'index'])->name('welcome.filter');


// Guest
Route::controller(InvoiceController::class)->prefix('invoice')->group(function () {
    Route::get('', 'index')->name('welcome');
    Route::get('create', 'create')->name('invoice.create');
    Route::post('store', 'store')->name('invoice.store');    
    Route::get('show/{id}', 'show')->name('invoice.show');
    Route::get('edit/{id}', 'edit')->name('invoice.edit');
    Route::delete('destroy/{id}', 'destroyid')->name('invoice.destroyrecord');
    Route::patch('payed/{id}', 'payed')->name('invoice.payed');
    Route::patch('/{invoice}', 'update')->name('invoice.update');


});
// Route to remove Items listed on edit form
Route::delete('invoice/edit/{id}', [App\Http\Controllers\ItemsController::class, 'destroy'])->name('invoice.destroy');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



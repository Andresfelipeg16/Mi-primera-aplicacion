<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

    Route::get('/home', [HomeController::class, 'index']);


Route::controller(ProductosController::class)->group(function() {


    Route::get('/product', 'index')->name('productos.index');
    Route::get('/{id}', 'edit')->name('productos.edit');
    Route::delete('/product/{id}', 'eliminar')->name('productos.eliminar');
    Route::post('/product/create', 'store')->name('productos.create');
    Route::post('/product/put/{id}', 'actualizar')->name('productos.put');
});

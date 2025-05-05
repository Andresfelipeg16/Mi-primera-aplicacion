<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return "hoal";
//     return view('welcome');
// });


// Route::get('/gamez',function() {
//     return "hoal";
// });

Route::controller(ProductosController::class)->group(function() {
    
    Route::get('/product', 'index')->name('productos.index');
    Route::get('/{id}', 'edit')->name('productos.edit');
    Route::delete('/product/{id}', 'eliminar')->name('productos.eliminar');
    Route::post('/product/create', 'store')->name('productos.create');
    Route::put('/product/put/{id}', 'actualizar')->name('productos.put');
});
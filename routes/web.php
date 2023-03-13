<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('product');
// });

Route::get('/',[ProductController::class,'product'])->name('product');
Route::post('/add-product',[ProductController::class,'addProduct'])->name('add.product');
Route::get('/add-store',[ProductController::class,'storeProduct'])->name('store.product');
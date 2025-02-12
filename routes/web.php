<?php 

use Src\Http\Route;
use App\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/add-product', [ProductController::class, 'create']);
Route::post('/add-product', [ProductController::class, 'store']);
Route::delete('/products', [ProductController::class, 'delete']);

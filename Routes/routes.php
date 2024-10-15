<?php 

use Core\Router;
use App\controllers\ProductController;

Router::get('/', [ProductController::class, 'index']);
Router::get('/add-product', [ProductController::class, 'create']);
Router::post('/add-product', [ProductController::class, 'store']);
Router::delete('/products', [ProductController::class, 'delete']);






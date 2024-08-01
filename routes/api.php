<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\productController;

Route::get('/products', [productController::class, 'index']);

Route::get('/products/{id}', [productController::class, 'show']);

Route::post('/products', [productController::class, 'store']);

Route::put('/products/{id}', [productController::class, 'update']);

Route::patch('/products/{id}', [productController::class, 'updatePartial']);

Route::delete('/products/{id}',[productController::class, 'destroy']);

Route::get('products-deleted', [ProductController::class, 'deleted']); // Nueva ruta para listar productos eliminados
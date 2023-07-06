<?php

use App\Http\Controllers\ListingsController;
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

Route::get('/',[ListingsController::class,"index"]);

Route::delete("/listings/{listing}",[ListingsController::class,"destroy"]);

Route::get("/listings/create",[ListingsController::class,"create"]);

Route::post("/listings",[ListingsController::class,"store"]);

Route::get("/listings/edit/{listing}",[ListingsController::class,"edit"]);

Route::put("/listings/{listing}",[ListingsController::class,"update"]);


Route::get('/listings/{listing}',[ListingsController::class,"show"]);



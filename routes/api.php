<?php

use App\Http\Controllers\FileController;
use App\Services\ProductsImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('process', function () {
    $f = "to_process/OsDnEwLJ6ni7WV6WEIk08Z6yUzQY5fSi7PVwb7tH.csv";
    Excel::import(new ProductsImportService, $f);
});

Route::middleware(['auth:sanctum'])->post('files/upload', [FileController::class, 'upload'])->name('files.upload');

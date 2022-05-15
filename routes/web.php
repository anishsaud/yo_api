<?php

use App\Http\Controllers\FileController;
use App\Models\File;
use App\Services\ProductsImportService;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('process', function () {
    $f = "to_process/OsDnEwLJ6ni7WV6WEIk08Z6yUzQY5fSi7PVwb7tH.csv";
    $f = File::latest('id')->first();
    Excel::import(new ProductsImportService($f), $f->store_location);
});

// Route::middleware(['auth:sanctum'])->post('files/upload', [FileController::class, 'upload'])->name('files.upload');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);

Route::get('/csv/import', [CsvImportController::class, 'show'])->name('csv.import');
Route::post('/csv/import', [CsvImportController::class, 'import'])->name('csv.import.process');

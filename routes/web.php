<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\RowController;
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

Route::prefix('')->group(function () {
    Route::get('', [IntegrationController::class, 'index'])->name('integrations.index');
    Route::post('import', [IntegrationController::class, 'import'])->name('rows.import');
    Route::prefix('rows')->group(function () {
        Route::get('', [RowController::class, 'index'])->name('rows.index');
    });
});

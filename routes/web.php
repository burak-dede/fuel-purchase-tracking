<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\VehicleController;
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
Route::redirect('/', '/login');

Route::get('/purchase', [PurchaseController::class, 'create'])->middleware('auth')->name('purchase');

Route::post('/purchase', [PurchaseController::class, 'store'])->middleware('auth')->name('purchase.addPurchase');

Route::delete('/purchase/{id}', [PurchaseController::class, 'destroy'])->middleware('admin')->name('purchase.destroy');

Route::get('/dashboard', [DashboardController::class, 'create'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/export', [DashboardController::class, 'export'])->middleware(['auth'])->name('dashboard.export');

Route::get('/personelarac', [PersonelController::class, 'show'])->middleware(['admin'])->name('personelarac');

Route::post('/personelarac', [VehicleController::class, 'store'])->middleware(['admin'])->name('yeniArac');

Route::delete('/arac/{plate}', [VehicleController::class, 'destroy'])->middleware(['admin'])->name('aracSil');

Route::get('/yeniPersonel', [PersonelController::class, 'create'])->middleware(['auth'])->name('yeniPersonel');

Route::post('/yeniPersonel', [PersonelController::class, 'store'])->middleware(['auth'])->name('yeniPersonel');

require __DIR__.'/auth.php';

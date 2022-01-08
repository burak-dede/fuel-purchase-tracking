<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PersonelVehicleController;
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

Route::get('/personelvehicle', [PersonelVehicleController::class, 'create'])->middleware(['admin'])->name('personelvehicle');

Route::post('/personelvehicle', [VehicleController::class, 'store'])->middleware(['admin'])->name('createVehicle');

Route::delete('/vehicle/{plate}', [VehicleController::class, 'destroy'])->middleware(['admin'])->name('deleteVehicle');

Route::get('/createPersonel', [PersonelController::class, 'create'])->middleware(['auth'])->name('createPersonel');

Route::post('/createPersonel', [PersonelController::class, 'store'])->middleware(['auth'])->name('createPersonel');

Route::delete('/personel/{id}', [PersonelController::class, 'destroy'])->middleware(['admin'])->name('deletePersonel');

require __DIR__.'/auth.php';

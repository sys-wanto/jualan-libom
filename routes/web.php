<?php

use App\Http\Controllers\endController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\Dati2Controller;
use App\Http\Controllers\Admin\PropinsiController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProductController;

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

Route::redirect('/', '/login', 301);



Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Route::get('/propins', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('propinsi', PropinsiController::class);
    Route::resource('dati2', Dati2Controller::class);
    Route::get('dati2/{KD_PROPINSI}/{KD_KABUPATEN}/edit', [KabupatenController::class,'edit'])->name('dati2.editnew');
    Route::put('dati2/{KD_PROPINSI}/{KD_KABUPATEN}', [KabupatenController::class,'update']);
    Route::delete('dati2/{KD_PROPINSI}/{KD_KABUPATEN}', [KabupatenController::class,'destroy']);
});

Route::prefix('manager')->name('manager.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'manager'
])->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('user')->name('user.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user'
])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

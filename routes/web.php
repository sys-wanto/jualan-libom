<?php

use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\Dati2Controller;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\PropinsiController;
use App\Http\Controllers\Admin\RtController;
use App\Models\Kelurahan;
use GuzzleHttp\Handler\Proxy;

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
    // dati2
    Route::resource('dati2', Dati2Controller::class);
    Route::get('dati2/{KD_PROPINSI}/{KD_KABUPATEN}/edit', [Dati2Controller::class,'edit_new'])->name('dati2.editnew');
    Route::put('dati2/{KD_PROPINSI}/{KD_KABUPATEN}', [Dati2Controller::class,'update_new'])->name('dati2.updatenew');
    Route::delete('dati2/{KD_PROPINSI}/{KD_KABUPATEN}', [Dati2Controller::class,'destroy_new'])->name('dati2.deletetenew');

    // kecamatan
    Route::resource('kecamatan', KecamatanController::class);
    Route::get('kecamatan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/edit', [KecamatanController::class,'edit_new'])->name('kecamatan.editnew');
    Route::put('kecamatan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}', [KecamatanController::class,'update_new'])->name('kecamatan.updatenew');
    Route::delete('kecamatan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}', [KecamatanController::class,'destroy_new'])->name('kecamatan.deletetenew');

    // kelurahan
    Route::resource('kelurahan', KelurahanController::class);
    Route::get('kelurahan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/{KD_KELURAHAN}/edit', [KelurahanController::class,'edit_new'])->name('kelurahan.editnew');
    Route::put('kelurahan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/{KD_KELURAHAN}', [KelurahanController::class,'update_new'])->name('kelurahan.updatenew');
    Route::delete('kelurahan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/{KD_KELURAHAN}', [KelurahanController::class,'destroy_new'])->name('kelurahan.deletetenew');

    // rt
    Route::resource('rt', RtController::class);
    Route::get('rt/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/{KD_KELURAHAN}/{KD_RT}/edit', [RtController::class,'edit_new'])->name('rt.editnew');
    Route::put('rt/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/{KD_KELURAHAN}/{KD_RT}', [RtController::class,'update_new'])->name('rt.updatenew');
    Route::delete('rt/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/{KD_KELURAHAN}/{KD_RT}', [RtController::class,'destroy_new'])->name('rt.deletetenew');

        // kecamatan
    // Route::resource('kecamatan', KecamatanController::class);
    // Route::get('kecamatan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}/edit', [KecamatanController::class,'edit_new'])->name('kecamatan.editnew');
    // Route::put('kecamatan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}', [KecamatanController::class,'update_new'])->name('kecamatan.updatenew');
    // Route::delete('kecamatan/{KD_PROPINSI}/{KD_KABUPATEN}/{KD_KECAMATAN}', [KecamatanController::class,'destroy_new'])->name('kecamatan.deletetenew');

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

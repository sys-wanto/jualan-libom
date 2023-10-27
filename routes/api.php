<?php

use App\Http\Controllers\Admin\PropinsiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MidtransCallbackController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get/dati2/{KD_PROPINSI}', [PropinsiController::class,'getdati2'])->name('gets.dati2');
Route::get('get/kecamatan/{KD_PROPINSI}/{KD_DATI2}', [PropinsiController::class,'getkecamatan'])->name('gets.kecamatan');
Route::get('get/kelurahan/{KD_PROPINSI}/{KD_DATI2}/{KD_KECAMATAN}', [PropinsiController::class,'getkelurahan'])->name('gets.kecamatan');

Route::post('midtrans/callback', [MidtransCallbackController::class, 'callback']);


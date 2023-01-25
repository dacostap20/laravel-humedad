<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HumedadPaisesController;
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
    return view('welcome');
});

Route::get('/ver-humedad', [HumedadPaisesController::class, 'index']);
Route::get('/ver-humedad-ciudad/{lugar?}/{fecha?}', [HumedadPaisesController::class, 'lugarEspecifico']);
Route::post('/ver-humedad-fecha', [HumedadPaisesController::class, 'cambioFecha']);
Route::get('/ver-historico', [HumedadPaisesController::class, 'verHistorico']);

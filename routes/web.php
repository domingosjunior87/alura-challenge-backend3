<?php

use App\Http\Controllers\TransacoesController;
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

Route::get('/importar', [TransacoesController::class, 'importar'])->name('importar');
Route::post('/importar', [TransacoesController::class, 'store']);

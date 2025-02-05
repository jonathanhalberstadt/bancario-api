<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContaController;
use App\Http\Controllers\TransacaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/conta', [ContaController::class, 'store']);
Route::get('/conta', [ContaController::class, 'show']);
Route::post('transacao', [TransacaoController::class, 'processarTransacao']);
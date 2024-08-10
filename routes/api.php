<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', LoginController::class);
Route::get('/quotes-page', [QuoteController::class, 'index'])->name('quotes.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/quotes', [QuoteController::class, 'fetchQuotes']);
});

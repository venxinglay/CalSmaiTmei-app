<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RandomizerController;
use App\Models\Randomzier;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Randomizer

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/randomizer', [RandomizerController::class, 'show']);
    Route::post('/randomizer', [RandomizerController::class, 'save']);
    Route::delete('randomizer/{id}', [RandomizerController::class, 'delete']);
    Route::post('/randomizer/generate', [RandomizerController::class, 'handleRandom']);
    Route::get('/export', [RandomizerController::class, 'export'])->name('export');
});


//Authorization
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [AuthController::class, 'forgot']);
Route::post('/password/reset', [AuthController::class, 'passwordReset']);

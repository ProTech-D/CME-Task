<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DataController;
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

/* Route::get('/', function () {
    return view('view');
}); */

Route::get('/', [PageController::class, 'index']);
Route::get('/getDatas', [DataController::class, 'all']);
Route::get('/getApiDatas', [DataController::class, 'apidata']);
Route::post('/registration', [DataController::class, 'registration']);

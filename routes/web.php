<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmitScope;

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

Route::get('/scope', function () {
  return view('scope');
});

Route::post('/scope', [EmitScope::class, 'sendDataToNode']);


Route::post('/receive-data', [EmitScope::class, 'sendDataToNode']);
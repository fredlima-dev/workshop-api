<?php

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
Route::prefix('tasks')->group(function(){
    Route::get('/', 'TasksController@index');
    Route::get('/{id}', 'TasksController@details');
    Route::post('/', 'TasksController@create');
    Route::put('/{id}', 'TasksController@update');
    Route::delete('/{id}', 'TasksController@delete');
});
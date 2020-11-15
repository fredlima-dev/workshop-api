<?php

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

Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');

Route::get('/sendmail', function(\App\Models\User $user, \Symfony\Component\HttpFoundation\Request $request) {

    $user = $user::where('email',$request->email)->first();
    if(!$user){
        return response()->json([
            'error' => 'Usuário não encontrado.'
        ], 404);
    }
    \Illuminate\Support\Facades\Mail::send(new \App\Mail\TestEmail($user));
});

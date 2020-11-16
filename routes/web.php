<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
;
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

Route::get('/sendmail', function(User $user, Request $request) {

    $user = $user::where('email',$request->email)->first();
    if(!$user){
        return response()->json([
            'error' => 'Usuário não encontrado.'
        ], 404);
    }

    $data = User::where('id', $user->id)->first();
    $data->token_reset_password = Str::random(32);
    $data->save();
    Mail::send(new \App\Mail\TestEmail($data));
});

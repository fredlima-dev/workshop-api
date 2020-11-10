<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json([
                'error' => 'Dados de acesso inválidos.', 401
            ]);
        }

        $user = User::where('id', Auth::id())->first();
        $user->token = Str::random(32);
        $user->save();

        return response()->json($user);
    }

    public function register(Request $request){
        $data = $request->only('name', 'email', 'password');

        $validator = User::validate($data);

        if($validator->fails()){
            return response()->json([
               'error' => 'Dados inválidos.',
               'data'  => $validator->errors()
            ], 400);
        }

        $data['password'] = Hash::make($data['password']);
        $data['token'] = Str::random(32);

        $user = User::create($data);

        return response()->json($user);
    }
}

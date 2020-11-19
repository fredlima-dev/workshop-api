<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();

        $request->token = null;
        return response()->json(
            [
            "message" => "usuário deslogado.",
            "nameUser" => $request->name,
            "userId" => Auth::id(),
            "token" => $request->token
            ]
        );
    }


  public function sendmail(User $user, Request $request)
    {
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
  }

    public function resetPassword(Request $request, User $user){

        $token = $request->input('token');

        $data = User::where('token_reset_password',$token)->first();

        if(!$data){
            return response()->json ([
                'error' => 'usuário não autenticado'
            ], 401);
        };
        $user = User::where('id', $data['id'])->first();
        $user->password = Hash::make($request['password']);
        $user->token_reset_password = '';
        $user->save();
    }

}

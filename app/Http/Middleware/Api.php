<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('Authorization');
        $token         = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $authorization));

        if(!$token){
            return response()->json([
                'error' => 'Token de acesso inválido.'
            ], 401);
        }

        $user = User::where('token', $token)->first();

        if(!$user){
            return response()->json([
                'error' => 'Usuário não encontrado.'
            ], 404);
        }

        Auth::login($user);

        $request->request->add([
            'user_id' => $user->id
        ]);

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;
use Firebase\JWT\JWT;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Autenticador
{
    public function handle(Request $request, Closure $next)
    {

        try{
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            } 
            $authorizationHeader = $request->header("Authorization");
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $dadosAuth = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            $user = User::where('email', $dadosAuth->email)->first();

            if(is_null($user)) {
                throw new \Exception();
            }

            return $next($request);
        } catch (\Exception $e) {
            return response('Você não tem autorização', 401);
        }
    }
}
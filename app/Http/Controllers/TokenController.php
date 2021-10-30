<?php

namespace App\Http\Controllers;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request){
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = User::where('email', $request->email)->first();

        // var_dump($usuario->password, $request->password);

        if(is_null($usuario)
            || $request->password != $usuario->password ){
            return response()->json('Usuário ou senha inválido', 401);
        }
        
        // gerando token
        $token = JWT::encode(
            ['email' => $request->email],
            env('JWT_KEY')
        );

        return [
            'access_token' => $token
        ];
    }
}
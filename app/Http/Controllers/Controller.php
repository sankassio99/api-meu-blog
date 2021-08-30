<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function index()
    {
        // return User::findOrFail($id);
        
        return Posts::all();
    }

    public function store(Request $request){
        return response()->json(Posts::create([
            "titulo" => $request->titulo,
            "conteudo" => $request->conteudo], 201)
        );
    }

    public function welcome(){
        return response("Hello World, Heroku !!", 200);
    }
}

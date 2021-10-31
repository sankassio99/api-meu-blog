<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function index()
    {
        return Posts::all();
    }

    public function show($id){
        return Posts::find($id);
    }

    public function store(Request $request){
        return response()->json(Posts::create($request->all(), 201));
    }

    public function destroy($id){
        $qtdRecursosRemovidos = Posts::destroy($id);

        if($qtdRecursosRemovidos === 0){
            return response()->json(["erro"=> "Recurso não encontrado"], 204);
        }

        return response()->json("removido com sucesso");
    }

    public function update(int $id, Request $request){
        $post = Posts::find($id);

        if($post==null){
            return response()->json(["erro" => "Recurso não encontrado"], 404) ;
        }
        $post->fill($request->all());
        $post->save();

        return response()->json($post) ;
        
    }

    public function welcome(){
        return response("Hello World, Heroku !!", 200);
    }
}

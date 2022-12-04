<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
   /*Funcion obtener*/
    public function index()
    {
        $Entradas = Entrada::with('Usuario', 'Categoria')->get();
        return $Entradas;
    }

    //FUNCION ACTUALIZAR
    public function actualizar($id, Request $request){
        $entrada = Entrada::find($id);
        if (!$entrada){
            return response([
                'message' => 'La entrada con el id ' . $id . ' no existe'
            ], 404);
        }
        $data = $request->validate($this->validateRequest());

        $entrada->update($data);
        return response([
            'message' => 'Se modifico con exito la entrada ' . $id
        ], 201);
    }

    //FUNCION ELIMINAR
    public function eliminar($id){
        $entrada = Entrada::find($id);
        if (!$entrada){
            return response([
                'message' => 'La entrada con el id ' . $id . ' no existe'
            ], 404);
        }

        $entrada->delete();
        return response([
            'message' => 'Se elimino con exito la entrada ' . $id
        ], 201);
    }

    //FUNCION CREAR
    public function crear(Request $request){
        $data = $request->validate($this->validateRequest());
        $entrada = Entrada::create($data);
        return response([
            'message'=>'Se creo con exito la Entrada',
            'id'=> $entrada['id']
        ], 201);
    }

    private function validateRequest(){
        return [
            'title'=>'required|string',
            'content'=>'required|string',
            'status'=>'required|string',
            'image'=>'required|string'
        ];
    }
}

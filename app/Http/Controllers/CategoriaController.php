<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //FUNCION OBTENER
    public function obtener(){
        $categoria = Categoria::all();
        return $categoria;
    }

    //FUNCION ACTUALIZAR
    public function actualizar($id, Request $request){
        $categoria = Categoria::find($id);
        if (!$categoria){
            return response([
                'message' => 'La categoria con el id ' . $id . ' no existe'
            ], 404);
        }
        $data = $request->validate($this->validateRequest());

        $categoria->update($data);
        return response([
            'message' => 'Se modifico con exito la categoria ' . $id
        ], 201);
    }

    //FUNCION ELIMINAR
    public function eliminar($id){
        $categoria = Categoria::find($id);
        if (!$categoria){
            return response([
                'message' => 'La categoria con el id ' . $id . ' no existe'
            ], 404);
        }

        $categoria->delete();
        return response([
            'message' => 'Se elimino con exito la categoria ' . $id
        ], 201);
    }

    private function validateRequest(){
        return [
            'nombre'=>'required|string',
            'descripcion'=>'required|string'
        ];
    }
}

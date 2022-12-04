<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //FUNCION OBTENER
    public function obtener(){
        $usuarios = Usuario::with('Entradas')->get();
        return $usuarios;
    }

    //FUNCION ACTUALIZAR
    public function actualizar($id, Request $request){
        $usuario = Usuario::find($id);
        if (!$usuario){
            return response([
                'message' => 'El usuario con el id ' . $id . ' no existe'
            ], 404);
        }
        $data = $request->validate($this->validateRequest());

        $usuario->update($data);
        return response([
            'message' => 'Se modifico con exito el usuario ' . $id
        ], 201);
    }

    //FUNCION ELIMINAR
    public function eliminar($id){
        $usuario = Usuario::find($id);
        if (!$usuario){
            return response([
                'message' => 'El usuario con el id ' . $id . ' no existe'
            ], 404);
        }

        $usuario->delete();
        return response([
            'message' => 'Se elimino con exito el usuario ' . $id
        ], 201);
    }

    //FUNCION CREAR
    public function crear(Request $request){
        $data = $request->validate($this->validateRequest());
        $usuario = Usuario::where('email', '=', $data["email"])->first();

        if($request->hasfile('image')):
            $imagen         = $request->file('image');
            $nombreimagen   = Str::slug($request->nombre).".".$imagen->guessExtension();
            //$nombreimagen = $imagen->getClientOriginalName();
            $ruta           = public_path("storage/app/public");
            $imagen->move($ruta,$nombreimagen);
            //$model->foto  = $nombreimagen; // asignar el nombre para guardar
        endif;

        if ($usuario == null){
            $usuario = Usuario::create($data);
            return response([
                'message'=>'Se creo con exito el usuario',
                'id'=> $usuario['id'],
            ], 201);
        }else{
            return response(['message' => 'El email ' . $usuario["email"] . ' ya esta tomado']);
        }
    }

    private function validateRequest(){
        return [
            'nombre'=>'required|string',
            'apellido'=>'required|string',
            'rol'=>'required|string',
            'email'=>'required|email|string',
            'password'=>'required|min:6',
            'image'=>'required|string'
        ];
    }
}

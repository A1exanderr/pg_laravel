<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Admin_usuario extends Controller
{
    /**
     * PERFIL
    */
    public function guardar_perfil(Request $request){
        $validar = Validator::make($request->all(),[
            'nombres'           => 'required',
            'apellido_paterno'  => 'required',
            'apellido_materno'  => 'required',
            'celular'           => 'required',
            'email'             => 'required|email',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario                    = User::find($request->id);
            $usuario->nombres           = $request->nombres;
            $usuario->apellido_paterno  = $request->apellido_paterno;
            $usuario->apellido_materno  = $request->apellido_materno;
            $usuario->celular           = $request->celular;
            $usuario->email             = $request->email;
            $usuario->save();
            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al guardar');
            }
        }
        return response()->json($data);
    }

    //guardar el perfil
    public function password_g(Request $request){
        $validar = Validator::make($request->all(),[
            'password'          => 'required|min:8|max:12',
            'repetir_password'  => 'required|min:8|same:password',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario            = User::find($request->id_p);
            $usuario->password  = $request->password;
            $usuario->save();
            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se cambio el password con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al guardar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE PERFIL
     */

    /**
      * ADMINISTRACION DE USUARIOS
    */
    public function usuario(){
        $data['listar_usuarios'] = User::get();
        return view('admin_usuario.usuario', $data);
    }

    public function usuario_g(Request $request){
        $validar = Validator::make($request->all(),[
            'ci'                => 'required|unique:users,ci',
            'nombres'           => 'required',
            'apellido_paterno'  => 'required',
            'usuario'           => 'required',
            'password'          => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            try {
                $usuario                    = new User;
                $usuario->ci                = $request->ci;
                $usuario->nombres           = $request->nombres;
                $usuario->apellido_paterno  = $request->apellido_paterno;
                $usuario->apellido_materno  = $request->apellido_materno;
                $usuario->usuario           = $request->usuario;
                $usuario->estado            = 'activo';
                $usuario->password          = Hash::make($request->password);
                $usuario->save();
                if($usuario->id){
                    $data = mensaje_mostrar('success', 'Se creo el usuario con éxito');
                }else{
                    $data = mensaje_mostrar('error', 'Ocurrio un problema al guardar');
                }
            } catch (\Throwable $th) {
                $data = mensaje_mostrar('error', 'Error de registro de la BD o existe el usuario');
            }
        }
        return response()->json($data);
    }
    //para validar CI
    public function validar_ci(Request $request){
        $usuario_validar = User::where('ci', $request->ci)->get();
        if(!$usuario_validar->isEmpty()){
            $data = mensaje_mostrar('error', 'Ya existe el usuario con el mismo CI');
        }else{
            $data = mensaje_mostrar('success', 'Puede seguir');
        }
        return response()->json($data);
    }
    //eliminar usuario
    public function eliminar_us(Request $request){
        $usuario = User::find($request->id);
        if($usuario->delete()){
            $data = mensaje_mostrar('success', 'Se elimino con éxito');
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    //editar usuario
    public function editar_us(Request $request){
        $usuario = User::find($request->id);
        if($usuario !== null){
            $data = mensaje_mostrar('good', $usuario);
        } else {
            $data = mensaje_mostrar('error', 'Error al intentar editar');
        }
        return response()->json($data);
    }
    //para guardar el usuario
    public function editar_guardar_us(Request $request){
        $validar = Validator::make($request->all(),[
            'ci_'               => 'required|unique:users,ci,'.$request->id,
            'nombres_'          => 'required',
            'apellido_paterno_' => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            try {
                $usuario                    = User::find($request->id);
                $usuario->ci                = $request->ci_;
                $usuario->nombres           = $request->nombres_;
                $usuario->apellido_paterno  = $request->apellido_paterno_;
                $usuario->apellido_materno  = $request->apellido_materno_;
                $usuario->save();
                if($usuario->id){
                    $data = mensaje_mostrar('success', 'Se edito el usuario con éxito');
                }else{
                    $data = mensaje_mostrar('error', 'Ocurrio un problema al editar');
                }
            } catch (\Throwable $th) {
                $data = mensaje_mostrar('error', 'Error de registro de la BD o existe el usuario');
            }
        }
        return response()->json($data);
    }
    //para reset de uusario y contraseña
    public function reset_us(Request $request){
        $usuario = User::find($request->id);
        if($usuario !== null){
            $data = mensaje_mostrar('good', $usuario);
        } else {
            $data = mensaje_mostrar('error', 'Error al intentar reset de usuario y contraseña');
        }
        return response()->json($data);
    }
    //para guardar reset de uusario y contraseña
    public function guardar_reset_us(Request $request){
        $validar = Validator::make($request->all(),[
            'usuario__'           => 'required',
            'password__'          => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            try {
                $usuario                    = User::find($request->id__);
                $usuario->usuario           = $request->usuario__;
                $usuario->password          = Hash::make($request->password__);
                $usuario->save();
                if($usuario->id){
                    $data = mensaje_mostrar('success', 'El reset de usuario y contraseña se realizo con exito');
                }else{
                    $data = mensaje_mostrar('error', 'Ocurrio un problema al realizar el reset');
                }
            } catch (\Throwable $th) {
                $data = mensaje_mostrar('error', 'Error de registro de la BD o existe el usuario');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE ADMINISTRACION DE USUARIOS
     */
}

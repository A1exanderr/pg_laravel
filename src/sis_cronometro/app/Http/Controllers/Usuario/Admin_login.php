<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Admin_login extends Controller
{
    /**
     * Inicio
     */
    public function inicio(){
        return view('inicio');
    }

    /**
     * PARA LA PARTE DE LOGIN
     */
    public function ingresar(Request $request){
        $mensaje = "Usuario y contraseña invalidos";
        $validar = Validator::make($request->all(),[
            'usuario' => 'required',
            'password' => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('error', 'Todos los campos son requeridos');
        }else{
            //comprobamos si el usuario existe o si esta activo
            $usuario = User::where('usuario', $request->usuario)->get();
            if(!$usuario->isEmpty()){
                $compara = Auth::attempt([
                    'usuario'    => $request->usuario,
                    'password'   => $request->password,
                    'estado'     => 'activo',
                    'deleted_at' => NULL
                ]);
                if($compara){
                    $data = mensaje_mostrar('success', 'Inicio de session con éxito');
                    $request->session()->regenerate();
                }else{
                    $data = mensaje_mostrar('error', $mensaje);
                }
            }else{
                $data = mensaje_mostrar('error', $mensaje);
            }
        }
        return response()->json($data);
    }

    /**
     * FIN DE LA PARTE DE LOGIN
     */

    /**cerrar session */
    public function cerrar_session(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $data = mensaje_mostrar('success', 'Finalizo la session con éxito!');
        return response()->json($data);
    }
     /**fin de cerrar session */
}


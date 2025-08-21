<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Persona_model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
class Personas_controlador extends Controller
{
    //para guardar la persona
    public function guardar_persona(Request $request){
        $validar = Validator::make($request->all(),[
            'numero_competidor'          => 'required|unique:personas,placa',
            'comunidad'                  => 'required',
            'nombres_piloto'             => 'required',
            'apellido_paterno_piloto'    => 'required',
            'apellido_materno_piloto'    => 'required',
            'nombres_copiloto'           => 'required',
            'apellido_paterno_copiloto'  => 'required',
            'apellido_materno_copiloto'  => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $persona                        = new Persona_model;
            $persona->placa                 = $request->numero_competidor;
            $persona->comunidad             = $request->comunidad;
            $persona->nombres_piloto        = $request->nombres_piloto;
            $persona->ap_paterno_piloto     = $request->apellido_paterno_piloto;
            $persona->ap_materno_piloto     = $request->apellido_materno_piloto;
            $persona->nombres_copiloto      = $request->nombres_copiloto;
            $persona->ap_paterno_copiloto   = $request->apellido_paterno_copiloto;
            $persona->ap_materno_copiloto   = $request->apellido_materno_copiloto;
            $persona->save();
            if($persona->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al guardar');
            }
        }
        return response()->json($data);
    }

    //listar personas
    public function listar_persona(){
        $listar_persona = Persona_model::orderBy('id','asc')->get();
        if(!$listar_persona == null){
            $data = mensaje_mostrar('success', $listar_persona);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error');
        }
        return response()->json($data);
    }
    //eliminar persona
    public function eliminar_persona(Request $request){
        $persona = Persona_model::find($request->id);
        if($persona->delete()){
            $data = mensaje_mostrar('success', 'Se elimino con éxito');
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    //para editar la persona
    public function editar_persona(Request $request){
        $persona = Persona_model::find($request->id);
        if($persona !== NULL){
            $data = mensaje_mostrar('success', $persona);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para guardar lo editado
    public function guardar_e_persona(Request $request){
        $validar = Validator::make($request->all(),[
            'numero_competidor_'          => 'required|unique:personas,placa,'.$request->id,
            'comunidad_'                  => 'required',
            'nombres_piloto_'             => 'required',
            'apellido_paterno_piloto_'    => 'required',
            'apellido_materno_piloto_'    => 'required',
            'nombres_copiloto_'           => 'required',
            'apellido_paterno_copiloto_'  => 'required',
            'apellido_materno_copiloto_'  => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $persona                        = Persona_model::find($request->id);
            $persona->placa                 = $request->numero_competidor_;
            $persona->comunidad             = $request->comunidad_;
            $persona->nombres_piloto        = $request->nombres_piloto_;
            $persona->ap_paterno_piloto     = $request->apellido_paterno_piloto_;
            $persona->ap_materno_piloto     = $request->apellido_materno_piloto_;
            $persona->nombres_copiloto      = $request->nombres_copiloto_;
            $persona->ap_paterno_copiloto   = $request->apellido_paterno_copiloto_;
            $persona->ap_materno_copiloto   = $request->apellido_materno_copiloto_;
            $persona->save();
            if($persona->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al editar');
            }
        }
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Tipo_carrera_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Tipo_controlador extends Controller
{
    //para guardar la tipo
    public function guardar_tipo(Request $request){
        $validar = Validator::make($request->all(),[
            'descripcion'       => 'required',
            'fecha_realizacion' => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo                    = new Tipo_carrera_model;
            $tipo->descripcion       = $request->descripcion;
            $tipo->fecha_realizacion = $request->fecha_realizacion;
            $tipo->save();
            if($tipo->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al guardar');
            }
        }
        return response()->json($data);
    }
    //para listar
    public function listar_tipo(){
        $tipo = Tipo_carrera_model::orderBy('id','asc')->get();
        if(!$tipo == null){
            $data = mensaje_mostrar('success', $tipo);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error');
        }
        return response()->json($data);
    }
    //para editar
    public function editar_tipo(Request $request){
        $tipo = Tipo_carrera_model::find($request->id);
        if($tipo !== NULL){
            $data = mensaje_mostrar('success', $tipo);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para guardar lo editado
    public function guardar_e_tipo(Request $request){
        $validar = Validator::make($request->all(),[
            'descripcion_'       => 'required',
            'fecha_realizacion_' => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo                    = Tipo_carrera_model::find($request->id);
            $tipo->descripcion       = $request->descripcion_;
            $tipo->fecha_realizacion = $request->fecha_realizacion_;
            $tipo->save();
            if($tipo->id){
                $data = mensaje_mostrar('success', 'Se edito los datos con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al editar');
            }
        }
        return response()->json($data);
    }

    //para eliminar el tipo
    public function eliminar_tipo(Request $request){
        $tipo = Tipo_carrera_model::find($request->id);
        if($tipo->delete()){
            $data = mensaje_mostrar('success', 'Se elimino con éxito');
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
}


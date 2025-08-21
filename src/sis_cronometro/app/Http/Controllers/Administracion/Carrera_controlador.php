<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Persona_model;
use App\Models\Registro_carrera;
use App\Models\Tipo_carrera_model;
use Illuminate\Http\Request;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Dompdf\Options;
use Intervention\Image\ImageManagerStatic as Image;

use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;

class Carrera_controlador extends Controller
{
    public function listar(){
        $data['fecha_actual'] = date('Y-m-d');
        $data['listar_tipo'] = Tipo_carrera_model::get();
        return view('administracion.Tipo_carrera.listar_tipo', $data);
    }

    //para listar la carrea
    public function carrera($id){
        $id_descript = decryp_rodry($id);
        $data['id_d'] = $id_descript;
        return view('administracion.Carrera.registro_carrera', $data);
    }

    //validar numero
    public function validar_ci(Request $request){
        $existe = Persona_model::where('placa', $request->numero)->first();
        if($existe){
            $registro_carrera=Registro_carrera::where('id_persona',$existe->id)
                                        ->where('id_carrera', $request->id_carrera)
                                        ->first();
            if($registro_carrera){
                $data = mensaje_mostrar('error', 'El equipo ya esta en carrera');
            }else{
                $data = mensaje_mostrar('success', $existe);
            }
        }else{
            $data = mensaje_mostrar('error', 'No existe el numero registrado');
        }
        return response()->json($data, 200);
    }

    //para guardar el registro
    public function guardar_registro(Request $request){
        $registro_carrera = new Registro_carrera;
        $registro_carrera->fecha = date('Y-m-d');
        $registro_carrera->inicio_primero = date('H:i:s');
        $registro_carrera->id_persona = $request->id_persona;
        $registro_carrera->id_carrera = $request->id_carrera;
        $registro_carrera->save();
        if($registro_carrera->id){
            $data = mensaje_mostrar('success', 'Se inicio la carrera con éxito');
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio al iniciar');
        }
        return response()->json($data);
    }

    //para listar los registros y personas
    public function listar_registro_carrera(Request $request){
        $imprimir_registro = Registro_carrera::with('persona')->where('id_carrera',$request->id_carrera)->get();
        if($imprimir_registro){
            $data = mensaje_mostrar('success', $imprimir_registro);
        }else{
            $data = mensaje_mostrar('error', 'Invalido registro');
        }
        return response()->json($data);
    }

    ///par afinalizar la primera carrera
    public function finalizar_primera_carrera(Request $request){
        $registro_carrera = Registro_carrera::find($request->id);
        $registro_carrera->fin_primero = date('H:i:s');

        $registro_carrera->suma_primero = diferencia_horas($registro_carrera->inicio_primero,date('H:i:s'));

        $registro_carrera->save();
        if($registro_carrera->id){
            $data =  mensaje_mostrar('success', 'Se finalizo con exito');
        }else{
            $data =  mensaje_mostrar('error', 'Ocurrio un error al fianlizar');
        }
        return response()->json($data);
    }

    //iniciar la segunda carrera
    public function iniciar_segunda_carrera(Request $request){
        $registro_carrera = Registro_carrera::find($request->id);
        $registro_carrera->inicio_segundo = date('H:i:s');
        $registro_carrera->save();
        if($registro_carrera->id){
            $data =  mensaje_mostrar('success', 'Se inicio la segunda con exito');
        }else{
            $data =  mensaje_mostrar('error', 'Ocurrio un error al iniciar');
        }
        return response()->json($data);
    }
    //finalizar la segunda carrera
    public function finalizar_segunda_carrera(Request $request){
        $registro_carrera               = Registro_carrera::find($request->id);
        $registro_carrera->fin_segundo  = date('H:i:s');
        $suma_total_segundo             = diferencia_horas($registro_carrera->inicio_segundo,date('H:i:s'));
        $registro_carrera->suma_segundo = $suma_total_segundo;
        $registro_carrera->total        = sumar_horas_diferentes($registro_carrera->suma_primero,$suma_total_segundo);
        $registro_carrera->save();
        if($registro_carrera->id){
            $data =  mensaje_mostrar('success', 'Se finalizo la segunda con exito');
        }else{
            $data =  mensaje_mostrar('error', 'Ocurrio un error al finalizar');
        }
        return response()->json($data);
    }


    /**
     * para el PDF
     */
    public function reporte_pdf($id){
        $id_descript = decryp_rodry($id);/*
        $data['tipo_carrera'] = Tipo_carrera_model::find($id_descript);
        $data['listar_carrera'] = Registro_carrera::with('persona')->where('id_carrera', $id_descript)->orderBy('total', 'asc')->get();
        return view('administracion.Reportes.reporte_pdf', $data); */

        $options = new Options;
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $tipo_carrera = Tipo_carrera_model::find($id_descript);
        if($tipo_carrera){
            $data['tipo_carrera'] = $tipo_carrera;
        }else{
            $data['tipo_carrera'] = 'No hay registro';
        }

        $data['listar_carrera'] = Registro_carrera::with('persona')->where('id_carrera', $id_descript)->orderBy('total', 'asc')->get();

        $html = View::make('administracion.Reportes.reporte_pdf')->with($data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();


        $pdfContent = $dompdf->output();

        $nombreArchivo = 'reporte.pdf';
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf')
                                        ->header('Content-Disposition', 'inline; filename="' . $nombreArchivo . '"');
    }
}

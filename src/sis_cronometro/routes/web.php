<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Administracion\Carrera_controlador;
use App\Http\Controllers\Administracion\Personas_controlador;
use App\Http\Controllers\Administracion\Tipo_controlador;
use App\Http\Controllers\Usuario\Admin_login;
use App\Http\Controllers\Usuario\Admin_usuario;


Route::prefix('/')->middleware(['no_autenticados'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('ingresar',[Admin_login::class, 'ingresar' ])->name('ingresar');
});

Route::prefix('/admin')->middleware(['autenticados'])->group(function(){
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('inicio', [Admin_login::class, 'inicio'] )->name('inicio');
    Route::post('salir', [Admin_login::class, 'cerrar_session'])->name('salir');
    Route::get('perfil', function(){ return view('perfil'); })->name('perfil');


    /**
     * Administracion de usuarios
     */

    Route::post('guardar_perfil',[Admin_usuario::class, 'guardar_perfil'] )->name('adm_guardar_perfil');
    Route::post('password_g',[Admin_usuario::class, 'password_g'] )->name('adm_password_g');
    Route::get('usuario', [Admin_usuario::class, 'usuario'] )->name('adm_usuario');
    Route::post('usuario_g',  [Admin_usuario::class, 'usuario_g'])->name('adm_usuario_guardar');
    Route::post('validar_ci',  [Admin_usuario::class, 'validar_ci'])->name('adm_validar_ci');
    Route::delete('eliminar_us', [Admin_usuario::class, 'eliminar_us' ] )->name('adm_eliminar_us');
    Route::post('editar_us',  [Admin_usuario::class, 'editar_us'])->name('adm_editar_us');
    Route::put('editar_guardar_us',  [Admin_usuario::class, 'editar_guardar_us'])->name('adm_editar_guardar_us');
    Route::post('reset_us', [Admin_usuario::class, 'reset_us'] )->name('adm_reset_us');
    Route::put('guardar_reset_us', [Admin_usuario::class, 'guardar_reset_us'] )->name('adm_guardar_reset_us');

    /**
     * Fin de Administracion de usuarios
     */

    /**
     * Para la parte de registro de personas
    */

    Route::get('personas', function(){ return view('administracion.Personas.personas'); })->name('pc_index');
    Route::post('guardar_persona', [Personas_controlador::class,'guardar_persona' ] )->name('pc_guardar');
    Route::post('listar_persona', [Personas_controlador::class, 'listar_persona'])->name('pc_listar');
    Route::delete('eliminar_persona', [Personas_controlador::class, 'eliminar_persona'])->name('pc_eliminar');
    Route::post('editar_persona', [Personas_controlador::class, 'editar_persona'])->name('pc_editar');
    Route::put('guardar_e_persona', [Personas_controlador::class,'guardar_e_persona' ])->name('pc_guardar_e');
    /**
     * Fin de la parte de registro de personas
    */

    /**
     * para el tipo de carrera
     */

    Route::get('carreratipo', function(){ return view('administracion.Tipo_carrera.tipo_carrera'); })->name('tc_index');
    Route::post('guardar_tipo', [Tipo_controlador::class, 'guardar_tipo'] )->name('tc_guardar');
    Route::post('listar_tipo', [Tipo_controlador::class, 'listar_tipo'])->name('tc_listar');
    Route::delete('eliminar_tipo', [Tipo_controlador::class, 'eliminar_tipo'])->name('tc_eliminar');
    Route::post('editar_tipo', [Tipo_controlador::class, 'editar_tipo'] )->name('tc_editar');
    Route::put('guardar_e_tipo', [Tipo_controlador::class, 'guardar_e_tipo'])->name('tc_guardar_e');
    /**
     * fin del tipo de carrera
     */

    /**
     * Carrera
    */

    Route::get('lista',  [Carrera_controlador::class, 'listar'] )->name('cc_index');
    Route::get('carrera/{id}', [Carrera_controlador::class, 'carrera'])->name('cc_carrera');
    Route::post('validar_ci', [Carrera_controlador::class, 'validar_ci'])->name('cc_validar_ci');
    Route::post('guardar_registro', [Carrera_controlador::class, 'guardar_registro'])->name('cc_guardar_registro');
    Route::post('listar_registro_carrera', [Carrera_controlador::class, 'listar_registro_carrera'])->name('cc_listar_registro_carrera');
    //par ala pimeir carrera
    Route::post('finalizar_primera_carrera',[Carrera_controlador::class, 'finalizar_primera_carrera'])->name('cc_finalizar_primera_carrera');
    Route::post('iniciar_segunda_carrera',[Carrera_controlador::class, 'iniciar_segunda_carrera'])->name('cc_iniciar_segunda_carrera');
    Route::post('finalizar_segunda_carrera',[Carrera_controlador::class, 'finalizar_segunda_carrera'])->name('cc_finalizar_segunda_carrera');


    //PARA EL PDF
    Route::get('reporte_pdf/{id}',[Carrera_controlador::class, 'reporte_pdf'])->name('cc_reporte_pdf');
    /**
     * Fin Carrera tipo
    */
});

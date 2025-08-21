<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona_model;
use App\Models\Tipo_carrera_model;

class Registro_carrera extends Model
{
    use HasFactory;
    protected $table = 'registros_carrera';
    protected $fillable = [
        'fecha',
        'inicio_primero',
        'fin_primero',
        'suma_primero',
        'inicio_segundo',
        'fin_segundo',
        'suma_segundo',
        'total',
        'id_persona',
        'id_carrera',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion reversa
    public function persona(){
        return $this->belongsTo(Persona_model::class, 'id_persona', 'id');
    }
    //relacion reversa
    public function tipo_carrera(){
        return $this->belongsTo(Tipo_carrera_model::class, 'id_carrera', 'id');
    }
}

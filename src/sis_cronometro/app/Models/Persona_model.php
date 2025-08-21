<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registro_carrera;

class Persona_model extends Model
{
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'placa',
        'nombres_piloto',
        'ap_paterno_piloto',
        'ap_materno_piloto',
        'nombres_copiloto',
        'ap_paterno_copiloto',
        'ap_materno_copiloto',
        'comunidad',
    ];
    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';


    //relacion con registro carrera
    public function registro_carrera(){
        return $this->hasMany(Registro_carrera::class, 'id_persona', 'id');
    }
}

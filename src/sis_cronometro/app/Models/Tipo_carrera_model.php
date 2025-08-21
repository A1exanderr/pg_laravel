<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registro_carrera;

class Tipo_carrera_model extends Model
{
    use HasFactory;
    protected $table = 'tipo_carrera';
    protected $fillable = [
        'descripcion',
        'fecha_realizacion',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion con registro carrera
    public function registro_carrera(){
        return $this->hasMany(Registro_carrera::class, 'id_carrera', 'id');
    }
}

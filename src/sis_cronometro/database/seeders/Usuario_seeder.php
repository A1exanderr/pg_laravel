<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Usuario_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario1               = new User;
        $usuario1->usuario      = "admin";
        $usuario1->password     = Hash::make('rodry');
        $usuario1->ci           = "10028685";
        $usuario1->nombres      = "Rodrigo";
        $usuario1->apellido_paterno = "Lecoña";
        $usuario1->apellido_materno = "Quispe";
        $usuario1->celular          = "63259224";
        $usuario1->estado           = "activo";
        $usuario1->email            = "rodrigigolecona03@gmail.com";
        $usuario1->save();
    }
}

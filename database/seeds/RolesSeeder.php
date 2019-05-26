<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super usuario', 'Administrador', 'Egresado'];
        foreach ($roles as $rol) {
            DB::table('roles')->insert([
                'nombre' => $rol,
            ]);
        }
    }
}

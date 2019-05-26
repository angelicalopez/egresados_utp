<?php

use Illuminate\Database\Seeder;
use App\User;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'super usuario';
        $email = 'root@root.com';
        $password = 'root1234';
        $rol_id = 1;
        $estado = 'A';
        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'rol_id' => $rol_id,
            'estado' => $estado,
        ]);
    }
}

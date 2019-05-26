<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Rol;

class UserTest extends TestCase
{
    // verifica que exista el rol super usuario
    public function testSuperUsuarioRol() 
    {
        $this->assertEquals(Rol::where('nombre', 'Super usuario')->first()->id, 1);
    }

    // verifica que el super usuario tenga el rol adecuado
    public function testCheckRoot()
    {
        $user = User::where('email', 'root@root.com')->first();
        $this->assertEquals($user->rol_id, 1);
    }

    // verifica que el usuario root pueda ser autenticado en el sistema
    public function testAuthenticateUser()
    {
        $credenciales = ['email' => 'root@root.com', 'password' => 'root1234'];
        $this->assertCredentials($credenciales, $guard = null);
    }

    // verifica el registro de un usuario nuevo y su correcta autenticacion en el sistema
    public function testNewUser()
    {
        $user = new User;
        $user->name = 'Angelica';
        $user->email = 'angelica@utp.edu.co';
        $user->password = bcrypt('12345678');
        $user->rol_id = 3;
        $user->estado = 'A';
        $user->save();

        $this->assertCredentials(['email' => $user->email, 'password' => '12345678'], $guard = null);

        $user->delete();

    }
}

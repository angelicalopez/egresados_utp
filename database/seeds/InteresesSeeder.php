<?php

use Illuminate\Database\Seeder;

class InteresesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intereses = ['Trabajo', 'Entrevista', 'Viajes', 'Estudiar', 'Amigos', 'Fiesta', 'Concurso', 'Promocion', 'Eventos', 'Conciertos',
            'Musica', 'Informacion'];
        foreach ($intereses as $interes) {
            DB::table('interes')->insert([
                'nombre' => $interes,
            ]);
        }
    }
}

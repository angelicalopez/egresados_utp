<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    protected $table = 'egresados';

    protected $fillable = [
        'apellidos', 'dni', 'genero', 'manejo_datos', 'edad', 'user_id', 'pais_id', 'imagen',
    ];

    protected $hidden = [
        
    ];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function intereses()
    {
        return $this->belongsToMany('App\Interes', 'intereses_egresados', 'egresado_id', 'interes_id');
    }
}

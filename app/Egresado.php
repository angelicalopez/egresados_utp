<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    protected $table = 'egresados';

    protected $fillable = [
        'apellidos', 'dni', 'genero', 'manejo_datos', 'edad', 'user_id', 'pais_id',
    ];

    protected $hidden = [
        
    ];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }

    public function intereses()
    {
        return $this->hasMany('App\Interes');
    }
}

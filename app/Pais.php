<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        
    ];

    public function egresados()
    {
        return $this->hasMany('App\Egresado');
    }

    public function administradores()
    {
        return $this->hasMany('App\Administrador');
    }
}

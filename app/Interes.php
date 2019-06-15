<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interes extends Model
{
    protected $table = 'interes';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        
    ];

    public function egresados()
    {
        return $this->belongsToMany('App\Egresado', 'intereses_egresados', 'interes_id', 'egresado_id');
    }

    public function noticias()
    {
        return $this->belongsToMany('App\Noticia', 'intereses_noticias', 'interes_id', 'noticia_id');
    }
}

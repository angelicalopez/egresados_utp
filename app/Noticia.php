<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';

    protected $fillable = [
        'nombre', 'descripcion', 'multimedia', 'tipo_multimedia', 'administrador_id',
    ];

    protected $hidden = [
        
    ];

    public function administrador()
    {
        return $this->belongsTo('App\Administrador');
    }
}

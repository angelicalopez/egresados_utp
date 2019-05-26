<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';

    protected $fillable = [
        'apellidos', 'dni', 'direccion', 'telefono', 'user_id', 'pais_id',
    ];

    protected $hidden = [
        
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function noticias()
    {
        return $this->hasMany('App\Noticia');
    }
}

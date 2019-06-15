<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';

    protected $fillable = [
        'nombre', 'descripcion', 'administrador_id',
    ];

    protected $hidden = [
        
    ];

    public function administrador()
    {
        return $this->belongsTo('App\Administrador');
    }

    public function imagenes()
    {
        return $this->hasMany('App\ImagenNoticia');
    }
    
    public function videos()
    {
        return $this->hasMany('App\VideoNoticia');
    }
    
    public function archivos()
    {
        return $this->hasMany('App\ArchivoNoticia');
    }

    public function intereses()
    {
        return $this->belongsToMany('App\Interes', 'intereses_noticias', 'noticia_id', 'interes_id');
    }
}

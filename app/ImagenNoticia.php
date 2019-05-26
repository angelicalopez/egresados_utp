<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenNoticia extends Model
{
    protected $table = 'imagenes_noticias';
    protected $fillable = [
        'nombre', 'ruta', 'noticia_id',
    ];
    protected $hidden = [
        
    ];
    public function noticia()
    {
        return $this->belongsTo('App\Noticia');
    }
}

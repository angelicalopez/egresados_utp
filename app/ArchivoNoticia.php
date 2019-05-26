<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoNoticia extends Model
{
    protected $table = 'archivos_noticias';
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

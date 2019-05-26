<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoNoticia extends Model
{
    protected $table = 'videos_noticias';
    protected $fillable = [
        'url', 'noticia_id',
    ];
    protected $hidden = [
        
    ];
    public function noticia()
    {
        return $this->belongsTo('App\Noticia');
    }
}

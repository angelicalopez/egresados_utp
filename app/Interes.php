<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interes extends Model
{
    protected $table = 'intereses';

    protected $fillable = [
        'nombre', 'egresado_id',
    ];

    protected $hidden = [
        
    ];

    public function egresado()
    {
        return $this->belongsTo('App\Egresado');
    }
}

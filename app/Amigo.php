<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    protected $table = 'amigos';

    protected $fillable = [
        'user_id', 'amigo_id',
    ];

    protected $hidden = [
        
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function amigo()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table   = 'servicios';
    public $primaryKey = 'id_srv';
    protected $guarded = [];

    public function gruas()
    {
        return $this->belongsTo('App\Gruas', 'id_grua', 'id_grua');
    }

    public function mantenimiento()
    {
        return $this->belongsTo('App\Mantenimiento', 'id_man', 'id_man');
    }
}

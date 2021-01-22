<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manuales extends Model
{
    protected $table   = 'manuales';
    public $primaryKey = 'id_man';
    protected $guarded = [];

    public function gruas()
    {
        return $this->belongsTo('App\Gruas', 'id_grua', 'id_grua');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $guarded = [];

    public static function rules($id=0, $merge=[]) {
        return array_merge( 
            [
                'documento' => 'required|unique:clientes'.($id ? ",$id" : ''),
                'nombre_completo' => 'required',
                'email' => 'required|email',
                'direccion' => 'required',
                'telefono' => 'required',
            ],
            $merge
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adquisicion extends Model
{
    use SoftDeletes;

    protected $table = 'adquisiciones';

    protected $fillable = [
        'presupuesto',
        'cantidad',
        'valor_unitario',
        'valor_total',
        'fecha_adquisicion',
        'documentacion',
        'unidad_id',
        'tipo_id',
        'proveedor_id'
    ];

    #protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;
    protected $table = 'tipos';
    protected $fillable = ['nombre', 'categoria'];
    protected $hidden = ['deleted_at'];
    protected $casts = [
        'categoria' => 'string', 
    ];
    
}

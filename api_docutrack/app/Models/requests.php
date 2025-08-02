<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    protected $table = 'requests';
    
    protected $fillable = [
        'userid',
        'nombre', 
        'apellido',
        'cedula',
        'status',
        'emitido',
        'file_route'
    ];
}

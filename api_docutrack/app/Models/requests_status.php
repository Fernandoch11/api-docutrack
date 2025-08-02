<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests_status extends Model
{
    protected $table = 'requests_status';
    
    protected $fillable = [
        'status', 
        'progress'
    ];
}

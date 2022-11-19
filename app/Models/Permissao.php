<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;
    protected $table = 'permissao_sistema';

    protected $fillable=[
        'co_usuario',
        'co_sistema',
        'co_tipo_usuario',
        'in_atico',

    ];

    }


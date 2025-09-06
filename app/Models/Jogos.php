<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogos extends Model
{
    protected $fillable = [
        'nome',
        'genero',
        'ano_lancamento',
        'censura'
    ];
}

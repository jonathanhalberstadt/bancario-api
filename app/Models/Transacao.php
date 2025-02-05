<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = [
        'numero_conta',
        'forma_pagamento',
        'valor',
        'taxa_percentual',
        'valor_taxa',
    ];

    public $timestamps = true;
}

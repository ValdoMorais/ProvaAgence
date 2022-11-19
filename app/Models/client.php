<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $tabele = 'cao_cliente';

    protected $fillable = [
        'co_cliente',
        'no_fantasia',
        'nu_cnpj',
        'ds_email',
        'nu_telefone'
    ];

    public function listClientes() {
        $result = cliente::orderBy('no_fantasia')->get(['CO_CLIENTE', 'NO_FANTASIA'])->where('TP_CLIENTE', '=', 'A');

        // $result = DB::select('SELECT CO_CLIENTE, NO_FANTASIA
        //           FROM CAO_CLIENTE
        //           WHERE TP_CLIENTE = "A"
        //           ORDER BY NO_FANTASIA');
        return $result;
    }
}

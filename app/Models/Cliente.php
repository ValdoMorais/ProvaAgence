<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model {
    
    use HasFactory;
    protected $fillable = [
  				'co_cliente',
  				'no_fantasia',
  				'nu_cnpj',
  				'ds_email',
  				'nu_telefone'
  	];
  	protected $table = 'cao_cliente';

    public function listarClientes() {
        $result = DB::select('SELECT CO_CLIENTE, NO_FANTASIA
                  FROM CAO_CLIENTE
                  WHERE TP_CLIENTE = "A"
                  ORDER BY NO_FANTASIA');
        return $result;
    }

    public function consultaDados($codigo_cliente, $data1, $data2) {
        $result = DB::select('SELECT CLI.NO_FANTASIA, DATE_FORMAT(CAF.DATA_EMISSAO, "%m/%Y") AS DATA_EMISSAO,
                  (CAF.VALOR - ((CAF.VALOR * CAF.TOTAL_IMP_INC)/100)) AS RECEITA_LIQUIDA,
                  CAF.TOTAL_IMP_INC
                  FROM CAO_FATURA AS CAF
                  LEFT JOIN CAO_OS AS CAO ON CAF.CO_OS = CAO.CO_OS
                  LEFT JOIN CAO_CLIENTE AS CLI ON CAF.CO_CLIENTE = CLI.CO_CLIENTE
                  WHERE CLI.CO_CLIENTE IN ('.$codigo_cliente.')
                  AND CAF.DATA_EMISSAO BETWEEN STR_TO_DATE("01/'.$data1.'", "%d/%m/%Y") AND STR_TO_DATE("31/'.$data2.'", "%d/%m/%Y")
                  GROUP BY CLI.NO_FANTASIA, CAF.DATA_EMISSAO, CAF.VALOR, CAF.TOTAL_IMP_INC
                  ORDER BY CLI.NO_FANTASIA, CAF.DATA_EMISSAO');

        return $result;
    }

}

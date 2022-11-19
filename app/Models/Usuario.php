<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'co_usuario',
        'no_usuario',
        'no_email',
        'nu_telefone',
        'dt_expedicao'
];
protected $table = 'cao_usuario';



public function listarUsuarios() {
// $result = DB::select('SELECT CAU.CO_USUARIO, CAU.NO_USUARIO
//         FROM CAO_USUARIO AS CAU
//         LEFT JOIN PERMISSAO_SISTEMA AS PES ON CAU.CO_USUARIO = PES.CO_USUARIO
//         WHERE PES.CO_SISTEMA = 1 AND PES.IN_ATIVO = "S" AND CO_TIPO_USUARIO IN (0, 1, 2)
//         ORDER BY CAU.NO_USUARIO');

        $result = DB::table('CAO_USUARIO')->orderBy('CAO_USUARIO.CO_USUARIO')->leftjoin('PERMISSAO_SISTEMA','CAO_USUARIO.CO_USUARIO', '=', 'PERMISSAO_SISTEMA.CO_USUARIO')
                // ->select('cao_usuario.co_usuario', 'cao_usuario.no_usuario')    
                ->where('PERMISSAO_SISTEMA.CO_SISTEMA','=',1 )
                ->Where('PERMISSAO_SISTEMA.IN_ATIVO', '=', 'S')
                ->WhereBetween('PERMISSAO_SISTEMA.CO_TIPO_USUARIO', [0,2])
                ->get(['CAO_USUARIO.CO_USUARIO', 'CAO_USUARIO.NO_USUARIO']);  
        return $result;
        }

public function consultaDados($codigo_usuario, $data1, $data2) {
$result = DB::select('SELECT CAU.NO_USUARIO, DATE_FORMAT(CAF.DATA_EMISSAO, "%m/%Y") AS DATA_EMISSAO,
        (CAF.VALOR - ((CAF.VALOR * CAF.TOTAL_IMP_INC)/100)) AS RECEITA_LIQUIDA,
        CAF.COMISSAO_CN, CAS.BRUT_SALARIO
        FROM CAO_FATURA AS CAF
        LEFT JOIN CAO_OS AS CAO ON CAF.CO_OS = CAO.CO_OS
        LEFT JOIN CAO_SALARIO AS CAS ON CAS.CO_USUARIO = CAO.CO_USUARIO
        LEFT JOIN CAO_USUARIO AS CAU ON CAO.CO_USUARIO = CAU.CO_USUARIO
        WHERE CAO.CO_USUARIO IN ('.$codigo_usuario.')
        AND CAF.DATA_EMISSAO BETWEEN STR_TO_DATE("01/'.$data1.'", "%d/%m/%Y") AND STR_TO_DATE("31/'.$data2.'", "%d/%m/%Y")
        GROUP BY CAU.NO_USUARIO, CAF.DATA_EMISSAO, CAF.VALOR, CAF.TOTAL_IMP_INC, CAF.COMISSAO_CN, CAS.BRUT_SALARIO
        ORDER BY CAU.NO_USUARIO, CAF.DATA_EMISSAO');

return $result;
}

}

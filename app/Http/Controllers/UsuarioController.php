<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    //

    public function relatorio(Request $request) {

        //$request = new Request();
        
        $consultor_data1 = $request->input('consultor_data1');
        $consultor_data2 = $request->input('consultor_data2');
        $consultor = $request->input('consultor');

        $codigo_usuario = "";
        $codigo_usuario_anterior = "";
        $data_anterior = 0;
        $cont = 1;
        $receita_liquida_anterior = 0;
        $custo_fixo_anterior = 0;
        $comissao_anterior = 0;
        $lucro_anterior = 0;
        $receita_liquida_total = 0;
        $total_receita = 0;
        $total_custo = 0;
        $total_comissao = 0;
        $total_lucro = 0;
        $relatorio = [];

        

        if (!empty($consultor)) {
            foreach($consultor as $row) {
              $codigo_usuario .= '"' . $row . '", ';
            }
            $codigo_usuario = substr($codigo_usuario, 0, -2);

            $usuario = new Usuario();
                $result = $usuario->consultaDados($codigo_usuario, $consultor_data1, $consultor_data2);

                if (!empty($result)) {
                        foreach ($result as $key => $value) {
                        if ($codigo_usuario_anterior == "")
                                $codigo_usuario_anterior = $value->NO_USUARIO;
        
                        $custo_fixo = $value->BRUT_SALARIO;
                        $comissao = ($value->RECEITA_LIQUIDA*$value->COMISSAO_CN)/100;
                        $lucro = $value->RECEITA_LIQUIDA - ($custo_fixo + $comissao);
        
                        if($value->NO_USUARIO == $codigo_usuario_anterior and $value->DATA_EMISSAO == $data_anterior) {
                                $receita_liquida_total = $value->RECEITA_LIQUIDA + $receita_liquida_anterior;
                        } else {
                                $receita_liquida_total = $value->RECEITA_LIQUIDA;
                        }
        
                        if(!empty($receita_liquida_anterior)) {
                                if($data_anterior != 0 and ($value->DATA_EMISSAO != $data_anterior or $cont == count($result))) {
                                $relatorio[$codigo_usuario_anterior][] = array(
                                                "Período" => $data_anterior,
                                                "Receita Líquida" => "R$ ".number_format($receita_liquida_anterior, 2),
                                                "Custo Fixo" => "R$ ".number_format($custo_fixo_anterior, 2),
                                                "Comissão" => "R$ ".number_format($comissao_anterior, 2),
                                                "Lucro" => "R$ ".number_format($lucro_anterior, 2)
                                                );
        
                                $total_receita += $receita_liquida_anterior;
                                $total_custo += $custo_fixo_anterior;
                                $total_comissao += $comissao_anterior;
                                $total_lucro += $lucro_anterior;
                                }
                        }
        
                        if(!empty($total_receita)) {
                                if ($value->NO_USUARIO != $codigo_usuario_anterior or $cont == count($result)) {
                                $relatorio[$codigo_usuario_anterior]["total"] = array(
                                                "SALDO",
                                                "R$ ".number_format($total_receita, 2),
                                                "R$ ".number_format($total_custo, 2),
                                                "R$ ".number_format($total_comissao, 2),
                                                "R$ ".number_format($total_lucro, 2)
                                                );
        
                                $custo_fixo = 0;
                                $comissao = 0;
                                $lucro = 0;
        
                                $total_receita = 0;
                                $total_custo = 0;
                                $total_comissao = 0;
                                $total_lucro = 0;
                                $receita_liquida_anterior = 0;
                                }
                        }
        
                        $codigo_usuario_anterior = $value->NO_USUARIO;
                        $data_anterior = $value->DATA_EMISSAO;
                        $receita_liquida_anterior = $receita_liquida_total;
                        $custo_fixo_anterior = $custo_fixo;
                        $comissao_anterior = $comissao;
                        $lucro_anterior = $lucro;
                        $cont++;
                        }
                }
        }
       

        //return response()->file(resource_path('assets/js/relatorio'));
        return view("usuario/relatorio", ["relatorio_consultor" => $relatorio]);
    }

    public function grafico(Request $request) {
        $consultor_data1 = $request->input('consultor_data1');
        $consultor_data2 = $request->input('consultor_data2');
        $consultor = $request->input('consultor');

        $codigo_usuario = "";
        $data_anterior = 0;
        $codigo_usuario_anterior = "";
        $cont = 1;
        $c = 0;
        $nomes = [];
        $receita_liquida_anterior = 0;
        $receita_liquida_total = 0;
        $total_receita_usuario = 0;
        $total_receita = 0;
        $custo_fixo_anterior = 0;
        $total_custo = 0;
        $desemp = [];
        $custo = 0;
        $desemp_porcentual = [];

        if (!empty($consultor)) {
            foreach($consultor as $row) {
              $codigo_usuario .= '"' . $row . '", ';
            }
            $codigo_usuario = substr($codigo_usuario, 0, -2);

  		      $usuario = new Usuario();
            $result = $usuario->consultaDados($codigo_usuario, $consultor_data1, $consultor_data2);

            if (!empty($result)) {
              foreach ($result as $key => $value) {
                  if ($codigo_usuario_anterior == "")
                      $codigo_usuario_anterior = $value->NO_USUARIO;

                  $custo_fixo = $value->BRUT_SALARIO;

                  if($value->NO_USUARIO == $codigo_usuario_anterior and $value->DATA_EMISSAO == $data_anterior) {
                      $receita_liquida_total = $value->RECEITA_LIQUIDA + $receita_liquida_anterior;
                  } else {
                      $receita_liquida_total = $value->RECEITA_LIQUIDA;
                  }

                  if($data_anterior != 0 and ($value->DATA_EMISSAO != $data_anterior or $cont == count($result))) {
                      $total_receita_usuario += $receita_liquida_anterior;
                      $total_custo += $custo_fixo_anterior;
                  }

                  if ($value->NO_USUARIO != $codigo_usuario_anterior or $cont == count($result)) {
                      $desemp[substr($codigo_usuario_anterior, 0, 22)] = (int) $total_receita_usuario;

                      $total_receita += $total_receita_usuario;

                      $total_receita_usuario = 0;
                      $receita_liquida_anterior = 0;

                      if(!empty($custo_fixo_anterior))
                        $c++;
                  }

                  $codigo_usuario_anterior = $value->NO_USUARIO;
                  $data_anterior = $value->DATA_EMISSAO;
                  $receita_liquida_anterior = $receita_liquida_total;
                  $custo_fixo_anterior = $custo_fixo;
                  $cont++;
                }

                if(!empty($total_custo))
                  $custo = (int) ($total_custo)/$c;
                $custo = round($custo, 2);

                foreach($desemp as $key => $value) {
                    if(!empty($value)) {
                        $porcentual = $this->porcentagem_receita($value, $total_receita);
                        $desemp_porcentual[$key] = (int) $porcentual;
                    }
                }
            }
        }

        return ["desemp" => $desemp, "custo" => $custo, "desemp_porcentual" => $desemp_porcentual];
    }

    public function grafico_barra(Request $request) {
        $grafico = $this->grafico($request);

        return view("usuario/grafico_barra", ["desemp" => $grafico["desemp"], "custo" => $grafico["custo"]]);
    }

    public function grafico_pizza(Request $request) {
        $grafico = $this->grafico($request);

        return view("usuario/grafico_pizza", ["desemp_porcentual" => $grafico["desemp_porcentual"]]);
    }

    public function porcentagem_receita($parcial, $total) {
        return ($parcial/$total)*100;
    }

}

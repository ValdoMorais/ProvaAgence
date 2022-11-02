<?php

   require "lib/connect.php";
   require "lib/functions.php";

   $dirimg = "img";
   //$cadastro = true;

   function load_usuarios() {
            global $link;
            // Query global contendo o SQL para carregar os usuarios
            $qrySql = "Select no_usuario, in_ativo, a.co_usuario From cao_usuario a, permissao_sistema b ";
            $qrySql .= "where a.co_usuario = b.co_usuario and b.co_sistema = 1";
            
            //$resultSql = mysql_db_query($qrySql, $link);
            $resultSql = mysql_query($qrySql, $link);
            // codigo html para usuario
            //echo "<select name=select>\n";
            //echo "<option value=novo>Novo Usu&aacute;rio</option>\n";
            
            // carregando lista de usuarios
            while ($linha = mysql_fetch_row($resultSql)) {
                  if ($linha[1] == 'S')
                      echo "<option value=$linha[2]>$linha[0]</option>\n";
                  else
                      echo "<option value= $linha[2] class=option_1>$linha[0]</option>\n";
                  //echo "<option>$linha[1]</option>\n";
                  
			}

   }
   
   function load_tipo_usuario() {
            global $link;
            // Query global contendo o SQL para carregar os tipos de usuarios
            $qrySql = "Select ds_tipo_usuario, co_tipo_usuario From tipo_usuario where co_sistema = 1";

            $resultSql = mysql_query($qrySql, $link);

            // codigo html para tipos de usuários
            echo "<select name=tipouser>\n";
            echo "<option value=selecione>Selecione --&gt;</option>\n";
            //
            // carregando lista de tipo de usuarios
            while ($linha = mysql_fetch_row($resultSql)) {

                  echo "<option value=$linha[1]>$linha[0]</option>\n";

			}
			echo "</select>";
   }
   
   function codigo_tipo_usuario($tipousuario) {
            global $link;
            //
            $qrySql = "Select co_tipo_usuario from tipo_usuario ";
            $qrySql .= "where ds_tipo_usuario = '$tipousuario'";
            
            $resultSql = mysql_query($qrySql, $link);
            $linha = mysql_fetch_row($resultSql);
            
            return $linha[0];
            
   }
			
   function inserir_dados() {
            //
            global $dirimg, $link,
                   $login, $nome, $pass, $usrLogin,/*ver co_usuario_autorizacao*/
                   $matricula, $dnascimento, $dadmissao,
                   $dexpiracao, $cpf, $rg, $orgemissor,
                   $orguf, $endereco, $email, $ddd, $telefone,
                   $ativo, $tipouser, $arqimagem;
            //
            $dddtelefone = $ddd+$telefone;
            $dalteracao = date("Y-m-d H:i:s", Time()+3600);//strftime("%d/%m/%Y");
            $dinclusao = date("Y-m-d H:i:s", Time()+3600);//strftime("%d/%m/%Y");
            //
            //
            $dia = substr($dnascimento, 0, 2);
	        $mes = substr($dnascimento, 3, 2);
	        $ano = substr($dnascimento, 6, 4);
            $dnascimento = date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano));
            //
            $dia = substr($dadmissao, 0, 2);
	        $mes = substr($dadmissao, 3, 2);
	        $ano = substr($dadmissao, 6, 4);
            $dadmissao = date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano));
            //
            $dia = substr($dexpiracao, 0, 2);
	        $mes = substr($dexpiracao, 3, 2);
	        $ano = substr($dexpiracao, 6, 4);
            $dexpiracao = date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano));
            //
            if (!file_exists("$dirimg/$login.jpg")) {
               copy("$arqimagem", "$dirimag/$login.jpg");
            }
            //
            $urlimage = "http://www.agence.com.br/caol/$dirimg/$login.gif";
            //
            //$qrySql = "INSERT into cao_usuario (co_usuario,no_usuario,ds_senha,";
            //$qrySql .= "nu_matricula,dt_nascimento,dt_admissao_empresa,";
            //$qrySql .= "dt_expiracao,nu_cpf,nu_rg,no_orgao_emissor,uf_orgao_emissor,";
            //$qrySql .= "ds_endereco,no_email,nu_telefone,dtalteracao,url_foto) ";
            $qrySql = "INSERT into cao_usuario ";
            //$qrySql .= "nu_matricula,dt_nascimento,dt_admissao_empresa,";
            //$qrySql .= "dt_expiracao,nu_cpf,nu_rg,no_orgao_emissor,uf_orgao_emissor,";
            //$qrySql .= "ds_endereco,no_email,nu_telefone,dtalteracao,url_foto) ";
            $qrySql .= "values('$login','$nome','$pass','$usrLogin',";
            $qrySql .= "'$matricula','$dnascimento','$dadmissao','$dinclusao','$dexpiracao',";
            $qrySql .= "'$cpf','$rg','$orgemissor','$orguf','$endereco','$email',";
            $qrySql .= "'$dddtelefone','$dalteracao','$urlimage')";
            //
            mysql_query($qrySql, $link);
            //
            //
            
            //$co_tipo_usuario = codigo_tipo_usuario($tipouser);
            $qrySql = "INSERT into permissao_sistema";
            $qrySql .= " (co_usuario,co_tipo_usuario,co_sistema,";
            $qrySql .= "in_ativo,co_usuario_atualizacao,dt_atualizacao) ";
            $qrySql .= "values(";
            if ($ativo == "sim") {
                $situacao = "S";
            }
            else {
                $situacao = "N";
            }

            $qrySql .= "'$login','$tipouser',1,'$situacao','$usrLogin','$dalteracao')";
            //
            mysql_query($qrySql, $link);
   }
   
   function atualizar_dados() {
            //
            global $dirimg, $link, $usuario,
                   $login, $nome, $pass, $usrLogin,/*ver co_usuario_autorizacao*/
                   $matricula, $dnascimento, $dadmissao,
                   $dexpiracao, $cpf, $rg, $orgemissor,
                   $orguf, $endereco, $email, $telefone,
                   $ativo, $tipouser, $arqimagem;
            //
            $dddtelefone = $telefone;
            $dalteracao = date("Y-m-d H:i:s", Time()+3600);//strftime("%d/%m/%Y");
            $dinclusao = date("Y-m-d H:i:s", Time()+3600);//strftime("%d/%m/%Y");
            //
            //
            $dia = substr($dnascimento, 0, 2);
	        $mes = substr($dnascimento, 3, 2);
	        $ano = substr($dnascimento, 6, 4);
            $dnascimento = date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano));
            //
            $dia = substr($dadmissao, 0, 2);
	        $mes = substr($dadmissao, 3, 2);
	        $ano = substr($dadmissao, 6, 4);
            $dadmissao = date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano));
            //
            $dia = substr($dexpiracao, 0, 2);
	        $mes = substr($dexpiracao, 3, 2);
	        $ano = substr($dexpiracao, 6, 4);
            $dexpiracao = date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano));
            //
            if (!empty($arqimagem)) {
               copy("$arqimagem", "$dirimag/$login.jpg");
            }
            //
            //$urlimage = "http://www.agence.com.br/caol/$dirimg/$login.gif";
            //
            $qrySql = "UPDATE cao_usuario set co_usuario = '$login' , no_usuario = '$nome', ";
            $qrySql .= "ds_senha = '$pass', nu_matricula = '$matricula', dt_nascimento = '$dnascimento', ";
            $qrySql .= "dt_admissao_empresa = '$dadmissao', dt_expiracao = '$dexpiracao', nu_cpf = '$cpf', ";
            $qrySql .= "nu_rg = '$rg', no_orgao_emissor = '$orgemissor', uf_orgao_emissor = '$orguf', ";
            $qrySql .= "ds_endereco = '$endereco', no_email = '$email', nu_telefone = '$telefone', dt_alteracao = '$dalteracao' ";
            $qrySql .= "where co_usuario = '$usuario'";
            //
            //
            //
            mysql_query($qrySql, $link);
            //
            //
            //
            if ($ativo == "sim") {
                $situacao = "S";
            }
            else {
                $situacao = "N";
            }
            //
            //$co_tipo_usuario = codigo_tipo_usuario($tipouser);
            $qrySql = "UPDATE permissao_sistema set co_usuario = '$login', ";
            $qrySql .= "co_tipo_usuario = '$tipouser', in_ativo = '$situacao', ";
            $qrySql .= "co_usuario_atualizacao = '$usrLogin', dt_atualizacao = '$dalteracao' ";
            $qrySql .= "where co_usuario = '$usuario'";
            //
            mysql_query($qrySql, $link);
   }

   function sqldata_to_php($datasql) {

            $strdata = substr($datasql, 8, 2);
            $strdata .= "/";
            $strdata .= substr($datasql, 5, 2);
            $strdata .= "/";
            $strdata .= substr($datasql, 0, 4);
            return $strdata;
            
   }
   
   function load_dados() {
            //
            global $usuario, $link;
            //$qrySql = "Select * From cao_usuario where co_usuario like '$usuario'";
            $qrySql = "Select no_usuario, url_foto, nu_matricula, ";
            $qrySql .= "dt_nascimento, dt_admissao_empresa, dt_expiracao, ";
            $qrySql .= "nu_cpf, nu_rg, no_orgao_emissor, uf_orgao_emissor, ";
            $qrySql .= "ds_endereco, no_email, nu_telefone, ds_senha from cao_usuario ";
            $qrySql .= "where co_usuario LIKE '$usuario'";
            //
            $resultSql = mysql_query($qrySql, $link);
            // dados carregados da entidade cao_usuario
            $linha = mysql_fetch_row($resultSql);
            //
            //
            $qrySql = "Select in_ativo, co_tipo_usuario from permissao_sistema ";
            $qrySql .= "where co_usuario LIKE '$usuario'";
            //
            $resultSql = mysql_query($qrySql, $link);
            // dados carregados da entidade permissao_sistema
            $permissao = mysql_fetch_row($resultSql);
            //
            //

            
   ?>

   <FORM name=cadastro_form action=<?php echo "\"$PHP_SELF\""; ?> method=post ENCTYPE="multipart/form-data" onSubmit="return emailCheck(this.email.value);">
            <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#cccccc>
              <TBODY>
              <TR bgColor=#ffffff>
                <TD width="100%"><FONT color=black>Usuário
                 <select name=usuario OnChange="nav()">
                 <?php
                      $qrySql = "Select no_usuario, in_ativo, a.co_usuario From cao_usuario a, permissao_sistema b ";
                      $qrySql .= "where a.co_usuario = b.co_usuario and b.co_sistema = 1";

                      $resultSql = mysql_query($qrySql, $link);
                      // codigo html para usuario
                      // carregando lista de usuarios
                      while ($usr = mysql_fetch_row($resultSql)) {
                             if ($usr[2] == $usuario) {
                                if ($usr[1] == 'S')
                                   echo "<option value=$usr[2]>$usr[0]</option>\n";
                                else
                                    echo "<option value=$usr[2] class=option_1>$usr[0]</option>\n";
                             }
                      }
                      //
                      $resultSql = mysql_query($qrySql, $link);
                      //
                      echo "<option value=novo>Novo Usu&aacute;rio</option>\n";
                      //
                      while ($usr = mysql_fetch_row($resultSql)) {
                             if ($usr[2] != $usuario) {
                                if ($usr[1] == 'S')
                                   echo "<option value=$usr[2]>$usr[0]</option>\n";
                                else
                                    echo "<option value=$usr[2] class=option_1>$usr[0]</option>\n";
                             }
                      }
                 ?>
                 </select>
                </FONT></TD>
                <TD rowspan="2"><img src=<?php echo "\"$linha[1]\"";?> width="88" height="135"></TD>
              </TR>
              <TR bgColor=#ffffff>
                <TD><TABLE width="98%" border=0 cellPadding=0 cellSpacing=3>
                  <TBODY>
                    <TR>
                      <TD><div align="right">Nome do Usu&aacute;rio&nbsp;</div>
                      </TD>
                      <TD><input name="nome" type="text" size="50" value=<?php echo "\"$linha[0]\"";?> >
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Login&nbsp;</div>
                      </TD>
                      <TD><input type="text" name="login" value=<?php echo "\"$usuario\"";?>>
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Senha&nbsp;</div>
                      </TD>
                      <TD><input type="password" name="pass" value=<?php echo "\"$linha[13]\""; ?>>
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Ativo</div></TD>
                      <TD>
                          <?php
                               if ($permissao[0] == "S") {
                          ?>
                          <input name="ativo" type="radio" class="check" value="sim" checked>
                        sim
                          <input type="radio" class="check" name="ativo" value="nao">
                          n&atilde;o
                          <?php
                               } else {
                          ?>
                          <input name="ativo" type="radio" class="check" value="sim">
                        sim
                          <input type="radio" class="check" name="ativo" value="nao" checked>
                          n&atilde;o
                          <?php
                               }
                          ?>
                          </TD>
                    </TR>
                  </TBODY>
                </TABLE></TD>
              </TR>
              <TR bgColor=#fafafa>
                <TD colspan="2">
                  <TABLE width="98%" border=0 cellPadding=0 cellSpacing=3>
                    <TBODY>
                    <TR>
                      <TD><div align="right">Tipo do Usu&aacute;rio</div>
                      </TD>
                      <TD><font color="black">
                       <?php
                            $qrySql = "Select ds_tipo_usuario, co_tipo_usuario from tipo_usuario ";
                            $qrySql .= "where co_sistema = 1";
                            //
                            $resultSql = mysql_query($qrySql, $link);
                            // dados carregados da entidade tipo_usuario
                            // usado para o loop do tipo de usuario
                            echo "<select name=tipouser>\n";
                            //
                            //
                            while ($tipousuario = mysql_fetch_row($resultSql)) {

                                  if ($tipousuario[1] == $permissao[1]) {
                                      echo "<option value=$tipousuario[1]>$tipousuario[0]</option>\n";
                                  }

                            }
                            //
                            $resultSql = mysql_query($qrySql, $link);
                            while ($tipousuario = mysql_fetch_row($resultSql)) {

                                  if ($tipousuario[1] != $permissao[1]) {
                                      echo "<option value=$tipousuario[1]>$tipousuario[0]</option>\n";
                                  }

                            }
                            echo "</select>";
                       ?>
                      </font>
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Url Foto</div>
                      </TD>
                      <TD><?php echo "$linha[1]"; ?>
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Foto</div>
                      </TD>
                      <TD><input type=file class="text" name=arqimagem  size=22>
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Matr&iacute;cula</div></TD>
                      <TD><input name="matricula" type="text" size="10" maxlength="10" value=<?php echo "\"$linha[2]\"";?>></TD></TR>
                    <TR>
                      <TD><div align="right">Data de Nascimento</div>
                      </TD>
                      <TD><input name="dnascimento" type="text" size="10" maxlength="10" value=<?php echo "\""; echo sqldata_to_php($linha[3]); echo "\""; ?> onKeyUp="DateFormat(this,this.value,event,false,'3')" onBlur="DateFormat(this,this.value,event,true,'3')">
                      </TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Data de Admiss&atilde;o na Empresa</div></TD>
                      <TD><input name="dadmissao" type="text" size="10" maxlength="10" value=<?php echo "\""; echo sqldata_to_php($linha[4]); echo "\""; ?> onKeyUp="DateFormat(this,this.value,event,false,'3')" onBlur="DateFormat(this,this.value,event,true,'3')"></TD></TR>
                    <TR>
                      <TD><div align="right">Data de Expira&ccedil;&atilde;o</div></TD>
                      <TD><input name="dexpiracao" type="text" size="10" maxlength="10" value=<?php echo "\""; echo sqldata_to_php($linha[5]); echo "\""; ?> onKeyUp="DateFormat(this,this.value,event,false,'3')" onBlur="DateFormat(this,this.value,event,true,'3')"></TD></TR>
                    <TR>
                      <TD><div align="right">CPF</div></TD>
                      <TD><input name="cpf" type="text" size="11" maxlength="11" value=<?php echo "\"$linha[6]\""; ?> onKeyPress="return numbersonly(this, event)"></TD></TR>
                    <TR>
                      <TD><div align="right">RG</div></TD>
                      <TD><input type="text" name="rg" value=<?php echo "\"$linha[7]\""; ?> onKeyPress="return numbersonly(this, event)"></TD></TR>
                    <TR>
                      <TD><div align="right">&Oacute;rg&atilde;o Emissor</div></TD>
                      <TD><input type="text" name="orgemissor" value=<?php echo "\"$linha[8]\""; ?>></TD></TR>
                    <TR>
                      <TD><div align="right">UF do &Oacute;rg&atilde;o Emissor</div></TD>
                      <TD><input type="text" name="orguf" value=<?php echo "\"$linha[9]\""; ?>></TD></TR>
                    <TR>
                      <TD><div align="right">Endere&ccedil;o</div></TD>
                      <TD><input type="text" name="endereco" value=<?php echo "\"$linha[10]\""; ?>></TD></TR>
                    <TR>
                      
                <TD height="22">
<div align="right">E-mail</div></TD>
                      <TD><input name="email" type="text" id="email" size="30" value=<?php echo "\"$linha[11]\""; ?>></TD>
                    </TR>
                    <TR>
                      <TD><div align="right">Telefone de Contato</div></TD>
                      <TD><input type="text" name="telefone" value=<?php echo "\"$linha[12]\""; ?> onKeyPress="return numbersonly(this, event)"></TD>
                    </TR>
					</TBODY></TABLE></TD></TR>
              <TR>
                <TD colspan="2" bgColor=white>
                  <P align=right>&nbsp;<INPUT type=submit value="Cadastrar / Atualizar" name=btn_submit>
                  </P></TD></TR></TBODY></TABLE>
            </FORM>

<?php
     }

?>

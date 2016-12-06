<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php
        $p_id          = $_POST['hidid'];
        $p_rzsocial    = $_POST['txtrazaosocial'];
        $p_nomefant    = $_POST['txtnomefantasia'];
        $p_cnpj        = $_POST['txtcnpj'];
        $p_logradouro  = $_POST['txtlogradouro'];
        $p_numero      = $_POST['txtnumero'];
        $p_bairro      = $_POST['txtbairro'];
        $p_cep         = $_POST['txtcep'];
        $p_tel         = $_POST['txttelefone'];
        $p_email       = $_POST['txtemail'];
        $p_repre       = $_POST['txtrepresentante'];
        $p_tel_repre   = $_POST['txttelrepresentante'];
        $p_email_repre = $_POST['txtemailrepresentante'];

        $msg_aviso = "Erro";
        $cor       = "erro";

        if ($p_rzsocial=="") {
          $msg = msgGeral('4','','razão social');
        }elseif ($p_nomefant=="") {
            $msg = msgGeral('4','','nome fantasia');
          }elseif ($p_cnpj=="") {
              $msg = msgGeral('4','','CNPJ');
            }elseif ($p_logradouro=="") {
                $msg = msgGeral('4','','logradouro');
              }elseif ($p_numero=="") {
                  $msg = msgGeral('4','','número');
                }elseif ($p_bairro=="") {
                    $msg = msgGeral('4','','bairro');
                  }elseif ($p_cep=="") {
                      $msg = msgGeral('4','','CEP');
                    }elseif ($p_tel=="") {
                        $msg = msgGeral('4','','telefone');
                      }elseif ($p_email=="") {
                          $msg = msgGeral('4','','email');
                        }elseif ($p_repre=="") {
                            $msg = msgGeral('4','','representante');
                          }elseif ($p_tel_repre=="") {
                              $msg = msgGeral('4','','tel. representante');
                            }elseif ($p_email_repre=="") {
                                $msg = msgGeral('4','','email do representante');
                            }else {

                              $sql_sel_fornecedor = "SELECT * FROM fornecedores WHERE (razao_social='".$p_rzsocial."' OR cnpj='".$p_cnpj."') AND id<>'".$p_id."'";

                              $sql_sel_fornecedor_preparado = selecionar($sql_sel_fornecedor);

                              if ($sql_sel_fornecedor_preparado->rowCount()==0) {

                                $tabela = "fornecedores";

                                $dados = array(
                                  'razao_social'  => $p_rzsocial,
                                  'nome'          => $p_nomefant,
                                  'cnpj'          => $p_cnpj,
                                  'email'         => $p_email,
                                  'telefone'      => $p_tel,
                                  'logradouro'    => $p_logradouro,
                                  'cep'           => $p_cep,
                                  'numero'        => $p_numero,
                                  'bairro'        => $p_bairro,
                                  'representante' => $p_repre,
                                  'email_rep'     => $p_email_repre,
                                  'telefone_rep'  => $p_tel_repre
                                );

                                $condicao = "id = '".$p_id."'";

                                $sql_alt_fornecedor_resultado = alterar($tabela, $dados, $condicao);

                                if ($sql_alt_fornecedor_resultado) {
                                  $msg_aviso = "Confirmação";
                                  $msg       = msgGeral('5', 'Alteração', 'fornecedor');
                                  $cor       = "confirmacao";
                                  $destino   = "?folder=registros/fornecedor/&file=registro_fornecedor_fornecedor&ext=php";
                                }else {
                                  $msg = msgGeral('2', 'alteração', 'fornecedor');
                                }
                              }else {
                                $msg = msgGeral('8','','');
                              }
                            }
      ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a class="icone" href="<?php echo $destino ?>"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>

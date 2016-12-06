<div>
  <h1 class="titulo_corpo" Align="center">Aviso</h1>
  <div class="mensagem_aviso">
    <?php

      $p_id         = $_POST['hidid'];
      $p_frete      = $_POST['txtfrete'];
      $p_ipi        = $_POST['txtipi'];
      $p_st         = $_POST['txtst'];
      $p_despesas   = $_POST['txtdespesas'];
      $p_margem     = $_POST['txtmargem'];
      $p_valorvenda = $_POST['txtvalor_venda'];

      $msg  = "";
      $msg_aviso = "Erro";
      $cor       = "erro";
      $destino   = "?folder=relatorios/movimentacoes/entradas/novos/&file=falt_movimentacao_entrada_novos&ext=php&id=".$p_id;

      if($p_frete==""){
        $msg = msgGeral('4','','Frete');
      }elseif($p_ipi==""){
        $msg = msgGeral('4','','IPI');
      }elseif($p_st==""){
          $msg = msgGeral('4','','ST');
          }elseif($p_despesas==""){
            $msg = msgGeral('4','','Despesas');
            }elseif($p_margem==""){
              $msg = msgGeral('4','','Margem');
            }elseif($p_valorvenda==""){
              $msg = msgGeral('4','','Valor de Venda');
            }else{

                $tabela = "entradas";

                $dados = array(
                  'frete'       => $p_frete,
                  'ipi'         => $p_ipi,
                  'st'          => $p_st,
                  'despesas'    => $p_despesas,
                  'margem'      => $p_margem,
                  'valor_venda' => $p_valorvenda
              );
              $condicao = "id = '".$p_id."'";

              $sql_alt_entradas_resultado = alterar($tabela, $dados, $condicao);

              if ($sql_alt_entradas_resultado) {
                $msg_aviso = "Confirmação";
                $msg       = msgGeral('5', 'Alteração', 'Valor de Venda');
                $cor       = "confirmacao";
                $destino   = "?folder=relatorios/movimentacoes/entradas/novos/&file=relatorio_movimentacao_entrada_novos&ext=php";
              }else {
                $msg = msgGeral('2', 'alteração', 'Valor de Venda');
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

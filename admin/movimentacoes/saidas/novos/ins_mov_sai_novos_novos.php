<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php
        $p_marca       = $_POST['selmarca'];
        $p_categoria   = $_POST['selcategoria'];
        $p_id_produto  = $_POST['selproduto'];
        $p_lote        = $_POST['sellote'];
        $p_quantidade  = $_POST['txtquantidade'];
        $p_motivo      = $_POST['selmotivo'];
        $p_desconto    = $_POST['txtdesconto'];
        $p_data        = $_POST['txtdata'];
        $p_valor_venda = $_POST['txtvalvenda'];

        $msg_aviso = "Erro";
        $cor       = "erro";

        if ($p_marca=="") {
          $msg = msgGeral('4','','Marca');
        }elseif ($p_categoria=="") {
          $msg = msgGeral('4','','Categoria');
          }elseif ($p_id_produto=="") {
            $msg = msgGeral('4','','Produto');
            }elseif ($p_lote=="") {
              $msg = msgGeral('4','','Lote');
              }elseif ($p_quantidade=="") {
                $msg = msgGeral('4','','Quantidade');
                }elseif ($p_motivo=="") {
                  $msg = msgGeral('4','','Motivo');
                  }elseif ($p_desconto=="") {
                    $msg = msgGeral('4','','Desconto');
                    }elseif ($p_data=="") {
                      $msg = msgGeral('4','','Data');
                      }elseif ($p_valor_venda=="") {
                        $msg = msgGeral('4','','Valor de Venda');
                      }else{
                        $sql_sel_saidas_novos = "SELECT * FROM entradas WHERE id='".$p_lote."' AND produtos_id='".$p_id_produto."' AND esgotada='0' AND tipo='PN'";

                        $sql_sel_saidas_novos_preparado = selecionar($sql_sel_saidas_novos);

                        if ($sql_sel_saidas_novos_preparado->rowCount()>0) {

                          $sql_sel_saidas_novos_dados = $sql_sel_saidas_novos_preparado->fetch();

                          $atual = $sql_sel_saidas_novos_dados['quantidade'] - $p_quantidade;

                          if ($atual>=0){
                            $tabela = "entradas";

                            $dados = array(
                              'quantidade' => $atual
                            );

                            $condicao = "id='".$p_lote."' AND produtos_id='".$p_id_produto."' AND esgotada='0' AND tipo='PN'";

                            $sql_alt_quantidade_resultado = alterar($tabela, $dados, $condicao);

                            if ($sql_alt_quantidade_resultado){

                              if ($atual==0){
                                $tabela = "entradas";

                                $dados = array(
                                  'esgotada' => '1'
                                );

                                $condicao = "id='".$p_lote."' AND produtos_id='".$p_id_produto."' AND esgotada='0' AND tipo='PN'";

                                $sql_alt_esgotada_resultado = alterar($tabela, $dados, $condicao);

                                if ($sql_alt_esgotada_resultado){
                                  $tabela = "saidas";

                                  $dados = array(
                                    'entradas_id' => $p_lote,
                                    'quantidade'  => $p_quantidade,
                                    'motivo'      => $p_motivo,
                                    'desconto'    => $p_desconto,
                                    'data'        => $p_data
                                  );

                                  $sql_ins_movimentacao_resultado = adicionar($tabela, $dados);

                                  if ($sql_ins_movimentacao_resultado) {
                                    $msg_aviso = "Confirmação";
                                    $msg       = msgGeral('1', 'efetuado', 'movimentação');
                                    $cor       = "confirmacao";
                                  }else {
                                    $msg = msgGeral('2', 'registro', 'movimentação');
                                  }
                                }else{
                                  $msg = msgGeral('2', 'alteração', 'esgotada');
                                }
                              }else{
                                $tabela = "saidas";

                                $dados = array(
                                  'entradas_id' => $p_lote,
                                  'quantidade'  => $p_quantidade,
                                  'motivo'      => $p_motivo,
                                  'desconto'    => $p_desconto,
                                  'data'        => $p_data
                                );

                                $sql_ins_movimentacao_resultado = adicionar($tabela, $dados);

                                if ($sql_ins_movimentacao_resultado) {
                                  $msg_aviso = "Confirmação";
                                  $msg       = msgGeral('1', 'efetuado', 'movimentação');
                                  $cor       = "confirmacao";
                                }else {
                                  $msg = msgGeral('2', 'registro', 'movimentação');
                                }
                              }
                            }else{
                              $msg = msgGeral('2', 'alteração', 'quantidade');
                            }
                          }else{
                            $msg = msgGeral('11', '', '');
                          }
                      }else{
                        $msg = msgGeral('8','','');
                      }
                    }
                      ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a class="icone" href="?folder=movimentacoes/saidas/novos/&file=mov_sai_novos_novos&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>

<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        $p_id_produto = $_POST['selproduto'];
        $p_id_fornecedor = $_POST['selfornecedor'];
        $p_quantidade = $_POST['txtquantidade'];
        $p_valor_compra = $_POST['txtvalcompra'];
        $p_frete = $_POST['txtfrete'];
        $p_st = $_POST['txtst'];
        $p_ipi = $_POST['txtipi'];
        $p_despesas = $_POST['txtdespesas'];
        $p_margem = $_POST['txtmargem'];
        $p_nnf = $_POST['txtnnffornecedor'];
        $p_data = $_POST['txtdata'];
        $p_valor_venda = $_POST['txtvalvenda'];

        $msg_aviso = "Erro";
        $cor       = "erro";

        if ($p_id_produto=="") {
          $msg = msgGeral('4','','Produto');
        }elseif ($p_id_fornecedor=="") {
            $msg = msgGeral('4','','Fornecedores');
          }elseif ($p_quantidade=="") {
              $msg = msgGeral('4','','Quantidade');
            }elseif ($p_valor_compra=="") {
                $msg = msgGeral('4','','Valor de Compra');
              }elseif ($p_frete=="") {
                  $msg = msgGeral('4','','Frete');
                }elseif ($p_st=="") {
                    $msg = msgGeral('4','','ST');
                  }elseif ($p_ipi=="") {
                      $msg = msgGeral('4','','IPI');
                    }elseif ($p_despesas=="") {
                        $msg = msgGeral('4','','Despesas');
                      }elseif ($p_margem=="") {
                          $msg = msgGeral('4','','Margem');
                        }elseif ($p_nnf=="") {
                            $msg = msgGeral('4','','NNF');
                          }elseif ($p_data=="") {
                              $msg = msgGeral('4','','Data');
                            }elseif ($p_valor_venda=="") {
                                $msg = msgGeral('4','','Valor de Venda');
                            }else{

                              $tabela = "entradas";

                              $dados = array(
                                'produtos_id' => $p_id_produto,
                                'fornecedores_id' => $p_id_fornecedor,
                                'quantidade' => $p_quantidade,
                                'esgotada' => '0',
                                'tipo' => 'PN',
                                'valor_venda' => str_replace(',','.',preg_replace('#[^\d\,]#is','',$p_valor_venda)),
                                'valor_compra' => $p_valor_compra,
                                'frete' => $p_frete,
                                'st' => $p_st,
                                'ipi' => $p_ipi,
                                'despesas' => $p_despesas,
                                'margem' => $p_margem,
                                'nf' => $p_nnf,
                                'data' => $p_data
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
      ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a class="icone" href="?folder=movimentacoes/entradas/novos/&file=mov_ent_novos_novos&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>

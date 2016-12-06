<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        $p_id_produto = $_POST['selproduto'];
        $p_id_vendedor = $_POST['selvendedor'];
        $p_quantidade = $_POST['txtquantidade'];
        $p_valor_compra = $_POST['txtvalcompra'];
        $p_despesas = $_POST['txtdespesas'];
        $p_margem = $_POST['txtmargem'];
        $p_data = $_POST['txtdata'];
        $p_valor_venda = $_POST['txtvalvenda'];

        $msg_aviso = "Erro";
        $cor       = "erro";

        if ($p_id_produto=="") {
          $msg = msgGeral('4','','Produto');
        }elseif ($p_id_vendedor=="") {
            $msg = msgGeral('4','','Vendedores');
          }elseif ($p_quantidade=="") {
              $msg = msgGeral('4','','Quantidade');
            }elseif ($p_valor_compra=="") {
                $msg = msgGeral('4','','Valor de Compra');
              }elseif ($p_despesas=="") {
                  $msg = msgGeral('4','','Despesas');
                }elseif ($p_margem=="") {
                    $msg = msgGeral('4','','Margem');
                  }elseif ($p_data=="") {
                        $msg = msgGeral('4','','Data');
                    }elseif ($p_valor_venda=="") {
                          $msg = msgGeral('4','','Valor de Venda');
                      }else{

                      $tabela = "entradas";

                      $dados = array(
                        'produtos_id' => $p_id_produto,
                        'vendedores_id' => $p_id_vendedor,
                        'quantidade' => $p_quantidade,
                        'esgotada' => '0',
                        'tipo' => 'PU',
                        'valor_venda' => str_replace(',','.',preg_replace('#[^\d\,]#is','',$p_valor_venda)),
                        'valor_compra' => $p_valor_compra,
                        'despesas' => $p_despesas,
                        'margem' => $p_margem,
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
          <a class="icone" href="?folder=movimentacoes/entradas/usados/&file=mov_ent_usados_usados&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>

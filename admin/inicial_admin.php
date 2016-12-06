<div>
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Estoque de Produtos Novos</h1>
  </span>
  <a href='#'><button style="background-color: #666;" class="tipos">Produtos Novos</button></a>
  <a href="?folder=relatorios/estoque/&file=relatorio_estoque_usados_estoque&ext=php"><button class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <span class="imprimir">
    <table class="table_relatorio">
      <?php
        $sql_sel_estoque = "SELECT produtos.id, produtos.nome AS produto, produtos.qtd_min_estoque AS qtd_min, produtos.imagem, marcas.nome AS marca, SUM(entradas.quantidade) AS soma_quantidade, entradas.valor_compra, entradas.despesas, entradas.margem, entradas.frete, entradas.st, entradas.ipi FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN marcas ON produtos.marcas_id=marcas.id WHERE entradas.tipo='PN' AND entradas.esgotada='0' AND produtos.status='0' GROUP BY produtos.id ASC";

        $sql_sel_estoque_preparado = selecionar($sql_sel_estoque);
      ?>
      <tr>
        <th class="tabela_especial">Produto</th>
        <th class="tabela_especial">Imagem</th>
        <th class="tabela_especial">Marca</th>
        <th class="tabela_especial">Quantidade</th>
        <th class="tabela_especial">Preço de Venda</th>
        <th class="tabela_especial">Info</th>
      </tr>
      <?php
      $valor_variante = 0;
      $valor_estimado = 0;
      $quantidade_estoque = 0;
      if ($sql_sel_estoque_preparado->rowCount()>0) {
              while ($sql_sel_estoque_dados = $sql_sel_estoque_preparado->fetch()){
                $valor_venda = cal_valor_venda($sql_sel_estoque_dados['valor_compra'], $sql_sel_estoque_dados['frete'], $sql_sel_estoque_dados['st'], $sql_sel_estoque_dados['ipi'], $sql_sel_estoque_dados['despesas'], $sql_sel_estoque_dados['margem'], '0', 'novo');
                $valor_estimado = $sql_sel_estoque_dados['soma_quantidade']*$valor_venda;
                $valor_variante = $valor_estimado+$valor_variante;

                $quantidade_estoque += $sql_sel_estoque_dados['soma_quantidade'];
      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_estoque_dados['produto']; ?></td>
        <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_estoque_dados['imagem']; ?>" width="60px" height="60px"></td>
        <td class="td_relatorio"><?php echo $sql_sel_estoque_dados['marca']; ?></td>
        <td class="td_relatorio" <?php if (($sql_sel_estoque_dados['soma_quantidade'] <= $sql_sel_estoque_dados['qtd_min']) && ($sql_sel_estoque_dados['soma_quantidade'] > '0')){?> title="Esse produto está em baixa no estoque" <?php }
        else if ($sql_sel_estoque_dados['soma_quantidade'] == '0') {?> title="Esse produto não contém mais estoque, desative esse produto em registro de produtos caso não deseje continuar vendendo" <?php }
        echo "/>".$sql_sel_estoque_dados['soma_quantidade']; ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($valor_venda,2,',','.'); ?></td>
        <td class="td_relatorio"><a style="color: #000;" href="?folder=relatorios/estoque/informacoes/novos/&file=informacoes_6_produto_informacoes&ext=php&id=<?php echo $sql_sel_estoque_dados['id']; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
      <?php

          }
        }else {
      ?>
        <tr>
          <td align="center" colspan="15">Não há registros.</td>
        </tr>
      <?php
        }

      ?>
      <tr>
        <td colspan="3"  class="tabela_especial">Valor Estimado em Estoque: <?php echo "R$".number_format($valor_variante,2,',','.');; ?></td>
        <td colspan="3"  class="tabela_especial">Total de Produtos em Estoque: <?php echo $quantidade_estoque; ?></td>
      </tr>
    </table>
  </span>
  <form action="<?php echo BASE_URL."adicionais/php/criar_pdf.php"?>" id="gerarpdf" method="POST" onsubmit="return pegarConteudo()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" class="b_imprimir"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>
  </form>
  <hr/ class="limpa_float">
</div>

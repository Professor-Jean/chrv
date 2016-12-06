<div>
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Saída no Estoque</h1>
  </span>
  <a href="?folder=relatorios/movimentacoes/saidas/novos/&file=relatorio_movimentacao_saida_novos&ext=php"><button class="tipos">Produtos Novos</button></a>
  <a href='#'><button style="background-color: #666;" class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <span class="imprimir">
    <table class="table_relatorio">
      <?php

        $sql_sel_saida = "SELECT saidas.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, saidas.quantidade, entradas.valor_compra, saidas.data, saidas.motivo, entradas.margem, entradas.despesas, saidas.desconto FROM saidas INNER JOIN entradas ON saidas.entradas_id=entradas.id INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id WHERE entradas.tipo='PU'";

        $sql_sel_saida_preparado = selecionar($sql_sel_saida);

      ?>
      <tr>
        <th class="tabela_especial">ID</th>
        <th class="tabela_especial">Produto</th>
        <th class="tabela_especial">Imagem</th>
        <th class="tabela_especial">Marca</th>
        <th class="tabela_especial">Categoria</th>
        <th class="tabela_especial">Quantidade</th>
        <th class="tabela_especial">Valor Compra</th>
        <th class="tabela_especial">Valor Venda</th>
        <th class="tabela_especial">Data</th>
        <th class="tabela_especial">Motivo</th>
        <th class="tabela_especial">Desconto</th>
      </tr>
      <?php

        if ($sql_sel_saida_preparado->rowCount()>0) {
          while ($sql_sel_saida_dados = $sql_sel_saida_preparado->fetch()) {
            $valor_venda = cal_valor_venda($sql_sel_saida_dados['valor_compra'], '', '', '', $sql_sel_saida_dados['despesas'], $sql_sel_saida_dados['margem'], $sql_sel_saida_dados['desconto'], 'usado');

      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['id']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['nome']; ?></td>
        <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_saida_dados['imagem']; ?>" width="60px" height="60px"></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['marca']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['categoria']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['quantidade']; ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_saida_dados['valor_compra']); ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($valor_venda,2,',','.'); ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['data']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['motivo']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saida_dados['desconto']; ?></td>
      </tr>
      <?php

          }
        }else {

      ?>
      <tr>
        <td align="center" colspan="11">Não há registros.</td>
      </tr>
      <?php

        }

      ?>
    </table>
  </span>
  <form action="../adicionais/php/criar_pdf.php" id="gerarpdf" method="POST" onsubmit="return pegarConteudo()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" class="b_imprimir"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>
  </form>
  <hr/ class="limpa_float">
</div>

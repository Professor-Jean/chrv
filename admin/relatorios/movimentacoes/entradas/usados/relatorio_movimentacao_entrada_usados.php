<div class="ajustavel">
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Entrada no Estoque</h1>
  </span>
  <?php
    $sql_sel_saidas = "SELECT entradas.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, vendedores.nome AS vendedor,vendedores.telefone AS telefone,entradas.quantidade, entradas.valor_compra, entradas.valor_venda, entradas.despesas, entradas.data, entradas.margem FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN vendedores ON entradas.vendedores_id=vendedores.id WHERE entradas.tipo='PU'";

    $sql_sel_saidas_preparado = selecionar($sql_sel_saidas);
   ?>
  <a href="?folder=relatorios/movimentacoes/entradas/novos/&file=relatorio_movimentacao_entrada_novos&ext=php"><button class="tipos">Produtos Novos</button></a>
  <a href='#'><button style="background-color: #666;" class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <span class="imprimir">
    <table class="table_relatorio" style="margin-left: 3%;">
      <tr>
        <th class="tabela_especial">ID</th>
        <th class="tabela_especial">Produto</th>
        <th class="tabela_especial">Imagem</th>
        <th class="tabela_especial">Marca</th>
        <th class="tabela_especial">Categoria</th>
        <th class="tabela_especial">Quantidade</th>
        <th class="tabela_especial">Valor de Venda</th>
        <th class="tabela_especial">Valor de Compra</th>
        <th class="tabela_especial">Despesas</th>
        <th class="tabela_especial">Margem</th>
        <th class="tabela_especial">data</th>
        <th class="tabela_especial">Nome Vendedor</th>
        <th class="tabela_especial">Telefone Vendedor</th>
        <th class="tabela_especial">Editar</th>
      </tr>
      <?php
      if ($sql_sel_saidas_preparado->rowCount()>0) {
              while ($sql_sel_saidas_dados = $sql_sel_saidas_preparado->fetch()){
      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['id']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['nome']; ?></td>
        <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_saidas_dados['imagem']; ?>" width="60px" height="60px"></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['marca']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['categoria']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['quantidade']; ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_saidas_dados['valor_venda'],2,',','.'); ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_saidas_dados['valor_compra'],2,',','.'); ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['despesas']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['margem']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['data']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['vendedor']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_saidas_dados['telefone']; ?></td>
        <td class="td_relatorio"><a href="?folder=relatorios/movimentacoes/entradas/usados/&file=falt_movimentacao_entrada_usados&ext=php&id=<?php echo $sql_sel_saidas_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></i></td>
      </tr>
        <?php
            }
          }else {
        ?>
          <tr>
            <td align="center" colspan="13">Não há registros.</td>
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

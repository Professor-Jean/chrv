<div class="ajustavel">
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Entrada no Estoque</h1>
  </span>
  <?php
    $sql_sel_entradas = "SELECT entradas.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, fornecedores.nome AS fornecedor, entradas.quantidade, entradas.valor_compra, entradas.valor_venda, entradas.st, entradas.ipi, entradas.frete, entradas.nf, entradas.despesas, entradas.data, entradas.margem FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN fornecedores ON entradas.fornecedores_id=fornecedores.id WHERE entradas.tipo='PN'";

    $sql_sel_entradas_preparado = selecionar($sql_sel_entradas);
   ?>
  <a href='#'><button style="background-color: #666;" class="tipos">Produtos Novos</button></a>
  <a href="?folder=relatorios/movimentacoes/entradas/usados/&file=relatorio_movimentacao_entrada_usados&ext=php"><button class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <span class="imprimir">
    <table class="table_relatorio" style="margin-left: 1%;">
      <tr>
        <th class="tabela_especial">ID</th>
        <th class="tabela_especial">Produto</th>
        <th class="tabela_especial">Imagem</th>
        <th class="tabela_especial">Marca</th>
        <th class="tabela_especial">Categoria</th>
        <th class="tabela_especial">Fornecedor</th>
        <th class="tabela_especial">Quantidade</th>
        <th class="tabela_especial">Valor de Venda</th>
        <th class="tabela_especial">Valor de Compra</th>
        <th class="tabela_especial">Frete</th>
        <th class="tabela_especial">ST</th>
        <th class="tabela_especial">IPI</th>
        <th class="tabela_especial">Despesas</th>
        <th class="tabela_especial">Margem</th>
        <th class="tabela_especial">Nota Fiscal</th>
        <th class="tabela_especial">data</th>
        <th class="tabela_especial">Editar</th>
      </tr>
      <?php
      if ($sql_sel_entradas_preparado->rowCount()>0) {
              while ($sql_sel_entradas_dados = $sql_sel_entradas_preparado->fetch()){
      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['id']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['nome']; ?></td>
        <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_entradas_dados['imagem']; ?>" width="60px" height="60px"></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['marca']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['categoria']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['fornecedor']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['quantidade']; ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_entradas_dados['valor_venda'],2,',','.'); ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_entradas_dados['valor_compra'],2,',','.'); ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['frete']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['st']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['ipi']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['despesas']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['margem']."%"; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['nf']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_entradas_dados['data']; ?></td>
        <td class="td_relatorio"><a href="?folder=relatorios/movimentacoes/entradas/novos/&file=falt_movimentacao_entrada_novos&ext=php&id=<?php echo $sql_sel_entradas_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></i></td>

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
    </table>
  </span>
  <form action="../adicionais/php/criar_pdf.php" id="gerarpdf" method="POST" onsubmit="return pegarConteudo()">
    <input type="hidden" name="dadospdf" id="dadospdf" value="">
    <button type="submit" class="b_imprimir"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>
  </form>
  <hr/ class="limpa_float">
</div>

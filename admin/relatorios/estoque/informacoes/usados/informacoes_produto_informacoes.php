<div class="ajustavel">
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Informações de Produtos Usados</h1>
  </span>
    <?php
      $g_id = $_GET['id'];
      $sql_sel_informacao = "SELECT entradas.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, vendedores.nome AS vendedor, entradas.quantidade, entradas.valor_compra, entradas.data, entradas.valor_venda, entradas.despesas, entradas.margem FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN vendedores ON entradas.vendedores_id=vendedores.id WHERE entradas.tipo='PU' AND produtos.id='".$g_id."'";

      $sql_sel_informacao_preparado = selecionar($sql_sel_informacao);

     ?>
     <span class="imprimir">
      <table class="table_relatorio" style="margin-left:5.5%;">
        <tr>
         <th class="tabela_especial">ID</th>
         <th class="tabela_especial">Produto</th>
         <th class="tabela_especial">Imagem</th>
         <th class="tabela_especial">Marca</th>
         <th class="tabela_especial">Categoria</th>
         <th class="tabela_especial">Quantidade</th>
         <th class="tabela_especial">Valor Compra</th>
         <th class="tabela_especial">Valor Venda</th>
         <th class="tabela_especial">Despesas</th>
         <th class="tabela_especial">Margem</th>
         <th class="tabela_especial">Data</th>
       </tr>
         <?php

           if ($sql_sel_informacao_preparado->rowCount()>0) {
             while ($sql_sel_informacao_dados = $sql_sel_informacao_preparado->fetch()) {

         ?>
       <tr>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['id']; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['nome']; ?></td>
         <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_informacao_dados['imagem']; ?>" width="60px" height="60px"></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['marca']; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['categoria']; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['quantidade']; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['valor_compra']; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['valor_venda']; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['despesas']."%"; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['margem']."%"; ?></td>
         <td class="td_relatorio"><?php echo $sql_sel_informacao_dados['data']; ?></td>
        </tr>
         <?php

             }
           }else {

         ?>
         <tr>
           <td align="center" colspan="17">Não há registros.</td>
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

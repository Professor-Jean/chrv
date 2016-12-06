<div class="ajustavel">
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Produtos</h1>
  </span>
  <hr/ class="limpa_float">
  <form name="filtrorelatorioprodutos" method="POST" action="?folder=relatorios/produtos/&file=relatorio_produtos_produtos&ext=php">
  <fieldset  style ="margin-top: 10px; margin-left: 20%;">
    <legend style="font-size: 20px; margin-left: 25%">Filtro para Consulta de Produtos</legend>
  <table>
      <tr>
        <td>Produto:</td>
        <td><input type="text" name="txtproduto" maxlength="45" class="campo_filtro"></td>
        <td style="padding-left: 250px;">Novo:</td>
        <td><input type="checkbox" name="chknovo" maxlength="11"></td>
      </tr>
      <tr>
        <td>Marca:</td>
        <td><input type="text" name="txtmarca" maxlength="70" class="campo_filtro"></td>
        <td style="padding-left: 250px;">Usado:</td>
        <td><input type="checkbox" name="chkusado" maxlength="11"></td>
      </tr>
      <tr>
        <td>Categoria:</td>
        <td><input type="text" name="txtcategoria" maxlength="11" class="campo_filtro"></td>
        <td style="padding-left: 250px;">Ativado:</td>
        <td><input type="checkbox" name="chkativado" maxlength="11"></td>
      </tr>
      <tr>
      <tr>
        <td style="padding-left: 466px;" colspan="3">Desativado:</td>
        <td><input type="checkbox" name="chkdesativado" maxlength="11"></td>
      </tr>
      </tr>
        <td colspan="4" align="center"><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnsalvar" type="submit" class="botao_registro">Filtrar</button></td>
      </tr>
    </table>
  </form>
</fieldset>
<?php

	$sql_sel_relatorio_produto = "SELECT fornecedores.nome AS fornecedor, saidas.quantidade AS qtd_saidas, vendedores.nome AS vendedor, entradas.margem, entradas.valor_venda, entradas.valor_compra, produtos.nome, produtos.imagem, marcas.nome AS marcas, produtos.status, entradas.tipo, categorias.nome AS categoria, entradas.quantidade AS qtd_entradas FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id LEFT JOIN fornecedores ON entradas.fornecedores_id=fornecedores.id LEFT JOIN vendedores ON entradas.vendedores_id=vendedores.id LEFT JOIN saidas ON saidas.entradas_id=saidas.id WHERE entradas.esgotada='0'";


  	if((isset($_POST['txtproduto'])&&($_POST['txtproduto']!=""))){
  		$p_produto  = $_POST['txtproduto'];
  		$sql_sel_relatorio_produto .= " AND produtos.nome LIKE '%".$p_produto."%'";
  	}

  	if((isset($_POST['txtmarca']))&&($_POST['txtmarca']!="")){
  		$p_marca = $_POST['txtmarca'];
  		$sql_sel_relatorio_produto .= " AND marcas.nome LIKE '%".$p_marca."%'";
  	}
  	if((isset($_POST['txtcategoria']))&&($_POST['txtcategoria']!="")){
  		$p_categoria = $_POST['txtcategoria'];
  		$sql_sel_relatorio_produto .= " AND categorias.nome LIKE '%".$p_categoria."%'";
  	}
  	if((isset($_POST['txtquantidade']))&&($_POST['txtquantidade']!="")){
      $sql_sel_relatorio_produto_dados = $sql_sel_relatorio_produto_preparado->fetch();
      $QtdAtual = $sql_sel_relatorio_produto_dados['qtd_entradas'] - $sql_sel_relatorio_produto_dados['qtd_saidas'];
  		$sql_sel_relatorio_produto .= " AND qtd_entradas - qtd_saidas LIKE ".$QtdAtual."";
  	}
    if((isset($_POST['chknovo']))&&(isset($_POST['chkusado']))&&($_POST['chkusado']!="")&&($_POST['chknovo']!="")){
      $sql_sel_relatorio_produto .= " AND (entradas.tipo ='PN' OR entradas.tipo ='PU')";
    }
    if((isset($_POST['chknovo']))&&($_POST['chknovo']!="")&&(!isset($_POST['chkusado']))){
      $sql_sel_relatorio_produto .= " AND entradas.tipo ='PN'";
    }
    if((isset($_POST['chkusado']))&&($_POST['chkusado']!="")&&(!isset($_POST['chknovo']))){
      $sql_sel_relatorio_produto .= " AND entradas.tipo ='PU'";
    }
    if((isset($_POST['chkativado']))&&(isset($_POST['chkdesativado']))&&($_POST['chkdesativado']!="")&&($_POST['chkativado']!="")){
        $sql_sel_relatorio_produto .= " AND (produtos.status ='0' OR produtos.status ='1')";
    }
    if((isset($_POST['chkativado'])&&($_POST['chkativado']!=""))&&(!isset($_POST['chkdesativado']))){
      $sql_sel_relatorio_produto .= " AND produtos.status ='0'";
    }
    if((isset($_POST['chkdesativado'])&&($_POST['chkdesativado']!=""))&&(!isset($_POST['chkativado']))){
      $sql_sel_relatorio_produto .= " AND produtos.status ='1'";
    }

    $sql_sel_relatorio_produto .= " GROUP BY produtos.nome";

    $sql_sel_relatorio_produto_preparado = selecionar($sql_sel_relatorio_produto);


  ?>
  <span class="imprimir">
    <table class="table_relatorio" style="margin-left: 9%;">
      <tr>
        <th width="11%" class="tabela_especial">Produto</th>
        <th width="11%" class="tabela_especial">Imagem</th>
        <th width="10%" class="tabela_especial">Marca</th>
        <th width="13%" class="tabela_especial">Fornecedor</th>
        <th width="13%" class="tabela_especial">Vendedor</th>
        <th width="11%" class="tabela_especial">Categoria</th>
        <th width="5%" class="tabela_especial">Status</th>
        <th width="5%" class="tabela_especial">Tipo</th>
        <th width="7%" class="tabela_especial">Quantidade</th>
        <th width="12%" class="tabela_especial">Preço de Venda</th>
        <th width="12%" class="tabela_especial">Preço de Compra</th>
        <th width="11%" class="tabela_especial">Margem</th>
      </tr>
      <?php

        if ($sql_sel_relatorio_produto_preparado->rowCount()>0) {
          while ($sql_sel_relatorio_produto_dados = $sql_sel_relatorio_produto_preparado->fetch()){
                $QtdAtual = $sql_sel_relatorio_produto_dados['qtd_entradas'] - $sql_sel_relatorio_produto_dados['qtd_saidas'];

      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_relatorio_produto_dados['nome']; ?></td>
        <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_relatorio_produto_dados['imagem']; ?>" width="60px" height="60px"></td>
        <td class="td_relatorio"><?php echo $sql_sel_relatorio_produto_dados['marcas']; ?></td>
        <td class="td_relatorio"><?php if($sql_sel_relatorio_produto_dados['fornecedor']==""){
                                          echo "-";
                              	       }else{
                                         echo $sql_sel_relatorio_produto_dados['fornecedor'];
                                       }
                                 ?></td>
   <td class="td_relatorio"><?php if ($sql_sel_relatorio_produto_dados['vendedor']==""){
                                    echo "-";
                                  }else {
                                    echo $sql_sel_relatorio_produto_dados['vendedor'];
                                  }
  ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_relatorio_produto_dados['categoria']; ?></td>
        <td class="td_relatorio"><?php if ($sql_sel_relatorio_produto_dados['status']=="0"){echo "Ativo";}else{echo "Desativo";}; ?></td>
        <td class="td_relatorio"><?php if ($sql_sel_relatorio_produto_dados['tipo']=="PN"){echo "Produto Novo";}else{echo "Produto Usado";}; ?></td>
        <td class="td_relatorio"><?php echo $QtdAtual ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_relatorio_produto_dados['valor_venda']); ?></td>
        <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_relatorio_produto_dados['valor_compra']); ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_relatorio_produto_dados['margem']; ?></td>
      </tr>
      <?php
          }
        }else {
      ?>
        <tr>
          <td align="center"; colspan="12">Não há registros.</td>
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

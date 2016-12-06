<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Alteração de Produto</h1>
  <?php

    $g_id = $_GET['id'];

    $sql_sel_produto = "SELECT produtos.id, produtos.nome, produtos.imagem, produtos.categorias_id, produtos.marcas_id, marcas.nome AS marca, categorias.nome AS categoria, produtos.status, produtos.qtd_min_estoque FROM produtos INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id WHERE produtos.id='".$g_id."'";

    $sql_sel_produto_preparado = selecionar($sql_sel_produto);

    $sql_sel_produto_dados = $sql_sel_produto_preparado->fetch();
  ?>
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form  name="frmAltProduto" enctype="multipart/form-data" onsubmit="" method="post" action="?folder=registros/produto/&file=alt_registro_produto_produto&ext=php">
      <input type="hidden" name="hidid" value="<?php echo $sql_sel_produto_dados['id']; ?>">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Nome:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnome" value="<?php echo $sql_sel_produto_dados['nome'] ?>" maxlength="10"></td>
        </tr>
        <tr>
          <td class="td_registro">Imagem:</td>
          <td class="td_registro"><input type="file" name="flimage" ></td>
          <td class="td_relatorio"><img src="../adicionais/imagens_produtos/<?php echo $sql_sel_produto_dados['imagem']; ?>" width="60px" height="60px"></td>
        </tr>
        <tr>
          <td class="td_registro">Marca:</td>
          <td class="td_registro">
            <select class="input_registro" name="selmarca">
            <option value="">Escolha...</option>
            <?php

            $sql_sel_marcas = "SELECT * FROM marcas ORDER BY nome ASC";

            $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

            while ($sql_sel_marcas_dados = $sql_sel_marcas_preparado->fetch()) {
              $selected = "";

                  if ($sql_sel_marcas_dados['id']==$sql_sel_produto_dados['marcas_id']) {

                    $selected = "selected";
                  }
                  ?>
                    <option value="<?php echo $sql_sel_marcas_dados['id']; ?>" <?php echo $selected; ?>><?php echo $sql_sel_marcas_dados['nome']; ?></option>";
                  <?php
                }
                  ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Categoria</td>
          <td class="td_registro">
            <select class="input_registro" name="selcategoria">
            <option value="">Escolha...</option>
            <?php

            $sql_sel_categoria = "SELECT * FROM categorias ORDER BY nome ASC";

            $sql_sel_categoria_preparado = selecionar($sql_sel_categoria);

            while ($sql_sel_categoria_dados = $sql_sel_categoria_preparado->fetch()) {
              $selected = "";

                  if ($sql_sel_categoria_dados['id']==$sql_sel_produto_dados['categorias_id']) {

                    $selected = "selected";
                  }
                  ?>
                    <option value="<?php echo $sql_sel_categoria_dados['id']; ?>" <?php echo $selected; ?>><?php echo $sql_sel_categoria_dados['nome']; ?></option>";
                  <?php
                }
                  ?>
          </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Qtd. Mín. Estoque:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtqnt_min_estoque" placeholder="10" maxlength="10" value="<?php echo $sql_sel_produto_dados['qtd_min_estoque']; ?>"></td>
        </tr>
        <tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Enviar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <hr/ class="limpa_float">
</div>

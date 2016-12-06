      <div class="ajustavel">
        <h1 class="titulo_corpo" align="center">Registro de Produto</h1>
        <div style="margin-bottom: 2%; margin-top: 1.5%;">
          <form name="frmCadProduto" enctype="multipart/form-data" onsubmit="" method="post" action="?folder=registros/produto/&file=ins_registro_produto_produto&ext=php">
            <table class="tabela_registro">
              <tr>
                <td class="td_registro">Nome:</td>
                <td class="td_registro"><input class="input_registro" type="text" name="txtnome" placeholder="Nome do produto" maxlength="40" required></td>
              </tr>
              <tr>
                <td class="td_registro">Imagem:</td>
                <td class="td_registro"><input type="file" name="flimage" required></td>
              </tr>
              <tr>
                <td class="td_registro">Marca:</td>
                <td class="td_registro">
                  <select class="input_registro" name="selmarca" required>
    							<option value="">Escolha...</option>
                  <?php

                  $sql_sel_marcas = "SELECT * FROM marcas ORDER BY nome ASC";

                  $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

                  while ($sql_sel_marcas_dados = $sql_sel_marcas_preparado->fetch()) {
                    $id_marcas   = $sql_sel_marcas_dados['id'];
                    $nome_marcas = $sql_sel_marcas_dados['nome'];

                    echo "<option value='".$id_marcas."'>".$nome_marcas."</option>";
                  }
                  ?>
    						  </select>
                </td>
              </tr>
              <tr>
                <td class="td_registro">Categoria</td>
                <td class="td_registro">
                  <select class="input_registro" name="selcategoria" required>
                  <option value="">Escolha...</option>
                  <?php

                  $sql_sel_categoria = "SELECT * FROM categorias ORDER BY nome ASC";

                  $sql_sel_categoria_preparado = selecionar($sql_sel_categoria);

                  while ($sql_sel_categoria_dados = $sql_sel_categoria_preparado->fetch()) {
                    $id_categorias  = $sql_sel_categoria_dados['id'];
                    $nome_categoria = $sql_sel_categoria_dados['nome'] ;

                    echo "<option value='".$id_categorias."'>".$nome_categoria."</option>";
                  }
                  ?>
                </select>
                </td>
              </tr>
              <tr>
                <td class="td_registro">Qtd. Mín. Estoque:</td>
                <td class="td_registro"><input class="input_registro" type="text" name="txtqnt_min_estoque" placeholder="10" maxlength="2" required></td>
              </tr>
              <tr>
                <td></td>
                <td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Registrar</button></td>
              </tr>
            </table>
          </form>
        </div>
        <h2 align="center">Produtos Registrados</h2>
        <hr/ class="limpa_float">
        <table class="table_relatorio" style="margin-left: 5%">
          <?php

            $sql_sel_produto = "SELECT produtos.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, produtos.status, produtos.qtd_min_estoque FROM produtos INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN categorias ON produtos.categorias_id=categorias.id";

            $sql_sel_produto_preparado = selecionar($sql_sel_produto);

          ?>
          <tr>
            <th class="tabela_especial">ID</th>
            <th class="tabela_especial">Nome</th>
            <th class="tabela_especial">Imagem</th>
            <th class="tabela_especial">Marca</th>
            <th class="tabela_especial">Categoria</th>
            <th class="tabela_especial">Status</th>
            <th class="tabela_especial">Qtd. Mín. Estoque</th>
            <th class="tabela_especial">Desativar</th>
            <th class="tabela_especial">Ativar</th>
            <th class="tabela_especial">Editar</th>
            <th class="tabela_especial">Excluir</th>
          </tr>
          <?php

            if ($sql_sel_produto_preparado->rowCount()>0) {
              while ($sql_sel_produto_dados = $sql_sel_produto_preparado->fetch()) {
                if ($sql_sel_produto_dados['status']==0) {
                  $status = "Ativado";
                }else {
                  $status = "Desativado";
                }

          ?>
          <tr>
            <td class="td_relatorio"><?php echo $sql_sel_produto_dados['id']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_produto_dados['nome']; ?></td>
            <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_produto_dados['imagem']; ?>" width="60px" height="60px"></td>
            <td class="td_relatorio"><?php echo $sql_sel_produto_dados['marca']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_produto_dados['categoria']; ?></td>
            <td class="td_relatorio"><?php echo $status; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_produto_dados['qtd_min_estoque']; ?></td>
            <?php if ($sql_sel_produto_dados['status']==0){ ?>
              <td class="td_relatorio"><a href="?folder=registros/produto/&file=desativar_produto_produto&ext=php&id=<?php echo $sql_sel_produto_dados['id']; ?>"><i class="fa fa-power-off icone_tabela" aria-hidden="true"></a></i></td>
            <?php }else{ ?>
              <td class="td_relatorio" align="center">-</td>
            <?php };
              if ($sql_sel_produto_dados['status']==1) {
            ?>
            <td class="td_relatorio"><a href="?folder=registros/produto/&file=reativar_produto_produto&ext=php&id=<?php echo $sql_sel_produto_dados['id']; ?>"><i class="fa fa-power-off icone_tabela" aria-hidden="true"></i></a></td>
            <?php
              }else{
             ?>
             <td class="td_relatorio" align="center">-</td>
             <?php } ?>
            <td class="td_relatorio"><a href="?folder=registros/produto/&file=falt_registro_produto_produto&ext=php&id=<?php echo $sql_sel_produto_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></i></td>
            <td class="td_relatorio"><?php echo safeDelete($sql_sel_produto_dados['id'], 'nao', '?folder=registros/produto/&file=del_registro_produto_produto&ext=php', $sql_sel_produto_dados['nome'], 'produto'); ?></td>
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
        <hr/ class="limpa_float">
      </div>

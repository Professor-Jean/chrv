<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Registro de Categoria</h1>
  <div style="padding-top: 15%; padding-left: 1%; padding-bottom: 47%; border-right: 2px solid #000; float: left; padding-right: 5%;">
    <form name="frmCadcategoria" onsubmit="" method="post" action="?folder=registros/categoria/&file=ins_registro_categoria_categoria&ext=php">
      <table>
        <tr>
          <td class="td_registro" style="font-size: 20px;">Nome: </td>
          <td class="td_registro"><input class="input_registro" style="width: 93%;" type="text" name="txtnome" placeholder="Instrumento de Corda" maxlength="30" required></td>
        </tr>
        <tr>
          <td class="td_registro" style="font-size: 20px; padding-top: 1%;">Descrição: </td>
          <td><textarea name="txadescricao" placeholder="Categoria para todos os instrumentos de corda" class="td_registro" style="margin-top: 4%;" required></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar" style="margin-left: 18.5%;">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro" style="padding-right: 60px;">Registrar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="div_float">
    <h2 align="center">Categorias Registradas</h2>
    <table class="table_relatorio">
      <?php

        $sql_sel_categorias = "SELECT * FROM categorias";

        $sql_sel_categorias_preparado = selecionar($sql_sel_categorias);

      ?>
      <tr>
        <th class="tabela_especial">ID</th>
        <th class="tabela_especial">Nome</th>
        <th class="tabela_especial">Descrição</th>
        <th class="tabela_especial">Editar</th>
        <th class="tabela_especial">Excluir</th>
      </tr>
      <?php

        if ($sql_sel_categorias_preparado->rowCount()>0) {
          while ($sql_sel_categorias_dados = $sql_sel_categorias_preparado->fetch()) {

      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_categorias_dados['id']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_categorias_dados['nome']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_categorias_dados['descricao']; ?></td>
        <td class="td_relatorio"><a href="?folder=registros/categoria/&file=falt_registro_categoria_categoria&ext=php&id=<?php echo $sql_sel_categorias_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></td>
        <td class="td_relatorio"><?php echo safeDelete($sql_sel_categorias_dados['id'], 'nao', '?folder=registros/categoria/&file=del_registro_categoria_categoria&ext=php', $sql_sel_categorias_dados['nome'], 'categoria'); ?></td>
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
  </div>
</div>

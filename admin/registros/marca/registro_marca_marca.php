<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Registro de Marca</h1>
  <div style="padding-top: 15%; padding-left: 1%; padding-bottom: 47%; border-right: 2px solid #000; float: left; padding-right: 5%;">
    <form name="frmCadMarca" enctype="multipart/form-data" onsubmit="" method="post" action="?folder=registros/marca/&file=ins_registro_marca_marca&ext=php">
      <table>
        <tr>
          <td class="td_registro" style="font-size: 20px;">Nome: </td>
          <td class="td_registro"><input class="input_registro" style="width: 93%;" type="text" name="txtnome" placeholder="Nome Categoria" maxlength="40" required></td>
        </tr>
        <tr>
          <td class="td_registro" style="font-size: 20px;">Logo: </td>
          <td class="td_registro"><input type="file" name="flimage" required></td>
        </tr>
        <tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar" style="margin-left: 28%;">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Registrar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="div_float">
    <h2 align="center">Marcas Registradas</h2>
    <table class="table_relatorio">
      <?php

        $sql_sel_marcas = "SELECT * FROM marcas";

        $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

      ?>
      <tr>
        <th class="tabela_especial">ID</th>
        <th class="tabela_especial">Marca</th>
        <th class="tabela_especial">Logo</th>
        <th class="tabela_especial">Editar</th>
        <th class="tabela_especial">Excluir</th>
      </tr>
      <?php

        if ($sql_sel_marcas_preparado->rowCount()>0) {
          while ($sql_sel_marcas_dados = $sql_sel_marcas_preparado->fetch()) {

      ?>
      <tr>
        <td class="td_relatorio"><?php echo $sql_sel_marcas_dados['id']; ?></td>
        <td class="td_relatorio"><?php echo $sql_sel_marcas_dados['nome']; ?></td>
        <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_marcas/".$sql_sel_marcas_dados['logo']; ?>" width="60px" height="60px"></td>
        <td class="td_relatorio"><a href="?folder=registros/marca/&file=falt_registro_marca_marca&ext=php&id=<?php echo $sql_sel_marcas_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></td>
        <td class="td_relatorio"><?php echo safeDelete($sql_sel_marcas_dados['id'], 'nao', '?folder=registros/marca/&file=del_registro_marca_marca&ext=php', $sql_sel_marcas_dados['nome'], 'marcas'); ?></td>
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

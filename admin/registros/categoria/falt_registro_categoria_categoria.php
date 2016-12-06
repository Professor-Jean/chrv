<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Alteração de Categoria</h1>
  <?php

    $g_id = $_GET['id'];

    $sql_sel_categorias = "SELECT * FROM categorias WHERE id='".$g_id."'";

    $sql_sel_categorias_preparado = selecionar($sql_sel_categorias);

    $sql_sel_categorias_dados = $sql_sel_categorias_preparado->fetch();
  ?>
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form  name="frmAltcategoria" onsubmit="" method="post" action="?folder=registros/categoria/&file=alt_registro_categoria_categoria&ext=php">
      <input type="hidden" name="hidid" value="<?php echo $sql_sel_categorias_dados['id']; ?>">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Nome:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnome" value="<?php echo $sql_sel_categorias_dados['nome'] ?>" maxlength="30"></td>
        </tr>
        <tr>
          <td class="td_registro">Descrição:</td>
          <td><textarea name="txadescricao" placeholder="Categoria para todos os instrumentos de corda" class="td_registro" style="margin-top: 4%;" required><?php echo $sql_sel_categorias_dados['descricao'] ?></textarea></td>
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

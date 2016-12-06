<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Alteração de Marca</h1>
  <?php

    $g_id = $_GET['id'];

    $sql_sel_marcas = "SELECT * FROM marcas WHERE id='".$g_id."'";

    $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

    $sql_sel_marcas_dados = $sql_sel_marcas_preparado->fetch();
    ''
  ?>
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form  name="frmAltmarca"  enctype="multipart/form-data" onsubmit="" method="post" action="?folder=registros/marca/&file=alt_registro_marca_marca&ext=php">
      <input type="hidden" name="hidid" value="<?php echo $sql_sel_marcas_dados['id']; ?>">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Nome:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnome" value="<?php echo $sql_sel_marcas_dados['nome'] ?>" maxlength="40"></td>
        </tr>
        <tr>
          <td class="td_registro">Logo:</td>
          <td class="td_registro"><input type="file" name="fllogo"></td>
          <td class="td_relatorio"><img src="../adicionais/imagens_marcas/<?php echo $sql_sel_marcas_dados['logo']; ?>" width="60px" height="60px"></td>
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

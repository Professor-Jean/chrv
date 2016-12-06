<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Alteração de Usuário</h1>
  <?php

    $g_id = $_GET['id'];

    $sql_sel_usuario = "SELECT * FROM usuarios WHERE id='".$g_id."'";

    $sql_sel_usuario_preparado = selecionar($sql_sel_usuario);

    $sql_sel_usuario_dados = $sql_sel_usuario_preparado->fetch();
  ?>
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form  name="frmAltusuario" onsubmit="" method="post" action="?folder=registros/usuario/&file=alt_registro_usuario_usuario&ext=php">
      <input type="hidden" name="hidid" value="<?php echo $sql_sel_usuario_dados['id']; ?>">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Usuário:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtusuario" value="<?php echo $sql_sel_usuario_dados['usuario'] ?>" maxlength="22" required></td>
        </tr>
        <tr>
          <td class="td_registro">Senha:</td>
          <td class="td_registro"><input class="input_registro" type="password" name="pwdsenha" maxlenght:"32" required></td>
        </tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Enviar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <hr/ class="limpa_float">
</div>

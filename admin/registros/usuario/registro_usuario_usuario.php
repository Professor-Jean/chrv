<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Registro de Usuário</h1>
  <div style="padding-top: 15%; padding-left: 1%; padding-bottom: 47%; border-right: 2px solid #000; float: left; padding-right: 5%;">
    <form name="frmCadMarca" onsubmit="" method="post" action="?folder=registros/usuario/&file=ins_registro_usuario_usuario&ext=php">
      <table>
        <tr>
          <td class="td_registro" style="font-size: 20px;">Usuário: </td>
          <td class="td_registro"><input class="input_registro" style="width: 93%;" type="text" name="txtusuario" placeholder="adm" maxlength="22" required></td>
        </tr>
        <tr>
          <td class="td_registro" style="font-size: 20px;">Senha: </td>
          <td class="td_registro"><input  class="input_registro" style="width: 93%;"  type="password" name="pwdsenha"  maxlength="32" placeholder="***********" required></td>
        </tr>
        <tr>
					<?php

					//password='".$hash_senha."'";

					$sql_sel_usuario = "SELECT * FROM usuarios";

					$sql_sel_usuario_preparado = selecionar($sql_sel_usuario);

					?>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar" style="margin-left: 18.5%;">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro" style="padding-right: 60px;">Registrar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="div_float">
    <h2 align="center">Usuários Registrados</h2>
    <table class="table_relatorio">
      <tr>
        <th class="tabela_especial">ID</th>
        <th class="tabela_especial">Usuário</th>
        <th class="tabela_especial">Editar</th>
        <th class="tabela_especial">Excluir</th>
			</tr>
			<?php

				if ($sql_sel_usuario_preparado->rowCount()>0) {
					while ($sql_sel_usuario_dados = $sql_sel_usuario_preparado->fetch()) {

			?>
			<tr>
				<td class="td_relatorio"><?php echo $sql_sel_usuario_dados['id']; ?></td>
				<td class="td_relatorio"><?php echo $sql_sel_usuario_dados['usuario']; ?></td>
        <td class="td_relatorio"><a href="?folder=registros/usuario/&file=falt_registro_usuario_usuario&ext=php&id=<?php echo $sql_sel_usuario_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></i></a></td>
        <td class="td_relatorio"><?php echo safeDelete($sql_sel_usuario_dados['id'], 'nao', '?folder=registros/usuario/&file=del_registro_usuario_usuario&ext=php', $sql_sel_usuario_dados['usuario'], 'usuarios'); ?></td>
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

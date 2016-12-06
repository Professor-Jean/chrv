<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Registro de Vendedor</h1>
  <div style="margin-top: 1.5%; margin-bottom: 2%;">
    <form name="frmCadVendedor" onsubmit="" method="post" action="?folder=registros/vendedor/&file=ins_vendedor_vendedor&ext=php">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Nome:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnome" placeholder="Nome do Vendedor" maxlength="40" required></td>
        </tr>
        <tr>
          <td class="td_registro">Telefone:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txttel" placeholder="Tel. do Vendedor" maxlength="15" required></td>
        </tr>
        <tr>
          <td class="td_registro">E-mail:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtemail" placeholder="E-mail do Vendedor" maxlength="70" required></td>
        </tr>
        <tr>
          <td class="td_registro">Bairro:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtbairro" placeholder="Bairro do Vendedor" maxlength="22" required></td>
        </tr>
        <tr>
          <td class="td_registro">CEP:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtcep" placeholder="CEP do Vendedor" maxlength="8" required></td>
        </tr>
        <tr>
          <td class="td_registro">Logradouro:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtlogradouro" placeholder="Logradouro do Vendedor" maxlength="45" required></td>
        </tr>
        <tr>
          <td class="td_registro">Número:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnum" placeholder="Número da residência" maxlength="5" required></td>
        </tr>
        <tr>
          <td></td>
      		<td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnsalvar" type="submit" class="botao_registro">Enviar</button></td>
      	</tr>
      </table>
    </form>
  </div>
  <h2  align="center">Vendedores Cadastrados</h2>
    <?php

      $sql_sel_vendedor = "SELECT * from vendedores";

      $sql_sel_vendedor_preparado = selecionar($sql_sel_vendedor);
    ?>
<table class="table_relatorio">
  <thead>
    <tr>
      <th class="tabela_especial">ID</th>
      <th class="tabela_especial">Nome</th>
      <th class="tabela_especial">Logradouro</th>
      <th class="tabela_especial">Número</th>
      <th class="tabela_especial">Bairro</th>
      <th class="tabela_especial">CEP</th>
      <th class="tabela_especial">Telefone</th>
      <th class="tabela_especial">E-mail</th>
      <th class="tabela_especial">Editar</th>
      <th class="tabela_especial">Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if($sql_sel_vendedor_preparado->rowCount()>0){
        while($sql_sel_vendedor_dados = $sql_sel_vendedor_preparado->fetch()){
    ?>
    <tr>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['id']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['nome']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['logradouro'];?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['numero'];?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['bairro'];?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['cep']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['telefone']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_vendedor_dados['email']; ?></td>
      <td class="td_relatorio"><a href="?folder=registros/vendedor/&file=falt_registro_vendedor_vendedor&ext=php&id=<?php echo $sql_sel_vendedor_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></i></td>
      <td class="td_relatorio"><?php echo safeDelete($sql_sel_vendedor_dados['id'], 'nao', '?folder=registros/vendedor/&file=del_registro_vendedor_vendedor&ext=php', $sql_sel_vendedor_dados['nome'], 'vendedores'); ?></td>

    </tr>
    <?php
      }
        }else{
    ?>
    <tr>
      <td align="center" colspan="10">Não há registros.</td>
    </tr>
    <?php
      }
     ?>
   </tbody>
  </table>
        <hr/ class="limpa_float">
      </div>
    </div>
    <hr/ class="limpa_float">
  </body>
</html>

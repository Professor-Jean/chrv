<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Registro de Fornecedor</h1>
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form name="frmCadProduto" onsubmit="" method="post" action="?folder=registros/fornecedor/&file=ins_registro_fornecedor_fornecedor&ext=php">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Razão Social:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtrazaosocial" placeholder="Razão social da empresa" maxlength="60" required></td>
        </tr>
        <tr>
          <td class="td_registro">Nome Fantasia:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnomefantasia" placeholder="Nome fantasia da empresa" maxlength="40" required></td>
        </tr>
        <tr>
          <td class="td_registro">CNPJ:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtcnpj" maxlength="14" placeholder="CNPJ do fornecedor" required></td>
        </tr>
        <tr>
          <td class="td_registro">Logradouro:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtlogradouro" maxlength="45" placeholder="Rua, avenida, etc da empresa" required></td>
        </tr>
        <tr>
          <td class="td_registro">Número:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnumero" placeholder="numero do local, ex:360" maxlength="5" required></td>
        </tr>
        <tr>
          <td class="td_registro">Bairro:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtbairro" placeholder="bairro da empresa" maxlength="22" required></td>
        </tr>
        <tr>
          <td class="td_registro">CEP:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtcep" placeholder="cep da empresa" maxlength="8" required></td>
        </tr>
        <tr>
          <td class="td_registro">Telefone:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txttelefone" placeholder="telefone da empresa" maxlength="15" required></td>
        </tr>
        <tr>
          <td class="td_registro">Email:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtemail" placeholder="emaildaempresa" maxlength="70" required></td>
        </tr>
        <tr>
          <td class="td_registro">Representante</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtrepresentante" placeholder="Nome do Representante" maxlength="40" required></td>
        </tr>
        <tr>
          <td class="td_registro">Tel. Representante</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txttelrepresentante" placeholder="telefone do representante" maxlength="15" required></td>
        </tr>
        <tr>
          <td class="td_registro">Email Representante</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtemailrepresentante" placeholder="email do representante" maxlength="70" required></td>
        </tr>
        <tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Registrar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <h2 align="center">Fornecedores Registrados</h2>
  <hr/ class="limpa_float">
  <table class="table_relatorio">
    <?php

      $sql_sel_fornecedor = "SELECT * FROM fornecedores";

      $sql_sel_fornecedor_preparado = selecionar($sql_sel_fornecedor);

    ?>
    <tr>
      <th class="tabela_especial">ID</th>
      <th class="tabela_especial">Razão Social</th>
      <th class="tabela_especial">Nome Fantasia</th>
      <th class="tabela_especial">CNPJ</th>
      <th class="tabela_especial">Logradouro</th>
      <th class="tabela_especial">Número</th>
      <th class="tabela_especial">Bairro</th>
    </tr>
    <?php

      if ($sql_sel_fornecedor_preparado->rowCount()>0) {
        while ($sql_sel_fornecedor_dados = $sql_sel_fornecedor_preparado->fetch()) {

    ?>
    <tr>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['id']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['razao_social']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['nome']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['cnpj']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['logradouro']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['numero']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['bairro']; ?></td>
    </tr>
    <?php

        }
      }else {

    ?>
    <tr>
      <td align="center" colspan="7">Não há registros.</td>
    </tr>
    <?php

      }

    ?>
  </table>
  <table class="table_relatorio">
    <?php

      $sql_sel_fornecedor = "SELECT * FROM fornecedores";

      $sql_sel_fornecedor_preparado = selecionar($sql_sel_fornecedor);

    ?>
    <tr>
      <th class="tabela_especial">CEP</th>
      <th class="tabela_especial">Telefone</th>
      <th class="tabela_especial">E-mail</th>
      <th class="tabela_especial">Tel.Representante</th>
      <th class="tabela_especial">E-mail Representante</th>
      <th class="tabela_especial">Editar</th>
      <th class="tabela_especial">Excluir</th>
    </tr>
    <?php

      if ($sql_sel_fornecedor_preparado->rowCount()>0) {
        while ($sql_sel_fornecedor_dados = $sql_sel_fornecedor_preparado->fetch()) {

    ?>
    <tr>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['cep']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['telefone']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['email']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['telefone_rep']; ?></td>
      <td class="td_relatorio"><?php echo $sql_sel_fornecedor_dados['email_rep']; ?></td>
      <td class="td_relatorio"><a href="?folder=registros/fornecedor/&file=falt_registro_fornecedor_fornecedor&ext=php&id=<?php echo $sql_sel_fornecedor_dados['id']; ?>"><i class="fa fa-pencil icone_tabela" aria-hidden="true"></i></td>
      <td class="td_relatorio"><?php echo safeDelete($sql_sel_fornecedor_dados['id'], 'nao', '?folder=registros/fornecedor/&file=del_registro_fornecedor_fornecedor&ext=php', $sql_sel_fornecedor_dados['nome'], 'fornecedor'); ?></td>
    </tr>

      <?php
        }
      }else {

    ?>
    <tr>
      <td align="center" colspan="7">Não há registros.</td>
    </tr>
    <?php

      }

      ?>

  </table>
  <hr/ class="limpa_float">
</div>

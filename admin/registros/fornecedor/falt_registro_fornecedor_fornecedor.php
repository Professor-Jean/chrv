<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Alteração de Fornecedor</h1>
  <?php

    $g_id = $_GET['id'];

    $sql_sel_fornecedor = "SELECT * FROM fornecedores";

    $sql_sel_fornecedor_preparado = selecionar($sql_sel_fornecedor);

    $sql_sel_fornecedor_dados = $sql_sel_fornecedor_preparado->fetch();
  ?>
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form name="frmAltFornecedor" onsubmit="" method="post" action="?folder=registros/fornecedor/&file=alt_registro_fornecedor_fornecedor&ext=php">
      <input type="hidden" name="hidid" value="<?php echo $sql_sel_fornecedor_dados['id']; ?>">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Razão Social:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtrazaosocial" placeholder="Razão social da empresa" maxlength="60" value="<?php echo $sql_sel_fornecedor_dados['razao_social']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Nome Fantasia:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnomefantasia" placeholder="Nome fantasia da empresa" maxlength="40" value="<?php echo $sql_sel_fornecedor_dados['nome']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">CNPJ:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtcnpj" maxlength="14" placeholder="CNPJ do fornecedor" value="<?php echo $sql_sel_fornecedor_dados['cnpj']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Logradouro:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtlogradouro" maxlength="45" placeholder="Rua, avenida, etc da empresa" value="<?php echo $sql_sel_fornecedor_dados['logradouro']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Número:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnumero" placeholder="numero do local, ex:360" maxlength="5" value="<?php echo $sql_sel_fornecedor_dados['numero']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Bairro:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtbairro" placeholder="bairro da empresa" maxlength="22" value="<?php echo $sql_sel_fornecedor_dados['bairro']; ?>" required><//td>
        </tr>
        <tr>
          <td class="td_registro">CEP:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtcep" placeholder="cep da empresa" maxlength="8" value="<?php echo $sql_sel_fornecedor_dados['cep']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Telefone:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txttelefone" placeholder="telefone da empresa" maxlength="15" value="<?php echo $sql_sel_fornecedor_dados['telefone']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Email:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtemail" placeholder="emaildaempresa" maxlength="70" value="<?php echo $sql_sel_fornecedor_dados['email']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Representante</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtrepresentante" placeholder="Nome do Representante" maxlength="40" value="<?php echo $sql_sel_fornecedor_dados['representante']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Tel. Representante</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txttelrepresentante" placeholder="telefone do representante" maxlength="15" value="<?php echo $sql_sel_fornecedor_dados['telefone_rep']; ?>" required></td>
        </tr>
        <tr>
          <td class="td_registro">Email Representante</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtemailrepresentante" placeholder="email do representante" maxlength="70" value="<?php echo $sql_sel_fornecedor_dados['email_rep']; ?>" required></td>
        </tr>
        <tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Registrar</button></td>
        </tr>
      </table>
    </form>
  </div>
  <hr/ class="limpa_float">
</div>

<div class="ajustavel">
  <h1 class="titulo_corpo" Align="center">Alteração de Vendedor</h1>
  <?php

  $g_id = $_GET['id'];

  $sql_sel_vendedor = "SELECT * FROM vendedores WHERE id='".$g_id."'";

  $sql_sel_vendedor_preparado = selecionar($sql_sel_vendedor);

  $sql_sel_vendedor_dados = $sql_sel_vendedor_preparado->fetch();

   ?>
   <div style="margin-top: 1.5%; margin-bottom: 2%;">
     <form name="frmCadVendedor" onsubmit="" method="post" action="?folder=registros/vendedor/&file=alt_registro_vendedor_vendedor&ext=php">
       <input type="hidden" name="hidid" value="<?php echo $sql_sel_vendedor_dados['id']; ?>">
       <table class="tabela_registro">
         <tr>
           <td class="td_registro">Nome:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txtnome" value="<?php echo $sql_sel_vendedor_dados['nome'];?>" maxlength="40" required></td>
         </tr>
         <tr>
           <td class="td_registro">Telefone:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txttel" value="<?php echo $sql_sel_vendedor_dados['telefone'];?>" maxlength="15" required></td>
         </tr>
         <tr>
           <td class="td_registro">E-mail:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txtemail" value="<?php echo $sql_sel_vendedor_dados['email'];?>" maxlength="70" required></td>
         </tr>
         <tr>
           <td class="td_registro">Bairro:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txtbairro" value="<?php echo $sql_sel_vendedor_dados['bairro'];?>" maxlength="22" required></td>
         </tr>
         <tr>
           <td class="td_registro">CEP:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txtcep" value="<?php echo $sql_sel_vendedor_dados['cep'];?>" maxlength="10" required></td>
         </tr>
         <tr>
           <td class="td_registro">Logradouro:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txtlogradouro" value="<?php echo $sql_sel_vendedor_dados['logradouro'];?>" maxlength="45" required></td>
         </tr>
         <tr>
           <td class="td_registro">Número:</td>
           <td class="td_registro"><input class="input_registro" type="text" name="txtnum" value="<?php echo $sql_sel_vendedor_dados['numero'];?> "maxlength="5" required></td>
         </tr>
         <tr>
           <td></td>
       		<td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnsalvar" type="submit" class="botao_registro">Enviar</button></td>
       	</tr>
       </table>
     </form>
   </div>
 </div>

<div class="ajustavel">
  <h1 class="titulo_corpo" Align="center">Alteração do Valor de Venda</h1>
  <?php

      $g_id = $_GET['id'];

      $sql_sel_valor_venda = "SELECT id, valor_venda, valor_compra, margem, despesas FROM entradas WHERE tipo='PU' AND id='".$g_id."'";

      $sql_sel_valor_venda_preparado = selecionar($sql_sel_valor_venda);

      $sql_sel_valor_venda_dados = $sql_sel_valor_venda_preparado->fetch();

   ?>
   <div style="margin-top: 1.5%; margin-bottom: 2%;">
     <form name="frmCadValorVenda" onsubmit="" method="post" action="?folder=relatorios/movimentacoes/entradas/usados/&file=alt_movimentacao_entrada_usados&ext=php">
       <input type="hidden" name="hidid" value="<?php echo $sql_sel_valor_venda_dados['id'];?>">
       <input type="hidden" id="vCompra" name="hidvalvenda" value="<?php echo $sql_sel_valor_venda_dados['valor_compra'];?>">
       <table class="tabela_registro">
         <tr>
           <td class="td_registro">Despesas:</td>
           <td class="td_registro"><input class="input_registro" id="vDespesas" onblur="calcularValorVenda()" type="text" name="txtdespesas" value="<?php echo $sql_sel_valor_venda_dados['despesas'];?>" maxlength="40" required></td>
         </tr>
         <tr>
           <td class="td_registro">Margem:</td>
           <td class="td_registro"><input class="input_registro" id="vMargem" onblur="calcularValorVenda()" type="text" name="txtmargem" value="<?php echo $sql_sel_valor_venda_dados['margem'];?>" maxlength="40" required></td>
         </tr>
         <tr>
           <td class="td_registro">Valor de Venda:</td>
           <td class="td_registro"><input class="input_registro" id="vVenda" onblur="recalcularMargem()" type="text" name="txtvalor_venda" value="<?php echo number_format($sql_sel_valor_venda_dados['valor_venda'], 2, ',', '.');?>" maxlength="40" required></td>
         </tr>
         <tr>
           <td></td>
       		<td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnsalvar" type="submit" class="botao_registro">Enviar</button></td>
       	</tr>
      </table>
    </form>
  </div>
</div>
<script>
function calcularValorVenda(){

  var vCompra, vDespesas, vMargem, vVenda, vCompraDespesas;
  vCompra = parseFloat($('#vCompra').val());
  vDespesas = parseFloat($('#vDespesas').val());
  vMargem = parseFloat($('#vMargem').val());
  vCompraDespesas = parseFloat('0');

   if(!isNaN(vDespesas)){
     vCompraDespesas = vCompra + ((vDespesas/100)*vCompra);
     vVenda = vCompraDespesas;
     vVenda = vVenda.toFixed(2);
     vVenda = vVenda.replace('.', ',');
     $('#vVenda').val(vVenda);
     if(!isNaN(vMargem)){
       vVenda = vCompraDespesas + ((vMargem/100)*vCompraDespesas);
       vVenda = vVenda.toFixed(2);
       vVenda = vVenda.replace('.', ',');
       $('#vVenda').val(vVenda);
     }
   }
 }

function recalcularMargem(){
  var vCompra, vDespesas, vMargem, vVenda, vCompraDespesas;
  vCompra = parseFloat($('#vCompra').val());
  vDespesas = parseFloat($('#vDespesas').val());
  vMargem = parseFloat($('#vMargem').val());
  vCompraDespesas = parseFloat('0');

  vCompraDespesas = vCompra + ((vDespesas/100)*vCompra);
  vVenda = vCompraDespesas + ((vMargem/100)*vCompraDespesas);

  if(!isNaN(vVenda)){
    valor = parseFloat($('#vVenda').val());
    if(valor<vCompraDespesas){
      alert('O valor inserido irá gerar uma margem negativa!');
    }else{
    vMargem = ((valor-vCompraDespesas)/vCompraDespesas)*100;
    vMargem = vMargem.toFixed(2);
    $('#vMargem').val(vMargem);
    }
  }
}
</script>

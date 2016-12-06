<div class="ajustavel">
  <h1 class="titulo_corpo" Align="center">Alteração do Valor de Venda</h1>
  <?php

      $g_id = $_GET['id'];

      $sql_sel_valor_venda = "SELECT id, valor_venda, valor_compra, st, ipi, margem, despesas, frete FROM entradas WHERE tipo='PN' AND id='".$g_id."'";

      $sql_sel_valor_venda_preparado = selecionar($sql_sel_valor_venda);

      $sql_sel_valor_venda_dados = $sql_sel_valor_venda_preparado->fetch();

   ?>
   <div style="margin-top: 1.5%; margin-bottom: 2%;">
     <form name="frmCadValorVenda" onsubmit="" method="post" action="?folder=relatorios/movimentacoes/entradas/novos/&file=alt_movimentacao_entrada_novos&ext=php">
       <input type="hidden" name="hidid" value="<?php echo $sql_sel_valor_venda_dados['id'];?>">
       <input type="hidden" id="vCompra" name="hidvalvenda" value="<?php echo $sql_sel_valor_venda_dados['valor_compra'];?>">
       <table class="tabela_registro">
         <tr>
           <td class="td_registro">Frete:</td>
           <td class="td_registro"><input class="input_registro" id="vFrete" onblur="calcularValorVenda()" type="text" name="txtfrete" value="<?php echo $sql_sel_valor_venda_dados['frete'];?>" maxlength="40" required></td>
         </tr>
         <tr>
           <td class="td_registro">ST:</td>
           <td class="td_registro"><input class="input_registro" id="vST" onblur="calcularValorVenda()" type="text" name="txtst" value="<?php echo $sql_sel_valor_venda_dados['st'];?>" maxlength="40" required></td>
         </tr>
         <tr>
           <td class="td_registro">IPI:</td>
           <td class="td_registro"><input class="input_registro" id="vIPI" onblur="calcularValorVenda()" type="text" name="txtipi" value="<?php echo $sql_sel_valor_venda_dados['ipi'];?>" maxlength="40" required></td>
         </tr>
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

    var vCompra ,vFrete, vST, vIPI, vDespesas, vMargem, vVenda, vCompraFrete, vFreteST, vSTIPI, vIPIDespesas;
    vCompra = parseFloat($('#vCompra').val());
    vFrete = parseFloat($('#vFrete').val());
    vST = parseFloat($('#vST').val());
    vIPI = parseFloat($('#vIPI').val());
    vDespesas = parseFloat($('#vDespesas').val());
    vMargem = parseFloat($('#vMargem').val());
    vCompraFrete = parseFloat('0');
    vFreteST = parseFloat('0');
    vSTIPI = parseFloat('0');
    vIPIDespesas = parseFloat('0');

    if(!isNaN(vFrete)){
      vCompraFrete = vCompra + ((vFrete/100)*vCompra);
      vVenda = vCompraFrete;
      vVenda = vVenda.toFixed(2);
      vVenda = vVenda.replace('.', ',');
      $('#vVenda').val(vVenda);
       if(!isNaN(vST)){
         vFreteST = vCompraFrete + ((vST/100)*vCompraFrete);
         vVenda = vFreteST;
         vVenda = vVenda.toFixed(2);
         vVenda = vVenda.replace('.', ',');
         $('#vVenda').val(vVenda);
         if(!isNaN(vIPI)){
           vSTIPI = vFreteST + ((vIPI/100)*vFreteST);
           vVenda = vSTIPI;
           vVenda = vVenda.toFixed(2);
           vVenda = vVenda.replace('.', ',');
           $('#vVenda').val(vVenda);
           if(!isNaN(vDespesas)){
             vIPIDespesas = vSTIPI + ((vDespesas/100)*vSTIPI);
             vVenda = vIPIDespesas;
             vVenda = vVenda.toFixed(2);
             vVenda = vVenda.replace('.', ',');
             $('#vVenda').val(vVenda);
             if(!isNaN(vMargem)){
               vVenda = vIPIDespesas + ((vMargem/100)*vIPIDespesas);
               vVenda = vVenda.toFixed(2);
               vVenda = vVenda.replace('.', ',');
               $('#vVenda').val(vVenda);
             }
           }
         }
       }
    }
  }

  function recalcularMargem(){
    var vCompra, vFrete, vST, vIPI, vDespesas, vMargem, vVenda, vCompraFrete, vFreteST, vSTIPI, vIPIDespesas;
    vCompra = parseFloat($('#vCompra').val());
    vFrete = parseFloat($('#vFrete').val());
    vST = parseFloat($('#vST').val());
    vIPI = parseFloat($('#vIPI').val());
    vDespesas = parseFloat($('#vDespesas').val());
    vMargem = parseFloat($('#vMargem').val());
    vCompraFrete = parseFloat('0');
    vFreteST = parseFloat('0');
    vSTIPI = parseFloat('0');
    vIPIDespesas = parseFloat('0');

    vCompraFrete = vCompra + ((vFrete/100)*vCompra);
    vFreteST = vCompraFrete + ((vST/100)*vCompraFrete);
    vSTIPI = vFreteST + ((vIPI/100)*vFreteST);
    vIPIDespesas = vSTIPI + ((vDespesas/100)*vSTIPI);
    vVenda = vIPIDespesas + ((vMargem/100)*vIPIDespesas);

    if(!isNaN(vVenda)){
      valor = parseFloat($('#vVenda').val());
      if(valor<vIPIDespesas){
        alert('O valor inserido irá gerar uma margem negativa!');
      }else{
      vMargem = ((valor-vIPIDespesas)/vIPIDespesas)*100;
      vMargem = vMargem.toFixed(2);
      $('#vMargem').val(vMargem);
      }
    }
  }
</script>

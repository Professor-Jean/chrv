<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Entrada de Estoque de Produtos Novos</h1>
  <a href='#'><button style="background-color: #666;" class="tipos">Produtos Novos</button></a>
  <a href='?folder=movimentacoes/entradas/usados/&file=mov_ent_usados_usados&ext=php'><button class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form name="frmCadEntradasNovos" onsubmit="" method="post" action="?folder=movimentacoes/entradas/novos/&file=ins_mov_ent_novos_novos&ext=php">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Marca:</td>
          <td class="td_registro">
            <select class="input_registro" id="marca" name="selmarca" onChange="mostraProdutosEnt()" required>
            <option value="">Escolha...</option>
            <?php

            $sql_sel_marca = "SELECT id, nome FROM marcas ORDER BY nome ASC";

            $sql_sel_marca_preparado = selecionar($sql_sel_marca);

            while ($sql_sel_marca_dados = $sql_sel_marca_preparado->fetch()) {
              $id_marca   = $sql_sel_marca_dados['id'];
              $nome_marca = $sql_sel_marca_dados['nome'];

              echo "<option value='".$id_marca."'>".$nome_marca."</option>";
            }
            ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Categoria:</td>
          <td class="td_registro">
            <select class="input_registro" id="categoria" name="selcategoria" onChange="mostraProdutosEnt()" required>
            <option value="">Escolha...</option>
            <?php

            $sql_sel_categoria = "SELECT id, nome FROM categorias ORDER BY nome ASC";

            $sql_sel_categoria_preparado = selecionar($sql_sel_categoria);

            while ($sql_sel_categoria_dados = $sql_sel_categoria_preparado->fetch()) {
              $id_categoria   = $sql_sel_categoria_dados['id'];
              $nome_categoria = $sql_sel_categoria_dados['nome'];

              echo "<option value='".$id_categoria."'>".$nome_categoria."</option>";
            }
            ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Produto:</td>
          <td class="td_registro">
            <select class="input_registro" id="produto" name="selproduto" required>
              <option value=''>Escolha...</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Fornecedor:</td>
          <td class="td_registro">
            <select class="input_registro" name="selfornecedor" required>
            <option value="">Escolha...</option>
            <?php

            $sql_sel_fornecedor = "SELECT id, nome FROM fornecedores ORDER BY nome ASC";

            $sql_sel_fornecedor_preparado = selecionar($sql_sel_fornecedor);

            while ($sql_sel_fornecedor_dados = $sql_sel_fornecedor_preparado->fetch()) {
              $id_fornecedor   = $sql_sel_fornecedor_dados['id'];
              $nome_fornecedor = $sql_sel_fornecedor_dados['nome'];

              echo "<option value='".$id_fornecedor."'>".$nome_fornecedor."</option>";
            }
            ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Quantidade:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtquantidade" placeholder="10" maxlength="3" required></td>
        </tr>
        <tr>
          <td class="td_registro">Valor de Compra:</td>
          <td class="td_registro"><input id="vCompra" class="input_registro" type="text" name="txtvalcompra" placeholder="10,00" maxlength="8" required></td>
        </tr>
        <tr>
          <td class="td_registro">Frete:</td>
          <td class="td_registro"><input id="vFrete" onblur="calcularValorVenda()" class="input_registro" type="text" name="txtfrete" placeholder="10" maxlength="6" required></td>
        </tr>
        <tr>
          <td class="td_registro">ST:</td>
          <td class="td_registro"><input id="vST" onblur="calcularValorVenda()" class="input_registro" type="text" name="txtst" placeholder="10" maxlength="6" required></td>
        </tr>
        <tr>
          <td class="td_registro">IPI:</td>
          <td class="td_registro"><input id="vIPI" onblur="calcularValorVenda()" class="input_registro" type="text" name="txtipi" placeholder="10" maxlength="6" required></td>
        </tr>
        <tr>
          <td class="td_registro">Despesas:</td>
          <td class="td_registro"><input id="vDespesas" onblur="calcularValorVenda()" class="input_registro" type="text" name="txtdespesas" placeholder="10" maxlength="6" required></td>
        </tr>
        <tr>
          <td class="td_registro">Margem:</td>
          <td class="td_registro"><input id="vMargem" onblur="calcularValorVenda()" class="input_registro" type="text" name="txtmargem" placeholder="10" maxlength="7" required></td>
        </tr>
        <tr>
          <td class="td_registro">NNF do Fornecedor:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtnnffornecedor" placeholder="10" maxlength="6" required></td>
        </tr>
        <tr>
          <td class="td_registro">Data:</td>
          <td class="td_registro"><input class="input_registro" type="date" name="txtdata" ></td>
        </tr>
        <tr>
          <td class="td_registro">Valor de Venda:</td>
          <td class="td_registro"><input id="vVenda" onblur="recalcularMargem()" class="input_registro" type="text" name="txtvalvenda" placeholder="10,00" required><!--<input type="button" onclick="calcularValorVenda()" value="Gerar Valor" /></td>-->
        </tr>
        <tr>
          <td></td>
          <td><button name="btnlimpar" type="reset" class="botao_limpar">Limpar</button><button name="btnregistrar" type="submit" class="botao_registro">Registrar</button></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<script>
function calcularValorVenda(){

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
      vMargem = 0;
      $('#vMargem').val(vMargem);
      $('#vVenda').val(vIPIDespesas);
    }else{
    vMargem = ((valor-vIPIDespesas)/vIPIDespesas)*100;
    vMargem = vMargem.toFixed(2);
    $('#vMargem').val(vMargem);
    }
  }
}
</script>

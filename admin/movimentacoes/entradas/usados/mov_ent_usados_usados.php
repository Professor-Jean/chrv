<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Entrada de Estoque de Produtos Usados</h1>
  <a href='?folder=movimentacoes/entradas/novos/&file=mov_ent_novos_novos&ext=php'><button class="tipos">Produtos Novos</button></a>
  <a href='#'><button style="background-color: #666;" class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form name="frmCadEntradasUsados" onsubmit="" method="post" action="?folder=movimentacoes/entradas/usados/&file=ins_mov_ent_usados_usados&ext=php">
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
          <td class="td_registro">Vendedor:</td>
          <td class="td_registro">
            <select class="input_registro" name="selvendedor" required>
            <option value="">Escolha...</option>
            <?php

            $sql_sel_vendedor = "SELECT id, nome FROM vendedores ORDER BY nome ASC";

            $sql_sel_vendedor_preparado = selecionar($sql_sel_vendedor);

            while ($sql_sel_vendedor_dados = $sql_sel_vendedor_preparado->fetch()) {
              $id_vendedor  = $sql_sel_vendedor_dados['id'];
              $nome_vendedor = $sql_sel_vendedor_dados['nome'];

              echo "<option value='".$id_vendedor."'>".$nome_vendedor."</option>";
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
          <td class="td_registro"><input class="input_registro" id="vCompra" type="text" name="txtvalcompra" placeholder="10,00" maxlength="8" required></td>
        </tr>
        <tr>
          <td class="td_registro">Despesas:</td>
          <td class="td_registro"><input class="input_registro" id="vDespesas" onblur="calcularValorVenda()" type="text" name="txtdespesas" placeholder="10" maxlength="6" required></td>
        </tr>
        <tr>
          <td class="td_registro">Margem:</td>
          <td class="td_registro"><input class="input_registro" id="vMargem" onblur="calcularValorVenda()" type="text" name="txtmargem" placeholder="10" maxlength="7" required></td>
        </tr>
        <tr>
          <td class="td_registro">Data:</td>
          <td class="td_registro"><input class="input_registro" type="date" name="txtdata" required></td>
        </tr>
        <tr>
          <td class="td_registro">Valor de Venda:</td>
          <td class="td_registro"><input id="vVenda" onblur="recalcularMargem()" class="input_registro" type="text" name="txtvalvenda" placeholder="10,00"><!--<input type="button" onclick="calcularValorVenda()" value="Gerar Valor" /></td>-->
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
      vMargem = 0;
      $('#vMargem').val(vMargem);
      $('#vVenda').val(vCompraDespesas);
    }else{
    vMargem = ((valor-vCompraDespesas)/vCompraDespesas)*100;
    vMargem = vMargem.toFixed(2);
    $('#vMargem').val(vMargem);
    }
  }
}
</script>

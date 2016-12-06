<div class="ajustavel">
  <h1 class="titulo_corpo" align="center">Saída de Estoque de Produtos Novos</h1>
  <?php

   ?>
  <a href='?folder=movimentacoes/saidas/novos/&file=mov_sai_novos_novos&ext=php'><button style="background-color: #666;" class="tipos">Produtos Novos</button></a>
  <a href='?folder=movimentacoes/saidas/usados/&file=mov_sai_usados_usados&ext=php'><button class="tipos">Produtos Usados</button></a>
  <hr/ class="limpa_float">
  <div style="margin-bottom: 2%; margin-top: 1.5%;">
    <form name="frmCadSaidasNovos" onsubmit="" method="post" action="?folder=movimentacoes/saidas/novos/&file=ins_mov_sai_novos_novos&ext=php">
      <table class="tabela_registro">
        <tr>
          <td class="td_registro">Marca:</td>
          <td class="td_registro">
            <select class="input_registro" id="marca" name="selmarca" onChange="mostraProdutosSai()" required>
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
            <select class="input_registro" id="categoria" name="selcategoria" onChange="mostraProdutosSai()" required>
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
            <select class="input_registro" id="produto" name="selproduto" onChange="mostraProdutosSaiLote()" required>
              <option value="">Escolha...</option>
            </select>
          </td>
        <tr>
          <td>Lote:</td>
          <td class="td_registro">
            <select class="input_registro" id="lote" name="sellote" onChange="mostraProdutosSaiVenda()" required>
              <option value="">Escolha...</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="td_registro">Quantidade:</td>
          <td class="td_registro"><input class="input_registro" type="text" name="txtquantidade" placeholder="10" maxlength="3" required></td>
        </tr>
        <tr>
          <td class="td_registro">Motivo:</td>
          <td class="td_registro">
          <select class="input_registro" name="selmotivo" required>
            <option value="">Escolha...</option>
            <option value="1">Brinde</option>
            <option value="2">Desaparecimento</option>
            <option value="3">Furto</option>
            <option value="4">Venda</option>
          </select>
        <tr>
          <td class="td_registro">Desconto:</td>
          <td class="td_registro"><input class="input_registro" id="vDesconto" onblur="calcularValorDesconto()" type="text" name="txtdesconto" placeholder="10,00" maxlength="8" required></td>
        </tr>
        <tr>
          <td class="td_registro">Data:</td>
          <td class="td_registro"><input class="input_registro" type="date" name="txtdata" required></td>
        </tr>
        <tr>
          <td><input type="hidden" id="vValor" name="hidvalor"></td>
        </tr>
        <tr>
          <td class="td_registro">Valor de Venda:</td>
          <td class="td_registro"><input class="input_registro" id="vVenda" onblur="recalcularDesconto()" type="text" name="txtvalvenda" placeholder="10,00" required></td>
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
  function calcularValorDesconto(){
    var vDesconto, vVenda, vValor, vDescontoVenda;
    vDesconto = parseFloat($('#vDesconto').val());
    vVenda = parseFloat($('#vVenda').val());
    vValor = parseFloat($('#vValor').val());
    vDescontoVenda = parseFloat(0);
    if(vDesconto>"100"){
      alert('O valor máximo para desconto é de 100%!');
    }else{
      if(vVenda!=vValor){
        vDescontoVenda = vValor - ((vDesconto/100)*vValor);
        console.log('valor de venda: '+vValor+'\nvalor Despesas: '+vDesconto+'\nvalor descontovenda: '+vDescontoVenda);
        vValor = vDescontoVenda;
        vValor = vValor.toFixed(2);
        vValor = vValor.replace('.', ',');
        $('#vVenda').val(vValor);
      }else{
        vDescontoVenda = vVenda - ((vDesconto/100)*vVenda);
        console.log('valor de venda: '+vVenda+'\nvalor Despesas: '+vDesconto+'\nvalor descontovenda: '+vDescontoVenda);
        vVenda = vDescontoVenda;
        vVenda = vVenda.toFixed(2);
        vVenda = vVenda.replace('.', ',');
        $('#vVenda').val(vVenda);
      }
    }
  }

  function recalcularDesconto(){
    var vDesconto, vVenda, vValor, vDescontoVenda;
    vDesconto = parseFloat($('#vDesconto').val());
    vVenda = parseFloat($('#vVenda').val());
    vValor = parseFloat($('#vValor').val());
    if(isNaN(vDesconto)){
      vDesconto = 0;
    }

    vDesconto = ((vValor-vVenda)/vVenda)*100;
    console.log('valor de venda: '+vVenda+'\nvalor Desconto: '+vDesconto+'\n valor: '+vValor);
    vDesconto = vDesconto.toFixed(2);
    $('#vDesconto').val(vDesconto);
  }
</script>

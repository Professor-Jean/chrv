<div class="ajustavel">
  <?php $g_id = $_GET['id'] ?>
  <span class="imprimir">
    <h1 class="titulo_corpo" align="center">Relatório de Informações de Produtos Novos</h1>
  </span>
  <a href="?folder=relatorios/estoque/informacoes/novos/&file=informacoes_6_produto_informacoes&ext=php&id=<?php echo $g_id; ?>"><button class="tipos">6 meses</button></a>
  <a href="#"><button style="background-color: #666;" class="tipos">12 meses</button></a>
  <a href="?folder=relatorios/estoque/informacoes/novos/&file=informacoes_24_produto_informacoes&ext=php&id=<?php echo $g_id ?>"><button class="tipos">24 meses</button></a>
  <hr/ class="limpa_float">
    <?php

    $data_atual = date('Y-m-d');
    $data_seis_atras = date('Y-m-01', strtotime("-12 Months"));


    $sql_sel_saida = "SELECT  COUNT(entradas.id) AS entradas, SUM(entradas.valor_venda) AS vendas, entradas.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, fornecedores.nome AS fornecedor, entradas.quantidade, entradas.valor_compra, entradas.data, entradas.frete, entradas.st, entradas.ipi, entradas.despesas, entradas.margem, entradas.nf FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN fornecedores ON entradas.fornecedores_id=fornecedores.id WHERE entradas.tipo='PN' AND produtos.id='".$g_id."' AND entradas.data BETWEEN '".$data_seis_atras."' AND '".$data_atual."' GROUP BY YEAR(entradas.data), MONTH(entradas.data) ORDER BY entradas.data";

    $sql_sel_saida_preparado = selecionar($sql_sel_saida);

    $numero_linhas = $sql_sel_saida_preparado->rowCount();
    for($i=0; $i<$numero_linhas; $i++){
      $sql_sel_saida_dados = $sql_sel_saida_preparado->fetch();
      if($sql_sel_saida_dados['entradas']>0){
        $venda = ($sql_sel_saida_dados['vendas'] / $sql_sel_saida_dados['entradas']);
        $valor_venda[$i] = $venda;
      }else{
        $valor_venda[$i] = $sql_sel_saida_dados['vendas'];
      }

      $id[$i]             = $sql_sel_saida_dados['id'];
      $nome[$i]           = $sql_sel_saida_dados['nome'];
      $imagem[$i]         = $sql_sel_saida_dados['imagem'];
      $marca[$i]          = $sql_sel_saida_dados['marca'];
      $categoria[$i]      = $sql_sel_saida_dados['categoria'];
      $fornecedor[$i]     = $sql_sel_saida_dados['fornecedor'];
      $quantidade[$i]     = $sql_sel_saida_dados['quantidade'];
      $valor_compra[$i]   = $sql_sel_saida_dados['valor_compra'];
      $frete[$i]          = $sql_sel_saida_dados['frete'];
      $st[$i]             = $sql_sel_saida_dados['st'];
      $ipi[$i]            = $sql_sel_saida_dados['ipi'];
      $despesas[$i]       = $sql_sel_saida_dados['despesas'];
      $margem[$i]         = $sql_sel_saida_dados['margem'];
      $nf[$i]             = $sql_sel_saida_dados['nf'];
      $datas[$i]          = $sql_sel_saida_dados['data'];
      $valor_com_frete    = $valor_compra[$i]   + calculo_porcentagem($sql_sel_saida_dados['frete'], $valor_compra[$i]);
      $cal_frete[$i]      = $valor_com_frete;
      $valor_com_st       = $valor_com_frete    + calculo_porcentagem($sql_sel_saida_dados['st'], $valor_com_frete);
      $cal_st[$i]         = $valor_com_st;
      $valor_com_ipi      = $valor_com_st       + calculo_porcentagem($sql_sel_saida_dados['ipi'], $valor_com_st);
      $cal_ipi[$i]        = $valor_com_ipi;
      $valor_com_despesa  = $valor_com_ipi      + calculo_porcentagem($sql_sel_saida_dados['despesas'], $valor_com_ipi);
      $cal_despesas[$i]   = $valor_com_despesa;

    }
    if ($numero_linhas>=12) {

      $data = date_parse($sql_sel_saida_dados['data']);

      switch ($data['month']) {
        case '1':
          $mes1  = "Janeiro";
          $mes2  = "Feveiro";
          $mes3  = "Março";
          $mes4  = "Abril";
          $mes5  = "Maio";
          $mes6  = "Junho";
          $mes7  = "Julho";
          $mes8  = "Agosto";
          $mes9  = "Setembro";
          $mes10 = "Outubro";
          $mes11 = "Novembro";
          $mes12 = "Dezembro";
          break;
        case '2':
          $mes1  = "Feveiro";
          $mes2  = "Março";
          $mes3  = "Abril";
          $mes4  = "Maio";
          $mes5  = "Junho";
          $mes6  = "Julho";
          $mes7  = "Agosto";
          $mes8  = "Setembro";
          $mes9  = "Outubro";
          $mes10 = "Novembro";
          $mes11 = "Dezembro";
          $mes12 = "Janeiro";
          break;
        case '3':
          $mes1  = "Março";
          $mes2  = "Abril";
          $mes3  = "Maio";
          $mes4  = "Junho";
          $mes5  = "Julho";
          $mes6  = "Agosto";
          $mes7  = "Setembro";
          $mes8  = "Outubro";
          $mes9  = "Novembro";
          $mes10 = "Dezembro";
          $mes11 = "Janeiro";
          $mes12 = "Feveiro";
          break;
        case '4':
          $mes1  = "Abril";
          $mes2  = "Maio";
          $mes3  = "Junho";
          $mes4  = "Julho";
          $mes5  = "Agosto";
          $mes6  = "Setembro";
          $mes7  = "Outubro";
          $mes8  = "Novembro";
          $mes9 = "Dezembro";
          $mes10 = "Janeiro";
          $mes11 = "Feveiro";
          $mes12  = "Março";
          break;
        case '5':
          $mes1  = "Maio";
          $mes2  = "Junho";
          $mes3  = "Julho";
          $mes4  = "Agosto";
          $mes5  = "Setembro";
          $mes6  = "Outubro";
          $mes7  = "Novembro";
          $mes8  = "Dezembro";
          $mes9  = "Janeiro";
          $mes10 = "Feveiro";
          $mes11 = "Março";
          $mes12 = "Abril";
          break;
        case '6':
          $mes1  = "Junho";
          $mes2  = "Julho";
          $mes3  = "Agosto";
          $mes4  = "Setembro";
          $mes5  = "Outubro";
          $mes6  = "Novembro";
          $mes7  = "Dezembro";
          $mes8  = "Janeiro";
          $mes9  = "Feveiro";
          $mes10 = "Março";
          $mes11 = "Abril";
          $mes12 = "Maio";
          break;
        case '7':
          $mes1  = "Julho";
          $mes2  = "Agosto";
          $mes3  = "Setembro";
          $mes4  = "Outubro";
          $mes5  = "Novembro";
          $mes6  = "Dezembro";
          $mes7  = "Janeiro";
          $mes8  = "Feveiro";
          $mes9  = "Março";
          $mes10 = "Abril";
          $mes11 = "Maio";
          $mes12 = "Junho";
          break;
        case '8':
          $mes1  = "Agosto";
          $mes2  = "Setembro";
          $mes3  = "Outubro";
          $mes4  = "Novembro";
          $mes5  = "Dezembro";
          $mes6  = "Janeiro";
          $mes7  = "Feveiro";
          $mes8  = "Março";
          $mes9  = "Abril";
          $mes10 = "Maio";
          $mes11 = "Junho";
          $mes12 = "Julho";
          break;
        case '9':
          $mes1  = "Setembro";
          $mes2  = "Outubro";
          $mes3  = "Novembro";
          $mes4  = "Dezembro";
          $mes5  = "Janeiro";
          $mes6  = "Feveiro";
          $mes7  = "Março";
          $mes8  = "Abril";
          $mes9  = "Maio";
          $mes10 = "Junho";
          $mes11 = "Julho";
          $mes12 = "Agosto";
          break;
        case '10':
          $mes1  = "Outubro";
          $mes2  = "Novembro";
          $mes3  = "Dezembro";
          $mes4  = "Janeiro";
          $mes5  = "Feveiro";
          $mes6  = "Março";
          $mes7  = "Abril";
          $mes8  = "Maio";
          $mes9  = "Junho";
          $mes10 = "Julho";
          $mes11 = "Agosto";
          $mes12 = "Setembro";
          break;
        case '11':
          $mes1  = "Novembro";
          $mes2  = "Dezembro";
          $mes3  = "Janeiro";
          $mes4  = "Feveiro";
          $mes5  = "Março";
          $mes6  = "Abril";
          $mes7  = "Maio";
          $mes8  = "Junho";
          $mes9  = "Julho";
          $mes10 = "Agosto";
          $mes11 = "Setembro";
          $mes12 = "Outubro";
          break;
        case '12':
          $mes1  = "Dezembro";
          $mes2  = "Janeiro";
          $mes3  = "Feveiro";
          $mes4  = "Março";
          $mes5  = "Abril";
          $mes6  = "Maio";
          $mes7  = "Junho";
          $mes8  = "Julho";
          $mes9  = "Agosto";
          $mes10 = "Setembro";
          $mes11 = "Outubro";
          $mes12 = "Novembro";
          break;
        default:
          # code...
          break;
      }
        ?>


        <div>
          <canvas id="myChart" width="600" height="250"></canvas>
        <script>
        //recebendo o valor de venda das variaveis do php
        var valor0  = "<?php echo $valor_venda["0"]; ?>";
        var valor1  = "<?php echo $valor_venda["1"]; ?>";
        var valor2  = "<?php echo $valor_venda["2"] ?>";
        var valor3  = "<?php echo $valor_venda["3"] ?>";
        var valor4  = "<?php echo $valor_venda["4"] ?>";
        var valor5  = "<?php echo $valor_venda["5"] ?>";
        var valor6  = "<?php echo $valor_venda["6"] ?>";
        var valor7  = "<?php echo $valor_venda["7"] ?>";
        var valor8  = "<?php echo $valor_venda["8"] ?>";
        var valor9  = "<?php echo $valor_venda["9"] ?>";
        var valor10 = "<?php echo $valor_venda["10"] ?>";
        var valor11 = "<?php echo $valor_venda["11"] ?>";
        var valor12 = "<?php echo $valor_venda["12"] ?>";
        //recebendo o mes das variaveis do php
        var mes1  = '<?php echo $mes1 ?>';
        var mes2  = '<?php echo $mes2 ?>';
        var mes3  = '<?php echo $mes3 ?>';
        var mes4  = '<?php echo $mes4 ?>';
        var mes5  = '<?php echo $mes5 ?>';
        var mes6  = '<?php echo $mes6 ?>';
        var mes7  = '<?php echo $mes7 ?>';
        var mes8  = '<?php echo $mes8 ?>';
        var mes9  = '<?php echo $mes9 ?>';
        var mes10 = '<?php echo $mes10 ?>';
        var mes11 = '<?php echo $mes11 ?>';
        var mes12 = '<?php echo $mes12 ?>';
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [mes1, mes2, mes3, mes4, mes5, mes6, mes7, mes8, mes9, mes10, mes11, mes12, mes1],
                datasets: [{
                    label: 'Preço',
                    data: [valor0, valor1, valor2, valor3, valor4, valor5, valor6, valor7, valor8, valor9, valor10, valor11, valor12],
                    backgroundColor: [
                        'rgba(135, 138, 140, 0.3)'
                    ],
                    borderColor: [
                        'rgb(135, 138, 140)'
                    ],
                    borderWidth: 2,
                    pointBorderColor: 'rgb(135, 138, 140)',
                    pointBackgroundColor: 'rgb(135, 138, 140)',
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: 'rgb(135, 138, 140)',
                    pointHoverBorderColor: '#000',
                    pointRadius: 4,
                    pointHitRadius: 3,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        </script>
      <?php
      }else {
      ?>
        <p align="center">
      <?php
        echo "O gráfico não pode ser gerado, pois não há informações necessárias para gerá-lo";
      ?>
        </p>
      <?php
      }

        $sql_sel_movimentacoes = "SELECT entradas.valor_venda, entradas.id, produtos.nome, produtos.imagem, marcas.nome AS marca, categorias.nome AS categoria, fornecedores.nome AS fornecedor, entradas.quantidade, entradas.valor_compra, entradas.data, entradas.frete, entradas.st, entradas.ipi, entradas.despesas, entradas.margem, entradas.nf FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id INNER JOIN categorias ON produtos.categorias_id=categorias.id INNER JOIN marcas ON produtos.marcas_id=marcas.id INNER JOIN fornecedores ON entradas.fornecedores_id=fornecedores.id WHERE entradas.tipo='PN' AND produtos.id='".$g_id."' AND entradas.data BETWEEN '".$data_seis_atras."' AND '".$data_atual."' ORDER BY entradas.id";

        $sql_sel_movimentacoes_preparado = selecionar($sql_sel_movimentacoes);

      ?>
      <span class="imprimir">
        <table class="table_relatorio" style="margin-left:5.5%;">
          <tr>
            <th class="tabela_especial">ID</th>
            <th class="tabela_especial">Produto</th>
            <th class="tabela_especial">Imagem</th>
            <th class="tabela_especial">Marca</th>
            <th class="tabela_especial">Categoria</th>
            <th class="tabela_especial">Fornecedor</th>
            <th class="tabela_especial">Quantidade</th>
            <th class="tabela_especial">Valor Compra</th>
            <th class="tabela_especial">Valor Venda</th>
            <th class="tabela_especial">Frete</th>
            <th class="tabela_especial">ST</th>
            <th class="tabela_especial">IPI</th>
            <th class="tabela_especial">Despesas</th>
            <th class="tabela_especial">Margem</th>
            <th colspan="4" align="center" class="tabela_especial">Cálculo de Impostos</th>
            <th class="tabela_especial">Nota Fiscal</th>
            <th class="tabela_especial">Datas</th>
          </tr>
          <?php
          $count = 0;
          $valor_com_frete = 0;
                if ($sql_sel_movimentacoes_preparado->rowCount()>0) {
                    while ($sql_sel_movimentacoes_dados = $sql_sel_movimentacoes_preparado->fetch()) {
                      $valor_com_frete    = $sql_sel_movimentacoes_dados['valor_venda']  + calculo_porcentagem($sql_sel_saida_dados['frete'], $sql_sel_movimentacoes_dados['valor_venda']);
                      $valor_com_st       = $valor_com_frete                             + calculo_porcentagem($sql_sel_saida_dados['st'], $valor_com_frete);
                      $valor_com_ipi      = $valor_com_st                                + calculo_porcentagem($sql_sel_saida_dados['ipi'], $valor_com_st);
                      $valor_com_despesa  = $valor_com_ipi                               + calculo_porcentagem($sql_sel_saida_dados['despesas'], $valor_com_ipi);


          ?>
          <tr>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['id']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['nome']; ?></td>
            <td class="td_relatorio"><img src="<?php echo BASE_URL."adicionais/imagens_produtos/".$sql_sel_movimentacoes_dados['imagem']; ?>" width="60px" height="60px"></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['marca']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['categoria']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['fornecedor']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['quantidade']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['valor_compra']; ?></td>
            <td class="td_relatorio"><?php echo "R$".number_format($sql_sel_movimentacoes_dados['valor_venda'],2,',','.'); ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['frete']."%"; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['st']."%"; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['ipi']."%"; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['despesas']."%"; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['margem']."%"; ?></td>
            <td class="td_relatorio"><?php echo "R$".number_format($valor_com_frete,2,',','.'); ?></td>
            <td class="td_relatorio"><?php echo "R$".number_format($valor_com_st,2,',','.'); ?></td>
            <td class="td_relatorio"><?php echo "R$".number_format($valor_com_ipi,2,',','.'); ?></td>
            <td class="td_relatorio"><?php echo "R$".number_format($valor_com_despesa,2,',','.'); ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['nf']; ?></td>
            <td class="td_relatorio"><?php echo $sql_sel_movimentacoes_dados['data']; ?></td>
          </tr>
          <?php
            $count++;
              }
            }else {

          ?>
          <tr>
            <td align="center" colspan="17">Não há registros.</td>
          </tr>
          <?php

            }

          ?>
      </table>
    </span>
    <form action="../adicionais/php/criar_pdf.php" id="gerarpdf" method="POST" onsubmit="return pegarConteudo()">
      <input type="hidden" name="dadospdf" id="dadospdf" value="">
      <button type="submit" class="b_imprimir"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button>
    </form>
    <hr/ class="limpa_float">
  </div>
</div>

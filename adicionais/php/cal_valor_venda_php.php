<?php

  function cal_valor_venda ($valor_compra, $frete, $st, $ipi, $despesas, $margem, $desconto, $produto){
    if ($produto=="novo") {
      $valor_com_frete   = $valor_compra       + calculo_porcentagem($frete, $valor_compra);
      $valor_com_st      = $valor_com_frete    + calculo_porcentagem($st, $valor_com_frete);
      $valor_com_ipi     = $valor_com_st       + calculo_porcentagem($ipi, $valor_com_st);
      $valor_com_despesa = $valor_com_ipi      + calculo_porcentagem($despesas, $valor_com_ipi);
      $valor_com_margem  = $valor_com_despesa  + calculo_porcentagem($margem, $valor_com_despesa);
      $valor_venda       = $valor_com_margem   - calculo_porcentagem($desconto, $valor_com_margem);
    }elseif ($produto=="usado") {
      $valor_com_despesa = $valor_compra       + calculo_porcentagem($despesas, $valor_compra);
      $valor_com_margem  = $valor_com_despesa  + calculo_porcentagem($margem, $valor_com_despesa);
      $valor_venda       = $valor_com_margem   - calculo_porcentagem($desconto, $valor_com_margem);
    }

    return $valor_venda;
  }

?>

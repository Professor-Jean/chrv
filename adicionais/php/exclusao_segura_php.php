<?php
function safeDelete($valor1, $valor2, $acao, $nome, $campo){

  $formName = md5($valor1.time());

  $criptoValue = md5($valor1);
  /*
    #R - 19/10/2016
    A variavel $submitEvento serve para que quando se clique na tag <i> o javascrit pegue do documento um elemento com o id,
    que é o mesmo que o nome do formulario e envie para a action do formulario.
  */
  $submitEvento = "onClick = 'confirmar_exclusao(\"$nome\", \"$campo\", \"$formName\" );'";

  if ($valor2 == 'nao') {
    $safeLink = "<form name='".$formName."' action='".$acao."' method='post' id='".$formName."'>";

    $safeLink .= "<input type='hidden' name='hidid' value='".$criptoValue."'>";

    $safeLink .= "<i $submitEvento class='fa fa-trash icone_tabela' aria-hidden='true'></i>";

    $safeLink .= "</form>";
  }else{

    $criptoValue2 = md5($valor2);

    $safeLink = "<form name='".$formName."' action='".$acao."' method='post'>";

    $safeLink .= "<input type='hidden' name='hidid' value='".$criptoValue."'>";

    $safeLink .= "<input type='hidden' name='hidid2' value='".$criptoValue2."'>";

    $safeLink .= "<i $submitEvento class='fa fa-trash icone_tabela' aria-hidden='true'></i>";

    $safeLink .= "</form>";
  }

  return $safeLink;
}
?>

<?php
function msgGeral($id, $operacao, $o_que){

  switch ($id) {
    case '1':{
      $mensagem = "Registro de ".$o_que." ".$operacao." com sucesso!";
    }
    break;
    case '2':{
      $mensagem = "Erro ao efetuar o/a ".$operacao." de(a) ".$o_que."!";
    }
    break;
    case '3':{
      $mensagem = "Esta(e) ".$o_que." já existe!";
    }
    break;
    case '4':{
      $mensagem = "Preencha o campo ".$o_que." corretamente!";
    }
    break;
    case '5':{
      $mensagem = "".$operacao." de ".$o_que." realizada(o) com sucesso!";
    }
    break;
    case '6':{
      $mensagem = "".$o_que." não encontrada(os)!";
    }
    break;
    case '7':{
      $mensagem = "Existem ".$o_que." já registradas(os) com este ".$operacao."!";
    }
    break;
    case '8' : {//informações iguais já cadastradas
      $mensagem = "Já existem informações iguais que não podem ser repetidas!";
    }
    break;
    case '9' : {//informações iguais já cadastradas
      $mensagem = "A extensão não é válida, por favor insira imagens em tipo: jpg, jpeg ou png!";
    }
    break;
    case '10' : {//informações iguais já cadastradas
      $mensagem = "Você não pode se deletar, pois é o unico usuario registrado!";
    }
    break;
    case '11' : {//informações iguais já cadastradas
      $mensagem = "A quantidade que deseja ser retirada é maior que a em estoque, portanto não poderá ser efetuada!";
    }
    break;
  default:{
    $mensagem ="Nenhuma mensagem encontrada para esta ação...";
  }
  }
  return $mensagem;
}

?>

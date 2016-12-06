<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
  <div class="mensagem_aviso">
    <?php

      $p_id = $_POST['hidid'];
      $msg_aviso = "Erro";
      $cor       = "erro";

      if ($p_id=="") {
        $msg = msgGeral('6','','id');
      }else {

        $tabela = "fornecedores";

        $condicao = "MD5(id)='".$p_id."'";

        $sql_del_fornecedor_resultado = deletar($tabela, $condicao);

        if ($sql_del_fornecedor_resultado) {
          $msg_aviso = "Confirmação";
          $msg       = msgGeral('1', 'exlusão', 'fornecedor');
          $msg_aviso = "Confirmação";
          $msg       = msgGeral('1', 'excluído com sucesso', 'fornecedor');
          $cor       = "confirmacao";
        }else {
          $msg = msgGeral('2', 'exclusão', 'fornecedor');
        }
    }
?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
    <p><?php echo $msg ?></p>
    <hr/ class="limpa_float">
    <a class="icone" href="?folder=registros/fornecedor/&file=registro_fornecedor_fornecedor&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
  </div>
</div>

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

        $tabela = "vendedores";

        $condicao = "MD5(id)='".$p_id."'";

        $sql_del_vendedor_resultado = deletar($tabela, $condicao);

        if ($sql_del_vendedor_resultado) {
          $msg_aviso = "Confirmação";
          $msg       = msgGeral('1', 'excluído', 'vendedor');
          $cor       = "confirmacao";
        }else {
          $msg = msgGeral('2', 'exclusão', 'vendedor');
        }
    }
?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
    <p><?php echo $msg ?></p>
    <hr/ class="limpa_float">
    <a class="icone" href="?folder=registros/vendedor/&file=registro_vendedor_vendedor&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
  </div>
</div>

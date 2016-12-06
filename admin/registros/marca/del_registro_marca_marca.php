<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
  <div class="mensagem_aviso">
    <?php

      $p_id = $_POST['hidid'];
      $msg_aviso = "Erro";
      $cor       = "erro";

      $sql_sel_marcas = "SELECT logo FROM marcas WHERE MD5(id)='".$p_id."'";

      $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

      $sql_sel_marcas_dados = $sql_sel_marcas_preparado->fetch();

      $envio_diretorio     = "../adicionais/imagens_marcas/";
      $envio_nomearquivo   = $sql_sel_marcas_dados['logo'];
      $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

      if ($p_id=="") {
        $msg = msgGeral('6','','id');
      }else {

        $tabela = "marcas";

        $condicao = "MD5(id)='".$p_id."'";

        $sql_del_marcas_resultado = deletar($tabela, $condicao);

        if ($sql_del_marcas_resultado) {
          $msg_aviso = "Confirmação";
          $msg       = msgGeral('5', 'Exlusão', 'marca');
          unlink($envio_arquivo);
          $cor       = "confirmacao";
        }else {
          $msg = msgGeral('2', 'exclusão', 'marca');
        }
    }
?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
    <p><?php echo $msg ?></p>
    <hr/ class="limpa_float">
    <a class="icone" href="?folder=registros/marca/&file=registro_marca_marca&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
  </div>
</div>

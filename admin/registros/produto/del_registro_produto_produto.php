<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
  <div class="mensagem_aviso">
    <?php

      $p_id = $_POST['hidid'];
      $msg_aviso = "Erro";
      $cor       = "erro";

      $sql_sel_produto = "SELECT imagem FROM produtos WHERE MD5(id)='".$p_id."'";

      $sql_sel_produto_preparado = selecionar($sql_sel_produto);

      $sql_sel_produto_dados = $sql_sel_produto_preparado -> fetch();

      $envio_diretorio     = "../adicionais/imagens_produtos/";
      $envio_nomearquivo   = $sql_sel_produto_dados['imagem'];
      $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

      if ($p_id=="") {
        $msg = msgGeral('6','','id');
      }else {

        $tabela = "produtos";

        $condicao = "MD5(id)='".$p_id."'";

        $sql_del_produto_resultado = deletar($tabela, $condicao);

        if ($sql_del_produto_resultado) {
          $msg_aviso = "Confirmação";
          $msg       = msgGeral('5', 'Exclusão', 'produto');
          unlink($envio_arquivo);
          $cor       = "confirmacao";

        }else {
          $msg = msgGeral('2', 'Exclusão', 'produto');
        }
    }
?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
    <p><?php echo $msg ?></p>
    <hr/ class="limpa_float">
    <a class="icone" href="?folder=registros/produto/&file=registro_produto_produto&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
  </div>
</div>

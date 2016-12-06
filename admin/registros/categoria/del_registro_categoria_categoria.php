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
        $sql_sel_categorias = "SELECT categorias.id FROM categorias INNER JOIN produtos ON produtos.categorias_id=categorias.id WHERE produtos.categorias_id<>'".$p_id."'";

        $sql_sel_categorias_preparado = selecionar($sql_sel_categorias);

        $tabela = "categorias";

        $condicao = "MD5(id)='".$p_id."'";

        $sql_del_categorias_resultado = deletar($tabela, $condicao);

        if ($sql_del_categorias_resultado) {
          $msg_aviso = "Confirmação";
          $msg       = msgGeral('5', 'Exlusão', 'Categoria');
          $cor       = "confirmacao";
        }else {
          $msg = msgGeral('2', 'Exclusão', 'Categoria');
        }
    }
?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
    <p><?php echo $msg ?></p>
    <hr/ class="limpa_float">
    <a class="icone" href="?folder=registros/categoria/&file=registro_categoria_categoria&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
  </div>
</div>

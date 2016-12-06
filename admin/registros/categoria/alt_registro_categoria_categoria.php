<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        $p_id = $_POST['hidid'];
        $p_nome = $_POST['txtnome'];
        $p_descricao = $_POST['txadescricao'];

        $msg_aviso = "Erro";
        $cor = "erro";
        $destino = "?folder=registros/categoria/&file=falt_registro_categoria_categoria&ext=php&id=".$p_id;

        if ($p_nome=="") {
          $msg = msgGeral('4','','nome');
        }elseif ($p_descricao=="") {
          $msg = msgGeral('4','','Descrição');
          }else {

            $sql_sel_categorias = "SELECT * FROM categorias WHERE nome='".$p_nome."' AND id<>'".$p_id."'";

            $sql_sel_categorias_preparado = selecionar($sql_sel_categorias);

            if ($sql_sel_categorias_preparado->rowCount()==0) {

              $tabela = "categorias";

              $dados = array(
                'nome' => $p_nome,
                'descricao' => $p_descricao
              );

              $condicao = "id = '".$p_id."'";

              $sql_alt_categorias_resultado = alterar($tabela, $dados, $condicao);

              if ($sql_alt_categorias_resultado) {
                $msg_aviso = "Confirmação";
                $msg = msgGeral('5', 'Alteração', 'Categoria');
                $cor = "confirmacao";
                $destino = "?folder=registros/categoria/&file=registro_categoria_categoria&ext=php";
              }else {
                $msg = msgGeral('2', 'Alteração', 'Categoria');
              }
            }else {
              $msg = msgGeral('8','','');
            }
          }
      ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a class="icone" href="<?php echo $destino ?>"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>

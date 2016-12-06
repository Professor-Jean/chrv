<div class="ajustavel">
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
  <section>
    <div class="mensagem_aviso">
      <?php

        $p_nome = $_POST['txtnome'];
        $p_descricao = $_POST['txadescricao'];

        $msg_aviso = "Erro";
        $cor       = "erro";

        if ($p_nome=="") {
          $msg = msgGeral('4','','Nome');
        }elseif ($p_descricao=="") {
          $msg = msgGeral('4','','Descrição');
          }else{

              $sql_sel_categorias = "SELECT * FROM categorias WHERE nome='".$p_nome."'";

              $sql_sel_categorias_preparado = selecionar($sql_sel_categorias);

              if ($sql_sel_categorias_preparado->rowCount()==0) {

                $tabela = "categorias";

                $dados = array(
                  'nome' => $p_nome,
                  'descricao' => $p_descricao
                );

                $sql_ins_categorias_resultado = adicionar($tabela, $dados);

                if ($sql_ins_categorias_resultado) {
                  $msg_aviso = "Confirmação";
                  $msg       = msgGeral('1', 'efetuado', 'Categoria');
                  $cor       = "confirmacao";
                }else {
                  $msg = msgGeral('2', 'registro', 'Categoria');
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
          <a href="?folder=registros/categoria/&file=registro_categoria_categoria&ext=php" class="icone"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
    </div>
  </div>
  </section>

<div class="ajustavel">
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
  <section>
    <div class="mensagem_aviso">
      <?php

        $p_nome = $_POST['txtnome'];

        $msg_aviso = "Erro";
        $cor       = "erro";

        if ($p_nome=="") {
          $msg = msgGeral('4','','nome');
        }else{

          $envio_diretorio     = "../adicionais/imagens_marcas/";
          $envio_nomearquivo   = criptografiaNomeImg($_FILES['flimage']['name']);
          $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

          $validacao_ext = array('image/jpeg', 'image/png');

          if(in_array($_FILES['flimage']['type'], $validacao_ext)){

            if (move_uploaded_file($_FILES['flimage']['tmp_name'], $envio_arquivo)) {

              $sql_sel_marcas = "SELECT * FROM marcas WHERE nome='".$p_nome."'";

              $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

              if ($sql_sel_marcas_preparado->rowCount()==0) {

                $tabela = "marcas";

                $dados = array(
                  'nome' => $p_nome,
                  'logo' => $envio_nomearquivo
                );

                $sql_ins_marcas_resultado = adicionar($tabela, $dados);

                if ($sql_ins_marcas_resultado) {
                  $msg_aviso = "Confirmação";
                  $msg       = msgGeral('1', 'efetuado', 'marca');
                  $cor       = "confirmacao";
                }else {
                  $msg = msgGeral('2', 'registro', 'marca');
                }
              }else {
                $msg = msgGeral('8','','');
              }
            }else {
              $msg = msgGeral('2','envio','imagem');
              unlink($envio_arquivo);
            }
          }else{
            $msg = msgGeral('9','','');
          }
        }
          ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a href="?folder=registros/marca/&file=registro_marca_marca&ext=php" class="icone"`><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
    </div>
  </div>
  </section>

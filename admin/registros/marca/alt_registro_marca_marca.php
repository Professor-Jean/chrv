<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        $p_id = $_POST['hidid'];
        $p_nome = $_POST['txtnome'];

        $msg_aviso = "Erro";
        $cor = "erro";
        $destino = "?folder=registros/marca/&file=falt_registro_marca_marca&ext=php&id=".$p_id;

        if ($p_nome=="") {
          $msg = msgGeral('4','','nome');
        }else {
            $sql_sel_marcas = "SELECT * FROM marcas WHERE nome='".$p_nome."' AND id<>'".$p_id."'";

            $sql_sel_marcas_preparado = selecionar($sql_sel_marcas);

            $sql_sel_imagem = "SELECT logo FROM marcas WHERE id='".$p_id."'";
            $sql_sel_imagem_preparado = selecionar($sql_sel_imagem);
            $sql_sel_imagem_dados = $sql_sel_imagem_preparado->fetch();

            if (($_FILES['fllogo']['name'])=="") {

              $envio_diretorio     = "../adicionais/imagens_marcas/";
              $envio_nomearquivo   = $sql_sel_imagem_dados['logo'];
              $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

              if ($sql_sel_marcas_preparado->rowCount()==0) {

                $tabela = "marcas";

                $dados = array(
                  'nome' => $p_nome,
                  'logo' => $envio_nomearquivo
                );

                $condicao = "id = '".$p_id."'";

                $sql_alt_marcas_resultado = alterar($tabela, $dados, $condicao);

                if ($sql_alt_marcas_resultado) {
                  $msg_aviso = "Confirmação";
                  $msg = msgGeral('5', 'Alteração', 'marca');
                  $cor = "confirmacao";
                  $destino = "?folder=registros/marca/&file=registro_marca_marca&ext=php";
                }else {
                  $msg = msgGeral('2', 'alteração', 'marca');
                }
              }else {
                $msg = msgGeral('8','','');
              }
            }else {
              $envio_diretorio_exclusao     = "../adicionais/imagens_marcas/";
              $envio_nomearquivo_exclusao   = $sql_sel_imagem_dados['logo'];
              $envio_aquivo_exclusao   = $envio_diretorio_exclusao.$envio_nomearquivo_exclusao;
              unlink($envio_aquivo_exclusao);
              $envio_diretorio     = "../adicionais/imagens_marcas/";
              $envio_nomearquivo   = criptografiaNomeImg($_FILES['fllogo']['name']);
              $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

              $validacao_ext = array('image/jpeg', 'image/png');

              if(in_array($_FILES['fllogo']['type'], $validacao_ext)){

                if (move_uploaded_file($_FILES['fllogo']['tmp_name'], $envio_arquivo)) {
                  if ($sql_sel_marcas_preparado->rowCount()==0) {

                    $tabela = "marcas";

                    $dados = array(
                      'nome' => $p_nome,
                      'logo' => $envio_nomearquivo
                    );

                    $condicao = "id = '".$p_id."'";

                    $sql_alt_marcas_resultado = alterar($tabela, $dados, $condicao);

                    if ($sql_alt_marcas_resultado) {
                      $msg_aviso = "Confirmação";
                      $msg = msgGeral('5', 'Alteração', 'marca');
                      $cor = "confirmacao";
                      $destino = "?folder=registros/marca/&file=registro_marca_marca&ext=php";
                    }else {
                      $msg = msgGeral('2', 'alteração', 'marca');
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
          }
      ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a class="icone" href="<?php echo $destino ?>"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>

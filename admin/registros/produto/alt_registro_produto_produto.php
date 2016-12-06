<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        $p_id              = $_POST['hidid'];
        $p_nome            = $_POST['txtnome'];
        $p_marca           = $_POST['selmarca'];
        $p_categoria       = $_POST['selcategoria'];
        $p_qnt_min_estoque = $_POST['txtqnt_min_estoque'];


        $msg_aviso = "Erro";
        $cor       = "erro";
        $destino   = "?folder=registros/produto/&file=falt_registro_produto_produto&ext=php&id=$p_id";

        if ($p_nome=="") {
          $msg = msgGeral('4','','nome');
          }elseif ($p_marca=="") {
            $msg = msgGeral('4','','marca');
            }elseif ($p_categoria=="") {
              $msg = msgGeral('4','','categoria');
              }elseif ($p_qnt_min_estoque=="") {
                $msg = msgGeral('4','','Qnt. Min. Estoque');
              }else {

                $sql_sel_imagem = "SELECT imagem FROM produtos WHERE id='".$p_id."'";
                $sql_sel_imagem_preparado = selecionar($sql_sel_imagem);
                $sql_sel_imagem_dados = $sql_sel_imagem_preparado->fetch();

                if (($_FILES['flimage']['name'])=="") {
                  $envio_diretorio     = "../adicionais/imagens_produtos/";
                  $envio_nomearquivo   = $sql_sel_imagem_dados['imagem'];
                  $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

                  $sql_sel_produto = "SELECT * FROM produtos WHERE nome='".$p_nome."' AND id<>'".$p_id."'";

                  $sql_sel_produto_preparado = $conexaobd->prepare($sql_sel_produto);

                  $sql_sel_produto_preparado->execute();

                  if ($sql_sel_produto_preparado->rowCount()==0) {

                    $tabela = "produtos";

                    $dados = array(
                      'nome'            => $p_nome,
                      'imagem'          => $envio_nomearquivo,
                      'marcas_id'       => $p_marca,
                      'categorias_id'   => $p_categoria,
                      'qtd_min_estoque' => $p_qnt_min_estoque,
                      'status'          => '0'
                    );

                    $condicao = "id = '".$p_id."'";

                    $sql_alt_produto_resultado = alterar($tabela, $dados, $condicao);

                    if ($sql_alt_produto_resultado) {
                      $msg_aviso = "Confirmação";
                      $msg       = msgGeral('5', 'Alteração', 'produto');
                      $cor       = "confirmacao";
                      $destino   = "?folder=registros/produto/&file=registro_produto_produto&ext=php";
                    }else {
                      $msg = msgGeral('2', 'alteração', 'produto');
                    }
                  }else {
                    $msg = msgGeral('8','','');
                  }
                }else {
                  $envio_diretorio_exclusao     = "../adicionais/imagens_produtos/";
                  $envio_nomearquivo_exclusao   = $sql_sel_imagem_dados['imagem'];
                  $envio_aquivo_exclusao   = $envio_diretorio_exclusao.$envio_nomearquivo_exclusao;
                  unlink($envio_aquivo_exclusao);

                  $envio_diretorio     = "../adicionais/imagens_produtos/";
                  $envio_nomearquivo   = criptografiaNomeImg($_FILES['flimage']['name']);
                  $envio_arquivo       = $envio_diretorio.$envio_nomearquivo;

                $validacao_ext = array('image/jpeg', 'image/png');

                if(in_array($_FILES['flimage']['type'], $validacao_ext)){

                  if (move_uploaded_file($_FILES['flimage']['tmp_name'], $envio_arquivo)) {

                    $sql_sel_produto = "SELECT * FROM produtos WHERE nome='".$p_nome."' AND id<>'".$p_id."'";

                    $sql_sel_produto_preparado = $conexaobd->prepare($sql_sel_produto);

                    $sql_sel_produto_preparado->execute();

                    if ($sql_sel_produto_preparado->rowCount()==0) {

                      $tabela = "produtos";

                      $dados = array(
                        'nome'            => $p_nome,
                        'imagem'          => $envio_nomearquivo,
                        'marcas_id'        => $p_marca,
                        'categorias_id'    => $p_categoria,
                        'qtd_min_estoque' => $p_qnt_min_estoque,
                        'status'          => '0'
                      );

                      $condicao = "id = '".$p_id."'";

                      $sql_alt_produto_resultado = alterar($tabela, $dados, $condicao);

                      if ($sql_alt_produto_resultado) {
                        $msg_aviso = "Confirmação";
                        $msg       = msgGeral('5', 'Alteração', 'produto');
                        $cor       = "confirmacao";
                        $destino   = "?folder=registros/produto/&file=registro_produto_produto&ext=php";
                      }else {
                        $msg = msgGeral('2', 'alteração', 'produto');
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

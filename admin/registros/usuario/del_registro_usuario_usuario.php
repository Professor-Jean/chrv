<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
  <div class="mensagem_aviso">
    <?php

      $p_id = $_POST['hidid'];
      $msg_aviso = "Erro";
      $cor       = "erro";

    $sql_sel_usuario = "SELECT id FROM usuarios";

      $sql_sel_usuario_preparado = selecionar($sql_sel_usuario);

      if ($sql_sel_usuario_preparado->rowCount()==1) {
        $msg = msgGeral('10', '', '');
        $retorno    = "?folder=registros/usuario/&file=registro_usuario_usuario&ext=php";
      }else {
        if ($p_id=="") {
          $msg = mensagem('6', 'id', '');
          $retorno    = "?folder=registros/usuario/&file=registro_usuario_usuario&ext=php";
        }else{

          $sql_sel_usuario = "SELECT id FROM usuarios WHERE id='".$_SESSION['idUsuario']."'";// formando uma sintaxe que quando executada irá selecionar o id do usuario onde o id for igual ao do usuario que está conectado

          $sql_sel_usuario_preparado = selecionar($sql_sel_usuario);

          $sql_sel_usuario_dados = $sql_sel_usuario_preparado->fetch();// armazena os dados em uma variavel

          $tabela = "usuarios";

          $condicao = "MD5(id)='".$p_id."'";

          $sql_del_usuario_resultado = deletar($tabela, $condicao);

          if ($sql_del_usuario_resultado) {//verificando se a varivel é verdadeira, ou seja, neste casso se o usuario realmente foi apagado do bd
            $cor = "confirmacao";//variavel que armazena a instrução que define se a cor do titulo será verde ou vermelha
            $msg_aviso = "Confirmação";//varivel que armazena o titulo da mensagem que o usuário irá ver
            $msg = msgGeral('5', 'Exclusão', 'usuário');//varivel que armazena a mensagem que o usuário irá ver na tela

            if (MD5($sql_sel_usuario_dados['id'])==$p_id) {//vereficando se o id do usuario conectado é igual ao id que será deletado
              $retorno="../seguranca/autenticacao/desconexao_autenticacao.php";//variavel que armazena para onde o usuario retornara
            }else {//se o id do usuario conectado for diferente do id que será excluido ele entrará nesse else
              $retorno    = "?folder=registros/usuario/&file=registro_usuario_usuario&ext=php";//variavel que armazena para onde o usuario retornara
            }
          }else {
            $msg = msgGeral('2', 'Exclusão', 'usuário');//varivel que armazena a mensagem que o usuario irá ver na tela
            $retorno    = "?folder=registros/usuario/&file=registro_usuario_usuario&ext=php";//variavel que armazena para onde o usuario retornara
          }
        }
      }

?>
    <!--class erro e sucesso -->
    <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
    <p><?php echo $msg ?></p>
    <hr/ class="limpa_float">
    <a class="icone" href="<?php echo $retorno; ?>"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
  </div>
</div>
